<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
