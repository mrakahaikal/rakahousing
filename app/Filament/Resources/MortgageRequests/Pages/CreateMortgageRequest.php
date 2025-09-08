<?php

namespace App\Filament\Resources\MortgageRequests\Pages;

use App\Filament\Resources\MortgageRequests\MortgageRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMortgageRequest extends CreateRecord
{
    protected static string $resource = MortgageRequestResource::class;
}
