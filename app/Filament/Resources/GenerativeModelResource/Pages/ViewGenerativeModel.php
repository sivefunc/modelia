<?php

namespace App\Filament\Resources\GenerativeModelResource\Pages;

use App\Filament\Resources\GenerativeModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGenerativeModel extends ViewRecord
{
    protected static string $resource = GenerativeModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
