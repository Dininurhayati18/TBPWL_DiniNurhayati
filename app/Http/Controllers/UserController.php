<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() 
    {
        $user = Auth::user();
        $users = User::all();
        $roles = Role::all();
        return view('user', compact('user', 'users', 'roles'));
    } 

    public function submit_user(Request $req)
    {
        $user = new User;

        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->roles_id = $req->get('roles_id');
        $user->email = $req->get('email');
        $user->password = $req->get('password');
        $user->photo = $req->get('photo');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();
            $filename = 'photo_user' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_user', $filename
            );

            $user->photo = $filename;
        }

        $user->save();

        $notification = array(
            'message' => 'User berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('user')->with($notification);
    }

    // ajax prosess
    public function getDataUser($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    // update 
    public function update_user(Request $req)
    {
        $user = User::find($req->get('id'));

        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        $user->password = $req->get('password');
        $user->roles_id = $req->get('roles_id');

        if($req->hasFile('photo')){
            $extension = $req->file('photo')->extension();
            $filename = 'photo_user'.time().'.'. $extension;

            $req->file('photo')->storeAs(
                'public/photo_user', $filename
            );
            Storage::delete('public/photo_user/'.$req->get('old_photo'));
            $user->photo = $filename;
        }

        $user->save();

        $notification = array(
            'message' => 'User berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('user')->with($notification);
    }

    public function delete_user(Request $req)
    {
        $user = User::find($req->get('id'));

        Storage::delete('public/photo_user/'.$req->get('old_photo'));

        $user->delete();

        $notification = array(
            'message' => 'User berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('user')->with($notification);
    } 
}
