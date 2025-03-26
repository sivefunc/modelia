<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Profile;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class ProfileChart extends ChartWidget
{
    use HasWidgetShield;
    protected static ?string $pollingInterval = null;
    protected static bool $isLazy = false;
    protected static ?string $heading = 'Profile';
    protected static string $color = 'warning';
    protected static ?int $sort = 2;


    protected function getData(): array
    {
        //
        $data = Trend::model(Profile::class)->between(
            start: now()->subYear(), end: now(),
            )
            ->perMonth()
            ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Profiles at the platform',
                    'data' => $data->map(fn(TrendValue $value) =>
                    $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
