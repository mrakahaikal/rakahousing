<?php

namespace App\Filament\Resources\MortgageRequests;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use App\Filament\Resources\MortgageRequests\Pages\ListMortgageRequests;
use App\Filament\Resources\MortgageRequests\Pages\CreateMortgageRequest;
use App\Filament\Resources\MortgageRequests\Pages\EditMortgageRequest;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\{Wizard, Grid};
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\{ImageColumn, TextColumn};
use App\Models\{MortgageRequest, House, Interest, User};
use App\Filament\Resources\MortgageRequestResource\Pages;
use Filament\Forms\Components\{Select, TextInput, FileUpload};
use App\Filament\Resources\MortgageRequestResource\RelationManagers;
use App\Filament\Resources\MortgageRequests\RelationManagers\InstallmentsRelationManager;

class MortgageRequestResource extends Resource
{
    protected static ?string $model = MortgageRequest::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-receipt-percent';

    protected static string | \UnitEnum | null $navigationGroup = 'Transaction';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Wizard::make([
                    Step::make('Product and Price')
                        ->schema([
                            \Filament\Schemas\Components\Grid::make(3)
                                ->schema([
                                    Select::make('house_id')
                                        ->label('House')
                                        ->options(House::query()->pluck('name', 'id'))
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $house = House::find($state);
                                            if ($house) {
                                                $set('house_price', $house->price ?? 0);
                                            }
                                        }),
                                    Select::make('interest_id')
                                        ->label('Annual Interest in %')
                                        ->options(function (callable $get) {
                                            $houseId = $get('house_id');
                                            if ($houseId) {
                                                return Interest::where('house_id', $houseId)
                                                    ->get()
                                                    ->pluck('interest', 'id');
                                            }
                                            return [];
                                        })
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $interest = Interest::find($state);
                                            if ($interest) {
                                                $set('bank_name', $interest->bank->name ?? '');
                                                $set('interest', $interest->interest);
                                                $set('duration', $interest->duration);
                                            }
                                        }),
                                    TextInput::make('bank_name')
                                        ->label('Bank Name')
                                        ->required()
                                        ->readonly(),
                                    TextInput::make('duration')
                                        ->label('Duration in Years')
                                        ->required()
                                        ->numeric()
                                        ->suffix('Years')
                                        ->readonly(),
                                    TextInput::make('interest')
                                        ->label('Interest Rate')
                                        ->required()
                                        ->numeric()
                                        ->suffix('%')
                                        ->readonly(),
                                    TextInput::make('house_price')
                                        ->label('House Price')
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->readonly(),
                                    Select::make('dp_percentage')
                                        ->label('Down Payment (%)')
                                        ->options([
                                            5 => '5%',
                                            10 => '10%',
                                            15 => '15%',
                                            20 => '20%',
                                            25 => '25%',
                                            30 => '30%',
                                            40 => '40%',
                                            50 => '50%',
                                        ])
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                            $housePrice = $get('house_price') ?? 0;
                                            $dpAmount = ($state / 100) * $housePrice; // Calculate DP amount
                                            $loanAmount = max($housePrice - $dpAmount, 0); // Calculate loan amount

                                            $set('dp_total_amount', round($dpAmount));
                                            $set('loan_total_amount', round($loanAmount));

                                            // Calculate monthly payment
                                            $durationYears = $get('duration') ?? 0;
                                            $interestRate = $get('interest') ?? 0;

                                            if ($loanAmount > 0 && $loanAmount > 0 && $interestRate > 0) {
                                                $totalPayments = $durationYears * 12; // Total number of payments
                                                $monthlyInterestRate = $interestRate / 100 / 12; // Calculate monthly interest

                                                // Amortization formula
                                                $numerator = $loanAmount * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $totalPayments);
                                                $denominator = pow(1 + $monthlyInterestRate, $totalPayments) - 1;
                                                $monthlyPayment = $denominator > 0 ? $numerator / $denominator : 0;

                                                $set('monthly_amount', round($monthlyPayment));

                                                // Total loan with interest
                                                $interestTotalAmount = $monthlyPayment * $totalPayments;
                                                $set('loan_interest_total_amount', round($interestTotalAmount));
                                            } else {
                                                $set('monthly_amount', 0);
                                                $set('loan_interest_total_amount', 0);
                                            }
                                        }),
                                    TextInput::make('dp_total_amount')
                                        ->label('Down Payment Amount')
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->readonly(),
                                    TextInput::make('loan_total_amount')
                                        ->label('Loan Amount')
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->readonly(),
                                    TextInput::make('monthly_amount')
                                        ->label('Monthly Payment')
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->readonly(),
                                    TextInput::make('loan_interest_total_amount')
                                        ->label('Total Payment Amount')
                                        ->required()
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->readonly(),
                                ])
                        ]),
                    Step::make('Customer Information')
                        ->schema([
                            Select::make('user_id')
                                ->relationship('customer', 'email')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->live()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $user = User::find($state);

                                    $name = $user->name;
                                    $email = $user->email;

                                    $set('name', $name);
                                    $set('email', $email);
                                })
                                ->afterStateHydrated(function (callable $set, $state) {
                                    $userId = $state;
                                    if ($userId) {
                                        $user = User::find($userId);
                                        $name = $user->name;
                                        $email = $user->email;
                                        $set('name', $name);
                                        $set('email', $email);
                                    }
                                }),
                            TextInput::make('name')
                                ->required()
                                ->readonly()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->required()
                                ->readonly()
                                ->maxLength(255),

                        ]),
                    Step::make('Bank Approval')
                        ->schema([
                            FileUpload::make('documents')
                                ->acceptedFileTypes(['application/pdf'])
                                ->required(),
                            Select::make('status')
                                ->label('Approval Status')
                                ->options([
                                    'Waiting for Bank' => 'Waiting for Bank',
                                    'Approved' => 'Approved',
                                    'Rejected' => 'Rejected',
                                ])
                                ->required()
                        ]),
                ])
                    ->columnSpan('full')
                    ->columns(1)
                    ->skippable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('house.thumbnail')
                    ->square(),
                TextColumn::make('customer.name')
                    ->searchable(),
                TextColumn::make('house.name')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Waiting for Bank' => 'warning',
                        'Approved' => 'success',
                        'Rejected' => 'danger',
                    })
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(MortgageRequest $record) => asset('storage/' . $record->documents))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            InstallmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMortgageRequests::route('/'),
            'create' => CreateMortgageRequest::route('/create'),
            'edit' => EditMortgageRequest::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
