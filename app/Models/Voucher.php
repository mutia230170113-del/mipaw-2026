<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'kode',
        'diskon',
        'tanggal_mulai',
        'tanggal_akhir',
        'status'
    ];
}