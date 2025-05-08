<?php

namespace App\Filament\Resources\MortgageRequestResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\{ToggleButtons, FileUpload, TextInput, Select, Wizard, Wizard\Step};
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class InstallmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'installments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Installments')
                        ->schema([
                            TextInput::make('no_of_payment')
                                ->label('No. Payment')
                                ->helperText('Pembayaran cicilan ke berapa')
                                ->required()
                                ->numeric()
                                ->maxLength(255),
                            Select::make('sub_total_amount')
                                ->label('Monthly Payment')
                                ->options(function () {
                                    $mortgageRequest = $this->getOwnerRecord();
                                    return $mortgageRequest ? [$mortgageRequest->monthly_amount => $mortgageRequest->monthly_amount]
                                        : [];
                                })
                                ->required()
                                ->live()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $tax = $state * .11;
                                    $sub_total_amount = $state;
                                    $insurance = 900000;
                                    $grandTotal = $state + $tax + $insurance;

                                    $set('total_tax_amount', round($tax));
                                    $set('insurance', round($insurance));
                                    $set('grand_total_amount', round($grandTotal));

                                    $mortgageRequest = $this->getOwnerRecord();
                                    if ($mortgageRequest) {
                                        $lastInstallment = $mortgageRequest->installments()
                                            ->where('is_paid', true)
                                            ->orderBy('no_of_payment', 'desc')
                                            ->first();

                                        $previousRemainingLoan = $lastInstallment
                                            ? $lastInstallment->remaining_loan_amount
                                            : $mortgageRequest->loan_interest_total_amount;

                                        $remainingLoanAfterPayment = max($previousRemainingLoan - round($sub_total_amount), 0);

                                        $set('remaining_loan_amount', $remainingLoanAfterPayment);
                                        $set('remaining_loan_amount_before_payment', $previousRemainingLoan);
                                    }
                                }),
                            TextInput::make('total_tax_amount')
                                ->label('Tax 11%')
                                ->readOnly()
                                ->required()
                                ->numeric()
                                ->prefix('IDR'),
                            TextInput::make('insurance_amount')
                                ->label('Additional Insurance')
                                ->readOnly()
                                ->default(900000)
                                ->numeric()
                                ->prefix('IDR'),
                            TextInput::make('grand_total_amount')
                                ->label('Total Payment')
                                ->readOnly()
                                ->required()
                                ->numeric()
                                ->prefix('IDR'),
                            TextInput::make('remaining_loan_amount_before_payment')
                                ->label('Remaining Loan Amount Before Payment')
                                ->readOnly()
                                ->numeric()
                                ->prefix('IDR'),
                            TextInput::make('remaining_loan_amount')
                                ->label('Remaining Loan Amount After Payment')
                                ->readOnly()
                                ->numeric()
                                ->prefix('IDR'),

                        ]),
                    Step::make('Payment Method')
                        ->schema([
                            ToggleButtons::make('is_paid')
                                ->label('Payment Status')
                                ->boolean()
                                ->grouped()
                                ->icons([
                                    true => 'heroicon-o-check-circle',
                                    false => 'heroicon-o-x-circle'
                                ])
                                ->required(),
                            Select::make('payment_type')
                                ->label('Payment Type')
                                ->options([
                                    'Midtrans' => 'Midtrans',
                                    'Manual' => 'Manual'
                                ])
                                ->required(),
                            FileUpload::make('proof')
                                ->label('Payment Proof')
                                ->image()

                        ])

                ])
                    ->columnSpan('full')
                    ->columns(1)
                    ->skippable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('no_of_payment')
            ->columns([
                Tables\Columns\TextColumn::make('no_of_payment'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
