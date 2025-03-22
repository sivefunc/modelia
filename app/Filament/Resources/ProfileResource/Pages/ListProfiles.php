<?php

namespace App\Filament\Resources\ProfileResource\Pages;

use App\Filament\Resources\ProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;

class ListProfiles extends ListRecords
{
    protected static string $resource = ProfileResource::class;

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
            'This Week' => Tab::make()
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where(
                        'created_at', '>=', now()->subWeek()
                    )
                )
                ->badge(Profile::query()->where(
                    'created_at', '>=', now()->subWeek())->count()
                ),
            'This Month' => Tab::make()
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where(
                        'created_at', '>=', now()->subMonth()
                    )
                )
                ->badge(Profile::query()->where(
                    'created_at', '>=', now()->subMonth())->count()
                ),
            'This Year' => Tab::make()
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where(
                        'created_at', '>=', now()->subYear()
                    )
                )
                ->badge(Profile::query()->where(
                    'created_at', '>=', now()->subYear())->count()
                ),
        ];
    }
}
