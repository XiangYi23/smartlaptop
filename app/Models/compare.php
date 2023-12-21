<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    protected $table = 'compare';

    use HasFactory;

    protected $fillable = [
        'laptop_id', // Add 'product_id' to this array
        'compared_laptop_id',
    ];
    
    public function laptop()
    {
        return $this->belongsTo(laptop::class, 'laptop_id')->with('details');
    }
}