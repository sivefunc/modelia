<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subregion extends Model
{
    //
    protected $fillable = [
        'name',
        'translations',
        'region_id',
        'flag',
        'wikiDataId'
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function country(): HasMany
    {
        return $this->hasMany(Country::class);
    }

}
