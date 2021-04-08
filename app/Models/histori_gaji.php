<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class histori_gaji extends Model
{
    //
    protected $fillable = [
        'user_id','tanggal','gaji_pokok','tunjangan','potongan','rekening'
    ];
}
