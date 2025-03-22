<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use App\Models\Image;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;

class ListImages extends ListRecords
{
    protected static string $resource = ImageResource::class;

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
                    )->where('created_at', '<=', now())
                )
                ->badge(Image::query()->where(
                    'created_at', '>=', now()->subWeek()
                )->where('created_at', '<=', now())->count()
            ),
            'This Month' => Tab::make()
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where(
                        'created_at', '>=', now()->subMonth()
                    )->where('created_at', '<=', now())
                )
                ->badge(Image::query()->where(
                    'created_at', '>=', now()->subMonth()
                )->where('created_at', '<=', now())->count()
            ),
            'This Year' => Tab::make()
                ->modifyQueryUsing(
                    fn (Builder $query) => $query->where(
                        'created_at', '>=', now()->subYear()
                    )->where('created_at', '<=', now())
                )
                ->badge(Image::query()->where(
                    'created_at', '>=', now()->subYear()
                )->where('created_at', '<=', now())->count()
            ),
        ];
    }
}
