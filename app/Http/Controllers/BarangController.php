<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function getListBarang(){
        $barang = Barang::paginate(5);
        if ($barang){
            return view('barang',[
                'barang' => $barang
            ]);
        }else{
            return view('barang',[
               'barang' => 'kosong'
            ]);
        }
    }
}
