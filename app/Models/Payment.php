<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [

        'invoice',

        'customer_id',

        'order_id',

        'grooming_booking_id',

        'total',

        'metode',

        'bukti',

        'status',

        'paid_at',

    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function groomingBooking()
    {
        return $this->belongsTo(GroomingBooking::class);
    }
}