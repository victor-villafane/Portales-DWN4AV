<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';
    protected $primaryKey = 'movie_id';

    protected $fillable = [
        'title',
        'price',
        'release_date',
        'synopsis',
        'rating_fk'
    ];

    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class, 'rating_fk', 'rating_id');
    }
}
