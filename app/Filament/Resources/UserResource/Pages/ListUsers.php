<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

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
                ->badge(User::query()->where(
                    'created_at', '>=', now()->subWeek())->count()
                ),
            'This Month' => Tab::make()
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where(
                        'created_at', '>=', now()->subMonth()
                    )
                )
                ->badge(User::query()->where(
                    'created_at', '>=', now()->subMonth())->count()
                ),
            'This Year' => Tab::make()
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where(
                        'created_at', '>=', now()->subYear()
                    )
                )
                ->badge(User::query()->where(
                    'created_at', '>=', now()->subYear())->count()
                ),
        ];
    }
}
