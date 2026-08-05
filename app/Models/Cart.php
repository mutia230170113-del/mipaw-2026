<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Keranjang milik customer
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // Satu keranjang memiliki banyak item
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}