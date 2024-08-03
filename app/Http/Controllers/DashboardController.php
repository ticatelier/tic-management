<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Detail;
use Illuminate\Support\Facades\Hash;
use Alert;

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

        $password = bcrypt($request->password);

        User::where('id', $request->id)
            ->update([
                'password' => $password
        ]);

        Detail::where('user_id', $request->id)
        ->update([
            'address' => $request->address,
            'phone' => $request->phone,
            'zipcode' => $request->zipcode,
        ]);
        
        Alert::success('Successful', 'Details Updated Successfully');
        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function changepassword(){
        return view('changepassword');
    }

    public function storepassword(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required'
        ]);

        $oldPassword = User::where('id', $request->id)->first()->password;

        if (Hash::check($request->oldpassword, $oldPassword)) {
            if(Hash::check($request->newpassword, $oldPassword)) {
                Alert::error('Error', 'New Password same as Old Password');
                return redirect()->back();
            }
            $password = bcrypt($request->newpassword);
            User::where('id', $request->id)
                ->update([
                    'password' => $password
            ]);

            Alert::success('Successful','Password Updated Successfully');
            return redirect()->intended(route('dashboard', absolute: false));
        }
        Alert::error('Error', 'Wrong Old Password entered');
        return redirect()->back();
    }
}
