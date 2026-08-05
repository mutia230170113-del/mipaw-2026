<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Struk Pembayaran MiPaw</title>

    @vite(['resources/css/app.css'])

    <style>

        body{

            background:#F5E6D3;
            font-family:Arial, Helvetica, sans-serif;
            padding:40px;

        }

        .receipt{
            width:380px;
            margin:0 auto;
            background:#fff;
            border-radius:18px;
            box-shadow:0 10px 30px rgba(0,0,0,.12);
            padding:35px 30px;
            box-sizing:border-box;
        }

        hr{

            border:none;
            border-top:1px solid #ddd;
            margin:18px 0;

        }

        table{

            width:100%;
            border-collapse:collapse;

        }

        td{

            padding:4px 0;

        }

        .total{

            font-size:24px;
            font-weight:bold;
            color:#16a34a;

        }

        .btn{

            padding:12px 22px;
            border-radius:12px;
            color:white;
            text-decoration:none;
            display:inline-block;

        }

        .btn-back{

            background:#6b7280;

        }

        .btn-print{

            background:#6B412C;

        }

        .top-button{

            width:380px;
            margin:auto;
            display:flex;
            justify-content:space-between;
            margin-bottom:20px;

        }

        @media print{

            body{

                background:white;
                padding:0;

            }

            .top-button{

                display:none;

            }

            .receipt{

                width:80mm;
                box-shadow:none;
                border:none;
                border-radius:0;
                margin:auto;

            }

        }

    </style>

</head>

<body>


<div class="top-button">

    <a href="{{ route('payments.index') }}"
        class="btn btn-back">

        ← Kembali

    </a>

    <a href="{{ route('payments.receipt.pdf', $payment) }}"
        target="_blank"
        class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-xl">

        🖨 Cetak

    </a>
</div>


<div class="receipt">

    <div
        style="
            text-align:center;
        ">

        <img
            src="{{ asset('images/logo.png') }}"
            alt="Logo MiPaw"
            style="
                width:120px;
                display:block;
                margin:0 auto 15px;
            ">

        <h2
            style="
                color:#6B412C;
                font-size:22px;
                font-weight:bold;
                margin:0 0 12px;
            ">

            MiPaw Pet Shop & Grooming

        </h2>

        <div
            style="
                color:#666;
                line-height:22px;
            ">

            Jl. Mawar No.123 Banda Aceh

            <br>

            Telp : 0812-3456-7890

            <br>

            Email : mipaw@gmail.com

        </div>

    </div>

    <hr>

    <table>

        <tr>

            <td>Invoice</td>

            <td align="right">

                {{ $payment->invoice }}

            </td>

        </tr>

        <tr>

            <td>Tanggal</td>

            <td align="right">

                {{ $payment->created_at->format('d-m-Y H:i') }}

            </td>

        </tr>

        <tr>

            <td>Customer</td>

            <td align="right">

                {{ $payment->customer->user->name }}

            </td>

        </tr>

        <tr>

            <td>Metode</td>

            <td align="right">

                {{ strtoupper($payment->metode) }}

            </td>

        </tr>

    </table>

    <hr>

    @if($payment->order)

    <h3 style="font-weight:bold;margin-bottom:12px;">

        Produk

    </h3>

    <table>

        @foreach($payment->order->items as $item)

        <tr>

            <td>

                {{ $item->product->nama }}

                <br>

                <small style="color:#666;">

                    {{ $item->qty }} x
                    Rp {{ number_format($item->harga,0,',','.') }}

                </small>

            </td>

            <td align="right">

                Rp {{ number_format($item->subtotal,0,',','.') }}

            </td>

        </tr>

        @endforeach

    </table>

@endif


@if($payment->groomingBooking)

    <h3 style="font-weight:bold;margin-bottom:12px;">

        Grooming

    </h3>

    <table>

        <tr>

            <td>

                {{ $payment->groomingBooking->service->nama }}

                <br>

                <small style="color:#666;">

                    Hewan :
                    {{ $payment->groomingBooking->pet->nama }}

                </small>

            </td>

            <td align="right">

                Rp {{ number_format($payment->total,0,',','.') }}

            </td>

        </tr>

    </table>

@endif


<hr>


<table>

    <tr>

        <td
            style="
                font-weight:bold;
                font-size:18px;
            ">

            TOTAL

        </td>

        <td
            align="right"
            class="total">

            Rp {{ number_format($payment->total,0,',','.') }}

        </td>

    </tr>

</table>


<hr>


<div
    style="
        text-align:center;
        line-height:28px;
    ">

    Status :

    <b>

        {{ strtoupper($payment->status) }}

    </b>

    <br><br>

    🐾 Terima kasih telah berbelanja di MiPaw

    <br>

    <span style="color:#666;">

        Happy Pet, Happy Life

    </span>

</div>

    <hr>

    <div
        style="
            text-align:center;
            margin-top:20px;
            color:#666;
            font-size:12px;
            line-height:20px;
        ">

        ======================================

        <br>

        Barang yang sudah dibeli tidak dapat dikembalikan.

        <br>

        Simpan struk ini sebagai bukti pembayaran.

        <br><br>

        <strong style="color:#6B412C;">

            MiPaw Pet Shop & Grooming

        </strong>

        <br>

        Happy Pet, Happy Life 🐾

    </div>

</div>

</body>

</html>