<?php

namespace App\Filament\Resources;

use Filament\Forms\Form;
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

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?string $navigationGroup = 'Product';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Details')
                    ->schema([
                        Grid::make(6)->schema([
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
                Fieldset::make('House Photos')
                    ->schema([
                        Repeater::make('photos')
                            ->relationship('photos')
                            ->schema([
                                FileUpload::make('photo')
                                    ->required()
                            ])
                    ])
                    ->columns(1),
                Fieldset::make('Facilities')
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
                Fieldset::make('Additional')
                    ->schema([
                        Grid::make(6)->schema([
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListHouses::route('/'),
            'create' => Pages\CreateHouse::route('/create'),
            'edit' => Pages\EditHouse::route('/{record}/edit'),
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
