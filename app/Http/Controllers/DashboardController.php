<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Detail;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $role = User::find(Auth::id())->role;
        $check = Detail::where('user_id', Auth::id())->first();
        if($check->address == null || $check->phone == null || $check->zipcode == null)
        {
            return view('details');
        }
        if($role == 'superadmin' || $role == 'admin')
        {
            return view('admin.index');
        }
        if($role == 'trainer')
        {
            return view('trainer.index');
        }
        if($role == 'user')
        {
            return view('user.index');
        }
    }

    public function details(Request $request){
        $request->validate([
            'address' => 'required'
        ]);

        User::where('id', $request->id)
            ->update([
                'password' => Hash::make($request->password)
        ]);

        Detail::where('user_id', $request->id)
        ->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'zipcode' => $request->zipcode,
        ]);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
