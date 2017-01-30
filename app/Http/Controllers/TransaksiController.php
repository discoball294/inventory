<?php

namespace App\Http\Controllers;

use App\Barang;
use App\DetailStok;
use App\Gudang;
use App\Stok;
use App\TempStok;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function fetchGudangAndBarang()
    {
        $gudang = Gudang::all();
        $barang = Barang::all();
        if ($gudang && $barang) {
            return view('transaksi', [
                'gudang' => $gudang,
                'barang' => $barang,
            ]);
        } else {
            return view('transaksi', [
                'gudang' => $gudang,
                'barang' => $barang,
            ]);
        }

    }

    public function getUnit($id)
    {
        $unit = Barang::find($id);
        $json['unit'] = $unit->unit;
        return response()
            ->json($json)
            ->header('Content-Type', 'text/json');
    }

    public function insertTemp(Request $request)
    {
        $temp = new TempStok();
        $temp->barang_id = $request['barang_id'];
        $temp->unit = $request['unit'];
        $temp->jumlah = $request['jumlah'];

        if ($temp->save()) {
            $json['message'] = 'berhasil';
            return response()
                ->json($json)
                ->header('Content-Type', 'text/json');
        } else {
            $json['message'] = 'gagal';
            return response()
                ->json($json)
                ->header('Content-Type', 'text/json');
        }
    }

    public function saveTransaksi(Request $request)
    {
        $transaksi = new Stok();

        $temp = TempStok::all();
        $transaksi->gudang_id = $request['gudang_id'];
        $transaksi->tanggal = $request['tanggal'];
        $transaksi->keterangan = $request['keterangan'];
        if ($transaksi->save()) {
            $last_id = $transaksi->id;
            foreach ($temp as $items) {
                $detail = new DetailStok();
                $detail->stok_id = $last_id;
                $detail->barang_id = $items->barang_id;
                $detail->unit = $items->unit;
                $detail->jumlah = $items->jumlah;
                $detail->save();
                $barang = Barang::find($items->barang_id);
                if ($request['keterangan'] == 'Masuk') {
                    $barang->stok += $items->jumlah;
                    $barang->save();
                } else {
                    $barang->stok -= $items->jumlah;
                    $barang->save();
                }

            }
            TempStok::truncate();
            $request->session()->flash('alert-success', 'Transaksi telah disimpan');
            return redirect()->back();
        } else {
            $request->session()->flash('alert-warning', 'Transaksi gagal disimpan');
            return redirect()->back();
        }


    }
}
