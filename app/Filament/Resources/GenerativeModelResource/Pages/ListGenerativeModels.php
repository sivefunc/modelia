<?php

namespace App\Filament\Resources\GenerativeModelResource\Pages;

use App\Filament\Resources\GenerativeModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use App\Models\GenerativeModel;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;

class ListGenerativeModels extends ListRecords
{
    protected static string $resource = GenerativeModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            '$5 upto $10' => Tab::make()
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where(
                        'cost', '>=', 5
                    )->where('cost', '<=', 10)
                )
                ->badge(GenerativeModel::query()->where(
                    'cost', '>=', 5)->where('cost', '<=', 10)->count()
                ),
            '$11 upto $15' => Tab::make()
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where(
                        'cost', '>=', 11
                    )->where('cost', '<=', 15)
                )
                ->badge(GenerativeModel::query()->where(
                    'cost', '>=', 11)->where('cost', '<=', 15)->count()
                ),
            'Greater than $15' => Tab::make()
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where(
                        'cost', '>=', 15
                    )
                )
                ->badge(GenerativeModel::query()->where(
                    'cost', '>=', 15)->count()
                ),
        ];
    }
}
