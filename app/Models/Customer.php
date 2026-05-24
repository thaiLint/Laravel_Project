<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
   protected $fillable = [
        'photo',
        'name',
        'email',
        'phone',
        'room',
        'status',
        'address'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
