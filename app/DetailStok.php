<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailStok extends Model
{
    protected $table = 'detail_stok';
    protected $fillable = ['stok_id','barang_id','unit','jumlah'];
}