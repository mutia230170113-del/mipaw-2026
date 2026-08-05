@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Tambah Order 📦
            </h1>

            <p class="text-gray-500 mt-2">
                Tambahkan pesanan baru customer MiPaw.
            </p>

        </div>

        <a href="{{ route('orders.index') }}"
            class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-2xl">

            ← Kembali

        </a>

    </div>

    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form
            action="{{ route('orders.store') }}"
            method="POST">

            @csrf

            {{-- Customer --}}
            <div class="mb-5">

                <label class="font-semibold text-[#5A3928]">

                    Customer

                </label>

                <select
                    name="customer_id"
                    class="w-full mt-2 rounded-2xl border-gray-300"
                    required>

                    <option value="">

                        -- Pilih Customer --

                    </option>

                    @foreach($customers as $customer)

                        <option
                            value="{{ $customer->id }}">

                            {{ $customer->user->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Invoice --}}
            <div class="mb-5">

                <label class="font-semibold text-[#5A3928]">

                    Invoice

                </label>

                <input
                    type="text"
                    name="invoice"
                    value="INV-{{ date('YmdHis') }}"
                    class="w-full mt-2 rounded-2xl border-gray-300 bg-gray-100"
                    readonly>

            </div>


            {{-- Tanggal --}}
            <div class="mb-8">

                <label class="font-semibold text-[#5A3928]">

                    Tanggal

                </label>

                <input
                    type="date"
                    name="tanggal"
                    value="{{ date('Y-m-d') }}"
                    class="w-full mt-2 rounded-2xl border-gray-300"
                    required>

            </div>

            {{-- Produk akan kita lanjutkan di Potongan 2 --}}

            {{-- Produk --}}
            <div class="mb-8">

                <div class="flex justify-between items-center mb-4">

                    <h2 class="text-xl font-bold text-[#5A3928]">

                        Daftar Produk

                    </h2>

                    <button
                        type="button"
                        id="tambahProduk"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl">

                        + Tambah Produk

                    </button>

                </div>

                <div id="produkContainer">

                    <div class="produk-item border rounded-2xl p-5 mb-4 bg-gray-50">

                        <div class="grid grid-cols-2 gap-5">

                            <div>

                                <label class="font-semibold">

                                    Produk

                                </label>

                                <select
                                    name="product_id[]"
                                    class="produk w-full mt-2 rounded-2xl border-gray-300"
                                    required>

                                    <option value="">

                                        -- Pilih Produk --

                                    </option>

                                    @foreach($products as $product)

                                        <option
                                            value="{{ $product->id }}"
                                            data-harga="{{ $product->harga }}">

                                            {{ $product->nama_produk }}
                                            -
                                            Rp {{ number_format($product->harga,0,',','.') }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <div>

                                <label class="font-semibold">

                                    Qty

                                </label>

                                <input
                                    type="number"
                                    name="qty[]"
                                    class="qty w-full mt-2 rounded-2xl border-gray-300"
                                    min="1"
                                    value="1">

                            </div>

                        </div>

                        <div class="text-right mt-4">

                            <button
                                type="button"
                                class="hapusProduk bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl">

                                Hapus

                            </button>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Total --}}
            <div class="mb-8">

                <label class="font-semibold text-[#5A3928]">

                    Total Pembayaran

                </label>

                <input
                    type="text"
                    id="totalDisplay"
                    class="w-full mt-2 rounded-2xl border-gray-300 bg-gray-100"
                    value="Rp 0"
                    readonly>

            </div>

            <input
                type="hidden"
                name="total"
                id="totalValue">
                            
            {{-- Status --}}
                    <div class="mb-8">

                        <label class="font-semibold text-[#5A3928]">

                            Status

                        </label>

                        <select
                            name="status"
                            class="w-full mt-2 rounded-2xl border-gray-300">

                            <option value="pending">Pending</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                            <option value="dibatalkan">Dibatalkan</option>

                        </select>

                    </div>


                    {{-- Tombol --}}
                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl">

                            💾 Simpan Order

                        </button>

                        <a
                            href="{{ route('orders.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 px-8 py-3 rounded-2xl">

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

        {{-- Template Produk --}}
        <template id="produkTemplate">

        <div class="produk-item border rounded-2xl p-5 mb-4 bg-gray-50">

            <div class="grid grid-cols-2 gap-5">

                <div>

                    <label class="font-semibold">

                        Produk

                    </label>

                    <select
                        name="product_id[]"
                        class="produk w-full mt-2 rounded-2xl border-gray-300">

                        <option value="">-- Pilih Produk --</option>

                        @foreach($products as $product)

                            <option
                                value="{{ $product->id }}"
                                data-harga="{{ $product->harga }}">

                                {{ $product->nama_produk }}
                                -
                                Rp {{ number_format($product->harga,0,',','.') }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div>

                    <label class="font-semibold">

                        Qty

                    </label>

                    <input
                        type="number"
                        name="qty[]"
                        value="1"
                        min="1"
                        class="qty w-full mt-2 rounded-2xl border-gray-300">

                </div>

            </div>

            <div class="text-right mt-4">

                <button
                    type="button"
                    class="hapusProduk bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl">

                    Hapus

                </button>

            </div>

        </div>

        </template>

        <script>

        document.addEventListener('DOMContentLoaded', function () {

            const container = document.getElementById('produkContainer');
            const template = document.getElementById('produkTemplate');
            const btnTambah = document.getElementById('tambahProduk');
            const totalDisplay = document.getElementById('totalDisplay');
            const totalValue = document.getElementById('totalValue');

            btnTambah.addEventListener('click', function () {

                const clone = template.content.cloneNode(true);

                container.appendChild(clone);

                pasangEvent();

            });

            function pasangEvent(){

                document.querySelectorAll('.hapusProduk').forEach(btn=>{

                    btn.onclick=function(){

                        if(document.querySelectorAll('.produk-item').length>1){

                            this.closest('.produk-item').remove();

                            hitungTotal();

                        }

                    }

                });

                document.querySelectorAll('.produk').forEach(select=>{

                    select.onchange=hitungTotal;

                });

                document.querySelectorAll('.qty').forEach(qty=>{

                    qty.oninput=hitungTotal;

                });

            }

            function hitungTotal(){

                let total=0;

                document.querySelectorAll('.produk-item').forEach(item=>{

                    const produk=item.querySelector('.produk');

                    const qty=item.querySelector('.qty');

                    const harga=produk.options[produk.selectedIndex]?.dataset?.harga ?? 0;

                    total += parseInt(harga) * parseInt(qty.value || 0);

                });

                totalDisplay.value='Rp '+total.toLocaleString('id-ID');

                totalValue.value=total;

            }

            pasangEvent();

            hitungTotal();

        });

    </script>

        @endsection