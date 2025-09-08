<?php

namespace App\Filament\Resources\Roles\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Roles\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageRoles extends ManageRecords
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
