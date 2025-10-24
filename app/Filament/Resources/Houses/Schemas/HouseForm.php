<?php

namespace App\Filament\Resources\Houses\Schemas;

use App\Models\Category;
use App\Models\City;
use App\Models\Facility;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HouseForm
{
    public static function configure(Schema $schema): Schema
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
                                ->columnSpan(6),
                        ]),
                    ]),
                \Filament\Schemas\Components\Fieldset::make('House Photos')
                    ->schema([
                        Repeater::make('photos')
                            ->relationship('photos')
                            ->schema([
                                FileUpload::make('photo')
                                    ->required(),
                            ]),
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
                                    ->required(),
                            ]),
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
                        ]),
                    ]),
            ]);
    }
}
