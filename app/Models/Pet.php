<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasFactory;


    protected $fillable = [
        'customer_id',
        'nama_hewan',
        'jenis',
        'ras',
        'umur',
        'berat',
        'catatan'
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function groomingBookings()
    {
        return $this->hasMany(GroomingBooking::class);
    }
}