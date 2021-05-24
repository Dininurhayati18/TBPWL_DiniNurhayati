<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        $brands = Brand::all();
        return view('brand', compact('user', 'brands'));
    }

    public function submit_brand(Request $req)
    {
        $brand = new Brand;

        $brand->name = $req->get('name');
        $brand->description = $req->get('description');

        $brand->save();

        $notification = array(
            'message' => 'Merek berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('brand')->with($notification);
    }

    // ajax prosess
    public function getDataBrand($id)
    {
        $brand = Brand::find($id);

        return response()->json($brand);
    }

    // update brand
    public function update_brand(Request $req)
    {
        $brand = Brand::find($req->get('id'));

        $brand->name = $req->get('name');
        $brand->description = $req->get('description');

        $brand->save();

        $notification = array(
            'message' => 'Merek berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('brand')->with($notification);
    }
    
    public function delete_brand(Request $req)
    {
        $brand = Brand::find($req->get('id'));

        $brand->delete();

        $notification = array(
            'message' => 'Merek berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('brand')->with($notification);
    }
    
}
