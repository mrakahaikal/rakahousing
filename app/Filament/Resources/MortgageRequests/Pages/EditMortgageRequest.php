<?php

namespace App\Filament\Resources\MortgageRequests\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use App\Filament\Resources\MortgageRequests\MortgageRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMortgageRequest extends EditRecord
{
    protected static string $resource = MortgageRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
