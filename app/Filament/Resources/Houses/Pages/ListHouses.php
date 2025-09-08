<?php

namespace App\Filament\Resources\Houses\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Houses\HouseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHouses extends ListRecords
{
    protected static string $resource = HouseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
