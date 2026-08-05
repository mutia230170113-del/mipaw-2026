<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>Laporan MiPaw</title>

        <style>

            *{
                margin:0;
                padding:0;
                box-sizing:border-box;
            }

            body{

                font-family: DejaVu Sans, sans-serif;
                color:#333;
                font-size:12px;
                line-height:1.5;

                margin:35px;
            }

            .header{
                border-bottom:3px solid #6B412C;
                padding-bottom:15px;
                margin-bottom:25px;
            }


            .title{

                text-align:center;
                margin-top:25px;
                margin-bottom:25px;

            }

            .title h2{

                color:#6B412C;
                font-size:24px;
                margin-bottom:6px;

            }

            .title p{

                color:#777;

            }

            .info{

                width:100%;
                margin-bottom:25px;

            }

            .left-box{

                width:58%;
                float:left;

            }

            .right-box{

                width:38%;
                float:right;

            }

            .box{

                border:1px solid #ddd;
                border-radius:8px;
                padding:12px;

            }

            .box-title{

                background:#6B412C;
                color:white;
                padding:8px;
                margin:-12px -12px 12px -12px;
                font-weight:bold;
                text-align:center;

            }

            table{

                width:100%;
                border-collapse:collapse;

            }

            th{

                background:#6B412C;
                color:white;
                padding:10px;
                font-size:12px;

            }

            td{

                border:1px solid #ddd;
                padding:8px;

            }

            .text-center{

                text-align:center;

            }

            .text-right{

                text-align:right;

            }

            .green{

                color:#18a558;
                font-weight:bold;

            }

            .section{

                margin-top:20px;

            }

            .section h3{

                color:#6B412C;
                margin-bottom:12px;
                font-size:18px;

            }

            .summary{
                width:45%;
                margin-left:auto;
                margin-top:20px;
                margin-bottom:20px;
            }

            

            .footer{

                position:fixed;
                bottom:20px;
                left:35px;
                right:35px;
                text-align:center;
                color:#888;
                font-size:11px;

                border-top:1px solid #ddd;
                padding-top:8px;

            }

        </style>

    </head>

<body>



    {{-- HEADER --}}
        <div class="header">

        <table width="100%" border="0">
            <tr>

                <td width="14%" style="vertical-align:middle; text-align:center;">

                    <img src="{{ public_path('images/logo.png') }}"
                        width="130">

                </td>

                <td style="text-align:left; vertical-align:middle; padding-left:15px;">

                    <h1 style="color:#6B412C;
                            font-size:30px;
                            margin:0 0 10px 0;">

                        MiPaw Pet Shop & Grooming

                    </h1>

                    <p style="margin:4px 0;">
                        Jl. Mawar No.123 Banda Aceh
                    </p>

                    <p style="margin:4px 0;">
                        Telp : 0812-3456-7890
                    </p>

                    <p style="margin:4px 0;">
                        Email : mipaw@gmail.com
                    </p>

                </td>

            </tr>
        </table>

    </div>


    {{-- JUDUL --}}
    <div class="title">

        <h2>LAPORAN TRANSAKSI</h2>

        <p>
            Tanggal Cetak :
            {{ now()->translatedFormat('d F Y') }}
        </p>

    </div>



    {{-- INFO --}}
    <div class="info">

        <div class="left-box">

            <div class="box">

                <div class="box-title">
                    INFORMASI LAPORAN
                </div>

                <table>

                    <tr>

                        <td width="45%">
                            Nama Toko
                        </td>

                        <td>
                            MiPaw Pet Shop & Grooming
                        </td>

                    </tr>

                    <tr>

                        <td>
                            Alamat
                        </td>

                        <td>
                            Banda Aceh
                        </td>

                    </tr>

                    <tr>

                        <td>
                            Administrator
                        </td>

                        <td>

                            {{ auth()->user()->name }}

                        </td>

                    </tr>

                    <tr>

                        <td>
                            Tanggal Cetak
                        </td>

                        <td>

                            {{ now()->translatedFormat('d F Y') }}

                        </td>

                    </tr>

                </table>

            </div>

        </div>



        <div class="right-box">

            <div class="box">

                <div class="box-title">
                    RINGKASAN
                </div>

                <table>

                    <tr>

                        <td>Total Order</td>

                        <td class="text-right">

                            {{ $totalOrder }}

                        </td>

                    </tr>

                    <tr>

                        <td>Total Grooming</td>

                        <td class="text-right">

                            {{ $totalGrooming }}

                        </td>

                    </tr>

                    <tr>

                        <td>Total Pembayaran</td>

                        <td class="text-right">

                            {{ $totalPayment }}

                        </td>

                    </tr>

                    <tr>

                        <td>

                            <b>Total Pendapatan</b>

                        </td>

                        <td class="text-right green">

                            Rp {{ number_format($totalPendapatan,0,',','.') }}

                        </td>

                    </tr>

                </table>

            </div>

        </div>

        <div class="clear"></div>

    </div>



    {{-- DAFTAR PEMBAYARAN --}}

    <div class="section">

        <h3>Daftar Pembayaran</h3>

        <table>

            <thead>

                <tr>

                    <th width="6%">No</th>

                    <th>Invoice</th>

                    <th>Customer</th>

                    <th>Jenis</th>

                    <th>Metode</th>

                    <th>Status</th>

                    <th>Total</th>

                </tr>

            </thead>

            <tbody>

            @foreach($payments as $payment)

                <tr>

                    <td class="text-center">

                        {{ $loop->iteration }}

                    </td>

                    <td>

                        {{ $payment->invoice }}

                    </td>

                    <td>

                        {{ $payment->customer->user->name }}

                    </td>

                    <td>

                        {{ $payment->order ? 'Produk' : 'Grooming' }}

                    </td>

                    <td class="text-center">

                        {{ strtoupper($payment->metode) }}

                    </td>

                    <td class="text-center">

                        {{ ucfirst($payment->status) }}

                    </td>

                    <td class="text-right">

                        Rp {{ number_format($payment->total,0,',','.') }}

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>


    {{-- RINGKASAN PENDAPATAN --}}
    <div class="summary">

        <div class="box">

            <div class="box-title">

                RINGKASAN PENDAPATAN

            </div>

            <table>

                <tr>

                    <td>Total Transaksi</td>

                    <td class="text-right">

                        {{ $payments->count() }}

                    </td>

                </tr>

                <tr>

                    <td>Total Pendapatan</td>

                    <td class="text-right green">

                        Rp {{ number_format($totalPendapatan,0,',','.') }}

                    </td>

                </tr>

            </table>

        </div>

    </div>

    <div class="clear"></div>

    <div style="clear:both;"></div>



    {{-- TANDA TANGAN --}}
    <table width="100%" style="margin-top:15px;">

        <tr>

            <td width="60%"></td>

            <td width="40%" style="text-align:center;">

                Banda Aceh,
                {{ now()->translatedFormat('d F Y') }}

                <br><br>

                Hormat Kami,

                <br><br>

                <b>Store Manager MiPaw</b>

                <br><br><br><br><br>

                <b>{{ auth()->user()->name }}</b>

            </td>

        </tr>

    </table>

    <div class="clear"></div>



    {{-- FOOTER --}}
    <div class="footer">

        ==========================================================

        <br>

        MiPaw Pet Shop & Grooming • Happy Pet, Happy Life 🐾

    </div>

</body>

</html>