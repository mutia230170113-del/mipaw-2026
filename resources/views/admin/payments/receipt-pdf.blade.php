<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk {{ $payment->invoice }}</title>

    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body{
            /* 
            | Lebar total diturunkan dari 80mm menjadi 72mm 
            | Ini adalah kunci utama agar seluruh struk mengecil pas di tengah 
            | dan tidak akan pernah terpotong lagi di PDF printer mana pun.
            */
            width: 72mm; 
            font-family: DejaVu Sans, sans-serif;
            font-size:11px;
            color:#222;
            margin: 0 auto; /* Memaksa seluruh badan struk berada tepat di tengah kertas */
            padding: 4mm 2mm;
            background-color: #ffffff !important;
        }

        .receipt{
            width: 100%;
            margin:0;
            padding:0;
        }

        .center {
            text-align: center;
        }

        .logo {
            width: 75px;
            display: block;
            margin: 0 auto 8px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            color: #6B412C;
            margin-bottom: 5px;
        }

        .address {
            font-size: 10px;
            line-height: 1.5;
            color: #555;
        }

        .line {
            border-top: 1px dashed #999;
            margin: 12px 0;
        }

        table{
            width:100%;
            border-collapse:collapse;
            table-layout:fixed;
        }

        td{
            padding:6px 4px;
            vertical-align:top;
        }

        /* Pembagian kolom digeser aman agar teks data kanan punya ruang mundur */
        .label{
            width:42%;
            text-align:left;
        }

        .value{
            width:58%;
            text-align:right;
        }

        .right{
            text-align:right;
        }

        .total-text{
            font-size:14px;
            font-weight:bold;
        }

        .total-price{
            text-align:right;
            font-size:18px;
            font-weight:bold;
            color:#00A651;
        }
                
        .section {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .small {
            font-size: 9px;
            color: #666;
        }

        .total td {
            padding-top: 8px;
            font-weight: bold;
        }

        .status {
            margin-top: 10px;
            text-align: center;
            font-weight: bold;
        }

        .footer {
            margin-top: 12px;
            text-align: center;
            font-size: 9px;
            color: #666;
            line-height: 1.6;
        }
    </style>

</head>

<body>

    <div class="receipt">

        <div class="center">

            <img
                src="{{ public_path('images/logo.png') }}"
                class="logo">

            <div class="title">
                MiPaw Pet Shop & Grooming
            </div>

            <div class="address">
                Jl. Mawar No.123 Banda Aceh
                <br>
                0812-3456-7890
                <br>
                mipaw@gmail.com
            </div>

        </div>

        <div class="line"></div>

        <table>

            <colgroup>
                <col style="width:42%;">
                <col style="width:58%;">
            </colgroup>

            <tr>
                <td class="label">Invoice</td>
                <td class="value">
                    {{ $payment->invoice }}
                </td>
            </tr>

            <tr>
                <td class="label">Tanggal</td>
                <td class="value">
                    {{ $payment->created_at->format('d-m-Y H:i') }}
                </td>
            </tr>

            <tr>
                <td class="label">Customer</td>
                <td class="value">
                    {{ $payment->customer->user->name }}
                </td>
            </tr>

            <tr>
                <td class="label">Metode</td>
                <td class="value">
                    {{ strtoupper($payment->metode) }}
                </td>
            </tr>

        </table>

        <div class="line"></div>

        @if ($payment->order)

            <div class="section">
                Produk
            </div>

            <table>

                @foreach ($payment->order->items as $item)

                    <tr>

                        <td>
                            {{ $item->product->nama }}

                            <br>

                            <span class="small">
                                {{ $item->qty }} x Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </span>

                        </td>

                        <td class="right">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>

                    </tr>

                @endforeach

            </table>

        @endif

        @if ($payment->groomingBooking)

            <div class="section">
                Grooming
            </div>

            <table>

                <colgroup>
                    <col style="width:42%;">
                    <col style="width:58%;">
                </colgroup>

                <tr>

                    <td>

                        <strong>
                            {{ $payment->groomingBooking->service->nama }}
                        </strong>

                        <br>

                        <span class="small">
                            Hewan :
                            {{ $payment->groomingBooking->pet->nama }}
                        </span>

                    </td>

                    <td class="right">

                        Rp {{ number_format($payment->total,0,',','.') }}

                    </td>

                </tr>

            </table>

        @endif

        <div class="line"></div>

        <table>

            <colgroup>
                <col style="width:42%;">
                <col style="width:58%;">
            </colgroup>

            <tr>

                <td class="total-text">

                    TOTAL

                </td>

                <td class="right total-price">

                    Rp {{ number_format($payment->total,0,',','.') }}

                </td>

            </tr>

        </table>

        <div class="line"></div>

        <div class="status">
            Status : {{ strtoupper($payment->status) }}
        </div>

        <div class="footer">

            🐾 Terima kasih telah berbelanja di MiPaw

            <br>

            Happy Pet, Happy Life

            <div class="line"></div>

            Barang yang sudah dibeli tidak dapat dikembalikan.

            <br>

            Simpan struk ini sebagai bukti pembayaran.

            <div class="line"></div>

            <b>MiPaw Pet Shop & Grooming</b>

        </div>

    </div>

</body>

</html>
