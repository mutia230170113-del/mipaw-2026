<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartUpdateController extends Controller
{
    public function kurangi(Request $request, $id)
    {
        // Mencari data di tabel keranjang milik customer yang sedang login
        $cartItem = Cart::where('user_id', auth()->id())
                        ->orWhere('customer_id', $id)
                        ->first();

        // Jika tidak ketemu lewat query di atas, kita cari langsung pakai ID keranjang
        if (!$cartItem) {
            $cartItem = Cart::find($id);
        }

        if ($cartItem) {
            if ($cartItem->qty <= 1) {
                $cartItem->delete();
            } else {
                $cartItem->decrement('qty');
            }
        }

        return redirect()->back()->with('success', 'Jumlah berhasil dikurangi');
    }
}
