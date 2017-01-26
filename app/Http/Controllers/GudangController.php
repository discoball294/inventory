<?php

namespace App\Http\Controllers;

use App\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function getListGudang()
    {
        $gudang = Gudang::paginate(10);
        if ($gudang) {
            return view('gudang', [
                'gudang' => $gudang
            ]);
        } else {
            return view('gudang', [
                'gudang' => 'kosong'
            ]);
        }
    }

    public function addGudang(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'nama' => 'required|max:100',
            'keterangan' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            $gudang = new Gudang();
            $gudang->nama = $request['nama'];
            $gudang->keterangan = htmlspecialchars($request['keterangan']);
            if ($gudang->save()) {
                $request->session()->flash('alert-success', 'Gudang telah ditambahkan');
                return redirect()->back();
            } else {
                $request->session()->flash('alert-warning', 'Gudang gagal ditambahkan');
                return redirect()->back();
            }
        } else {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }

    }

    public function editGudang(Request $request, $id){
        $validator = \Validator::make($request->all(), [
            'edit_nama' => 'required|max:100',
            'edit_keterangan' => 'required|max:255',
        ]);
        if ($validator->passes()) {
            $gudang = Gudang::find($id);
            $gudang->nama = $request['edit_nama'];
            $gudang->keterangan = htmlspecialchars($request['edit_keterangan']);
            if ($gudang->save()) {
                $request->session()->flash('alert-success', 'Gudang telah diubah');
                return redirect()->back();
            } else {
                $request->session()->flash('alert-warning', 'Gudang gagal diubah');
                return redirect()->back();
            }
        }else{
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }
    }

    public function deleteGudang(Request $request, $id){
        $barang = Gudang::find($id);
        if($barang->delete()){
            $request->session()->flash('alert-success', 'Barang telah dihapus');
            return redirect()->back();
        }else {
            $request->session()->flash('alert-warning', 'Barang gagal dihapus');
            return redirect()->back();
        }

    }
}
