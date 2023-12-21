<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;

    protected $fillable=['user_id','laptop_id','comment','rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function laptop()
    {
        return $this->belongsTo(Laptop::class);
    }
}
