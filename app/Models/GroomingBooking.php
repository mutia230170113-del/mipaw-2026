<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroomingBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'pet_id',
        'service_id',
        'tanggal',
        'jam',
        'status',
        'qr_booking'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function service()
    {
        return $this->belongsTo(GroomingService::class);
    }

    // TAMBAHKAN INI
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}