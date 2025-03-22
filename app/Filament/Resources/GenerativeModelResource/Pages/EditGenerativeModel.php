<?php

namespace App\Filament\Resources\GenerativeModelResource\Pages;

use App\Filament\Resources\GenerativeModelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGenerativeModel extends EditRecord
{
    protected static string $resource = GenerativeModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
