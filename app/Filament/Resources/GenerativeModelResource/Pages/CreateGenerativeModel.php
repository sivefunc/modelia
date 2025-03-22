<?php

namespace App\Filament\Resources\GenerativeModelResource\Pages;

use App\Filament\Resources\GenerativeModelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGenerativeModel extends CreateRecord
{
    protected static string $resource = GenerativeModelResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
