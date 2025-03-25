<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GenerativeModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cost',
        'endpoint',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

}
