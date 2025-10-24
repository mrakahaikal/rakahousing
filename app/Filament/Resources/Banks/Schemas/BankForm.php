<?php

namespace App\Filament\Resources\Banks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BankForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->maxLength(255)
                    ->required(),
                FileUpload::make('photo')
                    ->required()
                    ->image(),
            ])
            ->columns(1);
    }
}
