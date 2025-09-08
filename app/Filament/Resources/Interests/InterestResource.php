<?php

namespace App\Filament\Resources\Interests;

use Filament\Schemas\Schema;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use App\Filament\Resources\Interests\Pages\ManageInterests;
use Filament\Forms;
use Filament\Tables;
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

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static string | \UnitEnum | null $navigationGroup = 'Vendors';
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageInterests::route('/'),
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
