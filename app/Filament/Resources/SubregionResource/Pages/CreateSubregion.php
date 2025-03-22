<?php

namespace App\Filament\Resources\SubregionResource\Pages;

use App\Filament\Resources\SubregionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubregion extends CreateRecord
{
    protected static string $resource = SubregionResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
