<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Alert;

class AdminController extends Controller
{
    private function access(){
        $role = User::find(Auth::id())->first()->role;
        if($role == 'superadmin')
        {
            return 'access';
        }elseif($role == 'superadmin'){
            return 'access';
        }
        else{
            return 'no access';
        }
    }
    public function index()
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $all = User::where('role', 'admin')->get();
        return view('admin.administrators.index', ['all' => $all]);
    }

    public function create()
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        return view('admin.administrators.create');
    }

    public function store(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $request->validate([
            'email' => 'unique:users|required',
            'name' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        Alert::success('Successful', $request->name.' has be registered successfully');
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $user = User::where('id', $request->vim)->first();
        return view('admin.administrators.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $request->validate([
            'email' => 'required',
            'name' => 'required'
        ]);

        User::where('id', $request->id)
            ->update([
                'email' => $request->email,
                'name' => $request->name
        ]);

        Alert::success('Successful', $request->name.' has be registered successfully');
        return redirect()->intended(route('admin.administrators.index'));
    }

    public function destroy(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $id = $request->vim;
        User::find(id)->delete();
        Alert::success('Deleted', 'Deleted Successfully');
        return redirect()->back();
    }
}
