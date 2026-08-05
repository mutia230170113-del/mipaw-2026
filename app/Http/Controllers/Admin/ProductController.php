<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();

        return view(
            'admin.products.create',
            compact('categories')
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id'=>'required',
            'nama_produk'=>'required',
            'harga'=>'required|numeric',
            'stok'=>'required|numeric',
            'gambar'=>'nullable|image|max:2048',
            'barcode'=>'required|unique:products,barcode' 
        ], [
            'barcode.required' => 'Kolom barcode wajib diisi!',
            // Teks pesan error yang diubah sesuai request baru Anda
            'barcode.unique'   => 'Barcode ini sudah digunakan!'
        ]);


        $gambar = null;


        if($request->hasFile('gambar')){

            $gambar = $request
                ->file('gambar')
                ->store('products','public');

        }


        Product::create([

            'category_id'=>$request->category_id,
            'nama_produk'=>$request->nama_produk,
            'harga'=>$request->harga,
            'stok'=>$request->stok,
            'gambar'=>$gambar,
            'barcode'=>$request->barcode,
            'deskripsi'=>$request->deskripsi

        ]);


        return redirect()
            ->route('products.index')
            ->with('success','Produk berhasil ditambahkan');
    }



    public function show(Product $product)
    {
        return view(
            'admin.products.show',
            compact('product')
        );
    }



    public function edit(Product $product)
    {
        $categories = Category::all();

        return view(
            'admin.products.edit',
            compact('product','categories')
        );
    }



    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'=>'required',
            'nama_produk'=>'required',
            'harga'=>'required|numeric',
            'stok'=>'required|numeric',
            'gambar'=>'nullable|image|max:2048',
            'barcode'=>'required|unique:products,barcode,' . $product->id
        ], [
            'barcode.required' => 'Kolom barcode wajib diisi!',
            // Teks pesan error edit disamakan agar seragam
            'barcode.unique'   => 'Barcode ini sudah digunakan!'
        ]);


        $gambar = $product->gambar;


        if($request->hasFile('gambar')){

            $gambar = $request
                ->file('gambar')
                ->store('products','public');

        }


        $product->update([

            'category_id'=>$request->category_id,
            'nama_produk'=>$request->nama_produk,
            'harga'=>$request->harga,
            'stok'=>$request->stok,
            'gambar'=>$gambar,
            'barcode'=>$request->barcode,
            'deskripsi'=>$request->deskripsi

        ]);


        return redirect()
            ->route('products.index')
            ->with('success','Produk berhasil diperbarui');
    }



    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success','Produk berhasil dihapus');
    }

}
