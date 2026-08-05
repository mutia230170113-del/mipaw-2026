<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;


    protected $fillable = [
        'customer_id',
        'product_id',
        'rating',
        'komentar'
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}