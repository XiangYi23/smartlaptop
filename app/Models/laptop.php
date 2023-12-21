<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laptop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'image', 'price','manufacturer','process_model','graphics',
        'display_technology','screen_size','screen_resolution','memory','storage',
        'operating_system','connectivity','camera','ports','battery','height','width','depth','weight','type',
        'shopee','lazada','filter'
    ];

    public function details()
    {
        return $this->hasOne(compare::class);
    }

    public function isFavoritedByUser($userId)
    {
        return $this->favorites->where('user_id', $userId)->count() > 0;
    }

    public function favorites()
    {
        return $this->hasMany(Favorites::class, 'laptop_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0.0;
    }
}
