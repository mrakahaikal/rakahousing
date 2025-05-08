<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\{Interest};
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InterestResource\Pages;
use Filament\Forms\Components\{Select, TextInput};
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InterestResource\RelationManagers;

class InterestResource extends Resource
{
    protected static ?string $model = Interest::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $navigationGroup = 'Vendors';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('house_id')
                    ->relationship('house', 'name')
                    ->searchable()
                    ->required()
                    ->preload(),
                Select::make('bank_id')
                    ->relationship('bank', 'name')
                    ->searchable()
                    ->required()
                    ->preload(),
                TextInput::make('interest')
                    ->required()
                    ->numeric()
                    ->suffix('%'),
                TextInput::make('duration')
                    ->required()
                    ->numeric()
                    ->suffix('Years')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('house.name')
                    ->searchable(),
                TextColumn::make('bank.name'),
                TextColumn::make('interest')
                    ->suffix('%'),
                TextColumn::make('duration')
                    ->suffix(' Years'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageInterests::route('/'),
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
