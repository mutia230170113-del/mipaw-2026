@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Tambah Pembayaran 💳
        </h1>

        <p class="text-gray-500 mt-2">
            Tambahkan pembayaran untuk transaksi produk maupun grooming.
        </p>

    </div>

    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form
            action="{{ route('payments.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @if(session('error'))
            <div class="mb-5 bg-red-100 text-red-700 px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
            @endif

            {{-- Jenis Transaksi --}}
            <div class="mb-6">

                <label class="block font-semibold text-[#5A3928] mb-2">

                    Jenis Transaksi

                </label>

                <select
                    id="jenis_transaksi"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                    <option value="order"
                        {{
                            old('grooming_booking_id', optional($selectedBooking)->id)
                            ? ''
                            : 'selected'
                        }}>
                        🛒 Order Produk
                    </option>

                    <option value="grooming"
                        {{
                            old('grooming_booking_id', optional($selectedBooking)->id)
                            ? 'selected'
                            : ''
                        }}>
                        ✂️ Booking Grooming
                    </option>

                </select>

            </div>



            {{-- ORDER PRODUK --}}
            <div id="orderBox">

                <div class="mb-5">

                    <label class="block font-semibold text-[#5A3928] mb-2">

                        Order Produk

                    </label>

                    <select
                        id="orderSelect"
                        name="order_id"
                        class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                        <option value="">

                            -- Pilih Order --

                        </option>

                        @foreach($orders as $order)

                            <option

                                value="{{ $order->id }}"

                                data-customer="{{ $order->customer->user->name }}"

                                data-total="{{ $order->total }}">

                                {{ $order->invoice }}

                                -

                                {{ $order->customer->user->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>



            {{-- BOOKING GROOMING --}}
            <div id="groomingBox" class="hidden">

                <div class="mb-5">

                    <label class="block font-semibold text-[#5A3928] mb-2">

                        Booking Grooming

                    </label>

                    <select
                        id="bookingSelect"
                        name="grooming_booking_id"
                        class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                        <option value="">

                            -- Pilih Booking --

                        </option>

                        @foreach($bookings as $booking)

                            <option
                                value="{{ $booking->id }}"
                                data-customer="{{ $booking->customer->user->name }}"
                                data-total="{{ $booking->service->harga }}"
                                {{
                                    old('grooming_booking_id', optional($selectedBooking)->id)
                                    == $booking->id
                                    ? 'selected'
                                    : ''
                          }}>

                        @endforeach

                    </select>

                </div>

            </div>



            {{-- Customer --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">

                    Customer

                </label>

                <input
                    id="customer"
                    type="text"
                    readonly
                    class="w-full rounded-2xl border border-gray-300 bg-gray-100 px-4 py-3">

            </div>



            {{-- Total --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">

                    Total Pembayaran

                </label>

                <input
                    id="total"
                    type="text"
                    readonly
                    class="w-full rounded-2xl border border-gray-300 bg-gray-100 px-4 py-3">

            </div>



            {{-- Metode --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">

                    Metode Pembayaran

                </label>

                <select
                    name="metode"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                    <option value="cash">

                        💵 Cash

                    </option>

                    <option value="qris">

                        📱 QRIS

                    </option>

                </select>

            </div>



            {{-- Bukti --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">

                    Bukti Pembayaran

                </label>

                <input
                    type="file"
                    name="bukti"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                <p class="text-sm text-gray-400 mt-2">

                    Kosongkan jika pembayaran dilakukan secara Cash.

                </p>

            </div>



            {{-- Status --}}
            <div class="mb-8">

                <label class="block font-semibold text-[#5A3928] mb-2">

                    Status

                </label>

                <select
                    name="status"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                    <option value="pending">

                        Pending

                    </option>

                    <option value="verified">

                        Verified

                    </option>

                    <option value="rejected">

                        Rejected

                    </option>

                </select>

            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl font-semibold transition">

                    💾 Simpan Pembayaran

                </button>

                <a
                    href="{{ route('payments.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-2xl font-semibold transition">

                    ← Kembali

                </a>

            </div>

        </form>

    </div>

</div>

<script>

const jenisTransaksi = document.getElementById('jenis_transaksi');

const orderBox = document.getElementById('orderBox');
const groomingBox = document.getElementById('groomingBox');

const orderSelect = document.getElementById('orderSelect');
const bookingSelect = document.getElementById('bookingSelect');

const customer = document.getElementById('customer');
const total = document.getElementById('total');


// =======================
// Format Rupiah
// =======================

function formatRupiah(angka){

    return "Rp " + Number(angka).toLocaleString('id-ID');

}


// =======================
// Reset Informasi
// =======================

function resetInfo(){

    customer.value = "";
    total.value = "";

}


// =======================
// Ubah Jenis Transaksi
// =======================

jenisTransaksi.addEventListener('change', function(){

    resetInfo();

    if(this.value === "order"){

        orderBox.classList.remove('hidden');
        groomingBox.classList.add('hidden');

        orderSelect.disabled = false;
        orderSelect.required = true;

        bookingSelect.disabled = true;
        bookingSelect.required = false;
        bookingSelect.value = "";

    }else{

        groomingBox.classList.remove('hidden');
        orderBox.classList.add('hidden');

        bookingSelect.disabled = false;
        bookingSelect.required = true;

        orderSelect.disabled = true;
        orderSelect.required = false;
        orderSelect.value = "";

    }

});


// =======================
// Order Produk
// =======================

orderSelect.addEventListener('change', function(){

    const option = this.options[this.selectedIndex];

    customer.value = option.dataset.customer ?? "";

    total.value = option.dataset.total
        ? formatRupiah(option.dataset.total)
        : "";

});


// =======================
// Booking Grooming
// =======================

bookingSelect.addEventListener('change', function(){

    const option = this.options[this.selectedIndex];

    customer.value = option.dataset.customer ?? "";

    total.value = option.dataset.total
        ? formatRupiah(option.dataset.total)
        : "";

});


// =======================
// Default Pertama
// =======================

        window.onload = function () {

        if (jenisTransaksi.value === "grooming") {

            groomingBox.classList.remove("hidden");
            orderBox.classList.add("hidden");

            bookingSelect.disabled = false;
            bookingSelect.required = true;

            orderSelect.disabled = true;
            orderSelect.required = false;

            if (bookingSelect.value !== "") {

                const option = bookingSelect.options[bookingSelect.selectedIndex];

                customer.value = option.dataset.customer ?? "";

                total.value = option.dataset.total
                    ? formatRupiah(option.dataset.total)
                    : "";
            }

        } else {

            orderBox.classList.remove("hidden");
            groomingBox.classList.add("hidden");

            orderSelect.disabled = false;
            orderSelect.required = true;

            bookingSelect.disabled = true;
            bookingSelect.required = false;

            if (orderSelect.value !== "") {

                const option = orderSelect.options[orderSelect.selectedIndex];

                customer.value = option.dataset.customer ?? "";

                total.value = option.dataset.total
                    ? formatRupiah(option.dataset.total)
                    : "";
            }

        }

    };
</script>
@endsection