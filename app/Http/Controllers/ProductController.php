<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        $products = Product::all();
        $brands = Brand::all();
        $categories = Category::all();
        return view('product', compact('user', 'products', 'brands', 'categories'));
    }

    public function submit_product(Request $req){
        $product = new Product;

        $product->name = $req->get('name');
        $product->qty = $req->get('qty');
        $product->price = $req->get('price');
        $product->brands_id = $req->get('brands_id');
        $product->categories_id = $req->get('categories_id');
        $product->photo = $req->get('photo');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();
            $filename = 'photo_product' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_product', $filename
            );

            $product->photo = $filename;
        }

        $product->save();

        $notification = array(
            'message' => 'Produk berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('product')->with($notification);
    }

    // ajax prosess
    public function getDataProduct($id)
    {
        $produk = Product::find($id);

        return response()->json($produk);
    }

    // update Product
    public function update_product(Request $req)
    {
        $product = Product::find($req->get('id'));

        $product->name = $req->get('name');
        $product->qty = $req->get('qty');
        $product->price = $req->get('price');
        $product->brands_id = $req->get('brands_id');
        $product->categories_id = $req->get('categories_id');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();
            $filename = 'photo_product'.time().'.'. $extension;

            $req->file('photo')->storeAs(
                'public/photo_product', $filename
            );
            Storage::delete('public/photo_product/'.$req->get('old_photo'));
            $product->photo = $filename;
        }

        $product->save();

        $notification = array(
            'message' => 'Produk berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('product')->with($notification);
    }

    public function delete_product(Request $req)
    {
        $product = Product::find($req->get('id'));

        Storage::delete('public/photo_product/'.$req->get('old_photo'));

        $product->delete();

        $notification = array(
            'message' => 'Produk berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('product')->with($notification);
    }

    public function print_produk(){
        $barang = Product::all();

        $pdf = PDF ::loadview('print_produk', ['barang'=>$barang]);
        return $pdf->download('data_produk.pdf');
    }
}
