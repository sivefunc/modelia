<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Image;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class ImageChart extends ChartWidget
{
    protected static ?string $pollingInterval = null;
    protected static bool $isLazy = false;
    protected static ?string $heading = 'Image';
    protected static string $color = 'primary';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        //
        $data = Trend::model(Image::class)->between(
            start: now()->subYear(), end: now(),
            )
            ->perMonth()
            ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Images at the platform',
                    'data' => $data->map(fn(TrendValue $value) =>
                    $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
