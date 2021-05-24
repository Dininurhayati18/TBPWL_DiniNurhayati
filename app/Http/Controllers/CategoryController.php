<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('category', compact('user', 'categories'));
    }

    public function submit_category(Request $req){
        $category = new Category;

        $category->name = $req->get('name');
        $category->description = $req->get('description');

        $category->save();

        $notification = array(
            'message' => 'Kategori berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('category')->with($notification);
    }

    // ajax prosess
    public function getDataCategory($id)
    {
        $kategori = Category::find($id);

        return response()->json($kategori);
    }

    // update category
    public function update_category(Request $req)
    {
        $category = Category::find($req->get('id'));

        $category->name = $req->get('name');
        $category->description = $req->get('description');

        $category->save();

        $notification = array(
            'message' => 'Kategori berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('category')->with($notification);
    }

    // hapus category
    public function delete_category(Request $req)
    {
        $category = Category::find($req->get('id'));

        $category->delete();

        $notification = array(
            'message' => 'Kategori berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('category')->with($notification);
    }
    
}
