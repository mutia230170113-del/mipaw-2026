@extends('layouts.customer')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-[#5A3928]">
                Keranjang Belanja 🛒
            </h1>
            <p class="text-gray-600 mt-1">
                Produk yang akan kamu checkout.
            </p>
        </div>

        <a href="{{ route('customer.products') }}"
            class="bg-[#6B412C] text-white px-6 py-3 rounded-xl hover:bg-[#5A3928]">
            + Belanja Lagi
        </a>
    </div>

    @if($carts->count())

    <!-- FORM UTAMA CHECKOUT ALA SHOPEE -->
    <form action="{{ route('customer.cart.checkout') }}" method="POST" id="form-checkout-shopee">
        @csrf

        <div class="bg-white rounded-3xl shadow overflow-hidden mb-8">
            <table class="w-full">
                <thead class="bg-[#F5E6D3]">
                    <tr>
                        <th class="text-center px-4 py-4 w-16">
                            <input type="checkbox" id="pilih-semua" class="w-5 h-5 rounded border-gray-300 text-[#6B412C] focus:ring-[#6B412C]" checked>
                        </th>
                        <th class="text-left py-4">Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right pr-6">Subtotal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($carts as $cart)
                    <tr class="border-t item-keranjang">
                        
                        <!-- Checkbox Shopee -->
                        <td class="text-center px-4">
                            <input type="checkbox" name="cart_ids[]" value="{{ $cart->id }}" 
                                   data-subtotal="{{ $cart->qty * $cart->harga }}" 
                                   class="checkbox-produk w-5 h-5 rounded border-gray-300 text-[#6B412C] focus:ring-[#6B412C]" checked>
                        </td>

                        <!-- Detail Produk -->
                        <td class="py-5">
                            <div class="flex items-center gap-4">
                                @if($cart->product->gambar)
                                    <img src="{{ asset('storage/'.$cart->product->gambar) }}" class="w-20 h-20 rounded-xl object-cover">
                                @else
                                    <div class="w-20 h-20 rounded-xl bg-[#F5E6D3] flex items-center justify-center text-2xl">🐾</div>
                                @endif

                                <div>
                                    <h2 class="font-bold">{{ $cart->product->nama_produk }}</h2>
                                    <p class="text-gray-500 text-sm">{{ $cart->product->category->nama_kategori }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- TOMBOL TAMBAH & KURANG (Sudah Diperbaiki Mengirim Objek Product ID yang Tepat) -->
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="updateQtyDirect('{{ $cart->product->id }}', 'kurang')" 
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-3 py-1 rounded-lg transition text-sm">-</button>
                                
                                <span class="font-bold text-base px-1">{{ $cart->qty }}</span>
                                
                                <button type="button" onclick="updateQtyDirect('{{ $cart->product->id }}', 'tambah')" 
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-3 py-1 rounded-lg transition text-sm">+</button>
                            </div>
                        </td>

                        <td class="text-right">
                            Rp {{ number_format($cart->harga, 0, ',', '.') }}
                        </td>

                        <td class="text-right pr-6 font-bold text-green-600">
                            Rp {{ number_format($cart->qty * $cart->harga, 0, ',', '.') }}
                        </td>

                        <!-- Tombol Hapus Bawaan -->
                        <td class="text-center">
                            <button type="button" onclick="hapusItemKeranjang('{{ $cart->id }}')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Total --}}
        <div class="bg-white rounded-3xl shadow p-8">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold">Total Belanja</h2>
                </div>
                <div class="text-right">
                    <h1 class="text-4xl font-bold text-green-600" id="total-belanja-tampil">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </h1>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" id="btn-checkout-shopee"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-10 py-4 rounded-2xl font-bold transition">
                    Checkout
                </button>
            </div>
        </div>
    </form>

    <!-- FORM TERSEMBUNYI UNTUK UPDATE & HAPUS AGAR JALUR ROUTING AMAN -->
    <form id="form-aksi-hidden" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="aksi" id="input-aksi-hidden">
    </form>

    <form id="form-hapus-hidden" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    @else
    <div class="bg-white rounded-3xl shadow p-20 text-center">
        <div class="text-7xl">🛒</div>
        <h2 class="text-3xl font-bold mt-6">Keranjang masih kosong</h2>
        <p class="text-gray-500 mt-3">Yuk mulai belanja kebutuhan hewan peliharaanmu.</p>
        <a href="{{ route('customer.products') }}" class="inline-block mt-8 bg-[#6B412C] text-white px-8 py-4 rounded-xl">
            Belanja Sekarang
        </a>
    </div>
    @endif
</div>

<!-- ------------------------------------------------------------------------- -->
<!-- SCRIPT JAVASCRIPT FIX HITUNG OTOMATIS & ROUTE MODEL BINDING PRODUCT       -->
<!-- ------------------------------------------------------------------------- -->
<script>
// Perbaikan Utama: Memanggil URL /customer/cart/ (Rute store bawaan resource milik teman Anda)
function updateQtyDirect(productId, aksi) {
    var form = document.getElementById('form-aksi-hidden');
    var inputAksi = document.getElementById('input-aksi-hidden');
    
    inputAksi.value = aksi;
    // Mengarahkan ke rute store yang meminta objek produk secara sah
    form.action = "/customer/cart/" + productId;
    form.submit();
}

function hapusItemKeranjang(cartItemId) {
    if (confirm('Hapus produk dari keranjang?')) {
        var form = document.getElementById('form-hapus-hidden');
        form.action = "/customer/cart/" + cartItemId;
        form.submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var pilihSemua = document.getElementById('pilih-semua');
    var checkboxes = document.querySelectorAll('.checkbox-produk');
    var totalTampil = document.getElementById('total-belanja-tampil');
    var formCheckout = document.getElementById('form-checkout-shopee');
    var btnCheckout = document.getElementById('btn-checkout-shopee');

    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function hitungTotal() {
        var total = 0;
        var adaYangDicentang = false;

        checkboxes.forEach(function(cb) {
            if (cb.checked) {
                total += parseInt(cb.getAttribute('data-subtotal'));
                adaYangDicentang = true;
            }
        });

        totalTampil.innerText = formatRupiah(total);

        if (!adaYangDicentang) {
            btnCheckout.disabled = true;
            btnCheckout.classList.add('opacity-50', 'cursor-not-allowed');
            btnCheckout.classList.remove('hover:bg-[#5A3928]');
        } else {
            btnCheckout.disabled = false;
            btnCheckout.classList.remove('opacity-50', 'cursor-not-allowed');
            btnCheckout.classList.add('hover:bg-[#5A3928]');
        }
    }

    if (pilihSemua) {
        pilihSemua.addEventListener('change', function() {
            checkboxes.forEach(function(cb) {
                cb.checked = pilihSemua.checked;
            });
            hitungTotal();
        });
    }

    checkboxes.forEach(function(cb) {
        cb.addEventListener('change', function() {
            var semuaTercentang = Array.from(checkboxes).every(c => c.checked);
            if (pilihSemua) pilihSemua.checked = semuaTercentang;
            hitungTotal();
        });
    });

    if (formCheckout) {
        formCheckout.addEventListener('submit', function(e) {
            var adaYangDicentang = Array.from(checkboxes).some(c => c.checked);
            if (!adaYangDicentang) {
                e.preventDefault();
                alert('Silakan pilih minimal satu produk untuk di-checkout!');
            }
        });
    }

    hitungTotal();
});
</script>

@endsection
