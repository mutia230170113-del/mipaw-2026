<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_id',
        'nama_produk',
        'harga',
        'stok',
        'gambar',
        'barcode',
        'deskripsi'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    // Produk yang masuk wishlist customer
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}