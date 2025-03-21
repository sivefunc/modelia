<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'generative_model_id',
        'profile_id',
        'link',
        'prompt',
        'attachment',
        'type',
        'photo_size',
        'resolution',
        'views',
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function generative_model(): BelongsTo
    {
        return $this->belongsTo(GenerativeModel::class);
    }
}
