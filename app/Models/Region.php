<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    protected $fillable = [
        'name',
        'translations',
        'flag',
        'wikiDataId'
    ];

    public function subregion(): HasMany
    {
        return $this->hasMany(Subregion::class);
    }

    public function country(): HasMany
    {
        return $this->hasMany(Country::class);
    }
}
