<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gaji extends Model
{
    //
    protected $fillable = [
        'user_id','gaji_pokok','tunjangan','potongan','rekening'
];

public function User(){
    return $this->belongsTo('App\Models\user');
    }
}
