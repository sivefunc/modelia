<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GenerativeModel extends Model
{
    protected $fillable = [
        'name',
        'cost',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

}
