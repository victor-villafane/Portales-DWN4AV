<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $primaryKey = "purchase_id";
    protected $fillable = ["user_fk", "amount"];

    public function casts(){
        return [
            'payed_at' => "datetime"
        ];
    }

    public function movies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            Movie::class,
            'purchases_have_movies',
            'purchase_fk',
            'movie_fk',
            'purchase_id',
            'movie_id'
        )
        ->withPivot('queantity', 'unit_price')
        ->withTimestamps();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_fk', 'id');
    }
}

