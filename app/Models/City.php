<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_id',
        'state_id',
        'name',
        'state_code',
        'country_code',
        'latitude',
        'longitude',
        'flag',
        'wikiDataId'
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
