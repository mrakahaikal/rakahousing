<?php

namespace App\Filament\Resources\Facilities\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Facilities\FacilityResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFacilities extends ManageRecords
{
    protected static string $resource = FacilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
