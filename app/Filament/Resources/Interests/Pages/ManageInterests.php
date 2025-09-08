<?php

namespace App\Filament\Resources\Interests\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Interests\InterestResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageInterests extends ManageRecords
{
    protected static string $resource = InterestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
