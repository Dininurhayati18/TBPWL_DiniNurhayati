<?php

namespace App\Http\Controllers;

use App\Models\Lbkeluar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PDF;

class LbkeluarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $keluar = Lbkeluar::all();
        return view('lb_keluar', compact('user', 'keluar'));
    }

    public function tambah_bkeluar(Request $req)
    {
        $keluar = new Lbkeluar;

        $keluar->name = $req->get('name');
        $keluar->tanggal = $req->get('tanggal');
        $keluar->jumlah = $req->get('jumlah');

        $keluar->save();

        $notification = array(
            'message' => 'Data barang keluar berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('barang_keluar')->with($notification);
    }    
    
    //proses ajax
    public function getDataBKeluar($id)
    {
        $keluar = Lbkeluar::find($id);

        return response()->json($keluar);
    }

    public function update_bkeluar(Request $req)
    {

        $keluar = Lbkeluar::find($req->get('id'));

        $keluar->name = $req->get('name');
        $keluar->tanggal = $req->get('tanggal');
        $keluar->jumlah = $req->get('jumlah');

        $keluar->save();

        $notification = array(
            'message' => 'Data barang keluar berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('barang_keluar')->with($notification);
    }

    public function delete_bkeluar(Request $req)
    {
        $keluar = Lbkeluar::find($req->get('id'));

        $keluar->delete();

        $notification = array(
            'message' => 'Data barang keluar berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('barang_keluar')->with($notification);
    }

    public function print_bkeluar()
    {
        $keluar = Lbkeluar::all();

        $pdf = PDF::loadview('print_bkeluar', ['keluar' => $keluar]);
        return $pdf->download('laporan_barang_keluar.pdf');
    }
}
