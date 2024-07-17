<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Detail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view admin', ['only' => ['index']]);
        $this->middleware('permission:create admin', ['only' => ['create','store']]);
        $this->middleware('permission:update admin', ['only' => ['update','edit']]);
        $this->middleware('permission:delete admin', ['only' => ['destroy']]);
    }

    private function access(){
        $role = User::find(Auth::id())->first()->role;
        if($role == 'superadmin')
        {
            return 'access';
        }elseif($role == 'admin'){
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

        Detail::create([
            'user_id' => $user->id
        ]);

        $adminRole = Role::where(['name' => 'admin'])->first();
        $user->assignRole($adminRole);

        Mail::to($user->email)->send(new WelcomeMail([
            'name' => $user->name,
            'role' => $user->role
        ]));

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
        User::find($id)->delete();
        Alert::success('Deleted', 'Deleted Successfully');
        return redirect()->back();
    }
}
