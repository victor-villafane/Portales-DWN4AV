<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'rating_fk',
        'cover',
        'cover_description'
    ];

    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class, 'rating_fk', 'rating_id');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(
            Genre::class,
            'movies_have_genres', // Pivot table name
            'movie_fk', // Foreign key on the pivot table referencing the movies table
            'genre_fk', // Foreign key on the pivot table referencing the genres table
            'movie_id', // Local key on the movies table
            'genre_id'  // Local key on the genres table
         );
    }
}
