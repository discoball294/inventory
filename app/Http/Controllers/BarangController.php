<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function getListBarang()
    {
        $barang = Barang::paginate(10);
        if ($barang) {
            return view('barang', [
                'barang' => $barang
            ]);
        } else {
            return view('barang', [
                'barang' => 'kosong'
            ]);
        }
    }

    public function addBarang(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'nama_barang' => 'required|max:100',
            'deskripsi' => 'required|max:255',
            'unit' => 'required',
            'stok' => 'required|numeric',
            'keterangan' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            $barang = new Barang();
            $barang->nama_barang = $request['nama_barang'];
            $barang->deskripsi = htmlspecialchars($request['deskripsi']);
            $barang->unit = $request['unit'];
            $barang->stok = $request['stok'];
            $barang->keterangan = htmlspecialchars($request['keterangan']);
            if ($barang->save()) {
                $request->session()->flash('alert-success', 'Barang telah ditambahkan');
                return redirect()->back();
            } else {
                $request->session()->flash('alert-warning', 'Barang gagal ditambahkan');
                return redirect()->back();
            }
        } else {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }

    }

    public function editBarang(Request $request, $id){
        $validator = \Validator::make($request->all(), [
            'edit_nama_barang' => 'required|max:100',
            'edit_deskripsi' => 'required|max:255',
            'edit_unit' => 'required',
            'edit_stok' => 'required|numeric',
            'edit_keterangan' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            $barang = Barang::find($id);
            $barang->nama_barang = $request['edit_nama_barang'];
            $barang->deskripsi = htmlspecialchars($request['edit_deskripsi']);
            $barang->unit = $request['edit_unit'];
            $barang->stok = $request['edit_stok'];
            $barang->keterangan = htmlspecialchars($request['edit_keterangan']);
            if ($barang->save()) {
                $request->session()->flash('alert-success', 'Barang telah diubah');
                return redirect()->back();
            } else {
                $request->session()->flash('alert-warning', 'Barang gagal diubah');
                return redirect()->back();
            }
        }else{
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }
    }

    public function deleteBarang(Request $request, $id){
        $barang = Barang::find($id);
        if($barang->delete()){
            $request->session()->flash('alert-success', 'Barang telah dihapus');
            return redirect()->back();
        }else {
            $request->session()->flash('alert-warning', 'Barang gagal dihapus');
            return redirect()->back();
        }

    }
}
