<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroomingService extends Model
{
    use HasFactory;


    protected $fillable = [
        'nama_layanan',
        'harga',
        'durasi',
        'deskripsi'
    ];


    public function bookings()
    {
        return $this->hasMany(GroomingBooking::class);
    }
}