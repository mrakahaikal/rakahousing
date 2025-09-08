<?php

namespace App\Filament\Resources\Houses;

use Filament\Schemas\Schema;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use App\Filament\Resources\Houses\Pages\ListHouses;
use App\Filament\Resources\Houses\Pages\CreateHouse;
use App\Filament\Resources\Houses\Pages\EditHouse;
use Filament\Tables\Table;
use Filament\{Forms, Tables};
use Filament\Resources\Resource;
use Filament\Tables\Columns\{ImageColumn, TextColumn};
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\HouseResource\Pages;
use App\Models\{House, Category, Facility, City};
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\HouseResource\RelationManagers;
use Filament\Forms\Components\{Fieldset, TextInput, Select, FileUpload, Grid, Repeater, TextArea};

class HouseResource extends Resource
{
    protected static ?string $model = House::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-home-modern';

    protected static string | \UnitEnum | null $navigationGroup = 'Product';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Fieldset::make('Details')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(6)->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(3),
                            TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->prefix('IDR')
                                ->columnSpan(3),
                            Select::make('category_id')
                                ->label('House Category')
                                ->options(Category::all()->pluck('name', 'id'))
                                ->searchable()
                                ->required()
                                ->columnSpan(2),
                            Select::make('city_id')
                                ->label('City')
                                ->options(City::all()->pluck('name', 'id'))
                                ->searchable()
                                ->required()
                                ->columnSpan(2),
                            Select::make('certificate')
                                ->options([
                                    'SHM' => 'SHM',
                                    'SHGB' => 'SHGB',
                                    'Patches' => 'Patches',
                                ])
                                ->required()
                                ->columnSpan(2),
                            FileUpload::make('thumbnail')
                                ->image()
                                ->required()
                                ->columnSpan(6)
                        ])
                    ]),
                \Filament\Schemas\Components\Fieldset::make('House Photos')
                    ->schema([
                        Repeater::make('photos')
                            ->relationship('photos')
                            ->schema([
                                FileUpload::make('photo')
                                    ->required()
                            ])
                    ])
                    ->columns(1),
                \Filament\Schemas\Components\Fieldset::make('Facilities')
                    ->schema([
                        Repeater::make('facilities')
                            ->relationship('facilities')
                            ->schema([
                                Select::make('facility_id')
                                    ->label('Facility')
                                    ->options(Facility::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required()
                            ])
                    ])
                    ->columns(1),
                \Filament\Schemas\Components\Fieldset::make('Additional')
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(6)->schema([
                            TextArea::make('about')
                                ->required()
                                ->columnSpan(6),
                            TextInput::make('electric')
                                ->required()
                                ->numeric()
                                ->columnSpan(2)
                                ->suffix('watt'),
                            TextInput::make('land_area')
                                ->required()
                                ->numeric()
                                ->columnSpan(2)
                                ->suffix('m²'),
                            TextInput::make('building_area')
                                ->required()
                                ->numeric()
                                ->columnSpan(2)
                                ->suffix('m²'),
                            TextInput::make('bedroom')
                                ->required()
                                ->numeric()
                                ->columnSpan(3)
                                ->suffix('Unit'),
                            TextInput::make('bathroom')
                                ->required()
                                ->numeric()
                                ->columnSpan(3)
                                ->suffix('Unit'),
                        ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail'),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHouses::route('/'),
            'create' => CreateHouse::route('/create'),
            'edit' => EditHouse::route('/{record}/edit'),
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
