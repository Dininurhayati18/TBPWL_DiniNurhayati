<?php

namespace App\Http\Controllers;

use App\Models\Lbmasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PDF;

class LbmasukController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $masuk = Lbmasuk::all();
        return view('lb_masuk', compact('user', 'masuk'));
    }

    public function tambah_bmasuk(Request $req)
    {
        $masuk = new Lbmasuk;

        $masuk->name = $req->get('name');
        $masuk->tanggal = $req->get('tanggal');
        $masuk->jumlah = $req->get('jumlah');

        $masuk->save();

        $notification = array(
            'message' => 'Data barang masuk berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('barang_masuk')->with($notification);
    }
    //proses ajax
    public function getDataBMasuk($id)
    {
        $masuk = Lbmasuk::find($id);

        return response()->jsonp($masuk);
    }

    public function update_bmasuk(Request $req)
    {
        $masuk = Lbmasuk::find($req->get('id'));

        $masuk->name = $req->get('name');
        $masuk->tanggal = $req->get('tanggal');
        $masuk->jumlah = $req->get('jumlah');

        $masuk->save();

        $notification = array(
            'message' => 'Data barang masuk berhasil diedit',
            'alert-type' => 'success'
        );

        return redirect()->route('barang_masuk')->with($notification);
    }

    public function delete_bmasuk(Request $req)
    {
        $masuk = Lbmasuk::find($req->get('id'));

        $masuk->delete();

        $notification = array(
            'message' => 'Data barang masuk berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->route('barang_masuk')->with($notification);
    }

    public function print_bmasuk()
    {
        $masuk = Lbmasuk::all();

        $pdf = PDF::loadview('print_bmasuk', ['masuk' => $masuk]);
        return $pdf->download('laporan_barang_masuk.pdf');
    }
}
