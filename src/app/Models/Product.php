<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Season;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    public function seasons()
    {
    return $this->belongsToMany(Season::class, 'product_season', 'product_id', 'season_id');
    }
}