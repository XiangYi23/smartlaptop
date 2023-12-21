<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorites extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'user_id',
        'laptop_id'
    ];

    public function laptop()
    {
        return $this->belongsTo(Laptop::class, 'laptop_id');
    }
}
