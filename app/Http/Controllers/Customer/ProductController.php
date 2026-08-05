<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Daftar Produk Customer
     */
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Pencarian produk
        if ($request->filled('search')) {

            $query->where(
                'nama_produk',
                'like',
                '%' . $request->search . '%'
            );

        }

        // Filter kategori
        if ($request->filled('category')) {

            $query->where(
                'category_id',
                $request->category
            );

        }

        $products = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = Category::all();

        return view(
            'customer.products.index',
            compact(
                'products',
                'categories'
            )
        );
    }

    /**
     * Detail Produk
     */
    public function show(Product $product)
    {
        $product->load('category');

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view(
            'customer.products.show',
            compact(
                'product',
                'relatedProducts'
            )
        );
    }
}