<?php

namespace App\Filament\Resources\MortgageRequests\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\MortgageRequests\MortgageRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMortgageRequests extends ListRecords
{
    protected static string $resource = MortgageRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
