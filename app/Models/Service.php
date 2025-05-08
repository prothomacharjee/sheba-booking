<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'price', 'description'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
