<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ServiceType;
use App\Models\ClientSubscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Alert;

class ClientController extends Controller
{
    private function access(){
        $role = User::find(Auth::id())->role;
        if($role != 'superadmin' || $role != 'admin')
        {
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
        $all = User::where('role', 'user')->orderBy('name', 'asc')->get();
        return view('admin.clients.index', ['all' => $all]);
    }

    public function create()
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $all = ServiceType::orderBy('type', 'asc')->get();
        return view('admin.clients.create', ['all' => $all]);
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
            'name' => 'required',
            'service' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('user123'),
            'role' => 'user'
        ]);

        ClientSubscription::create([
            'user_id' => $user->id,
            'service_option_id' => $request->service
        ]);

        Alert::success('Successful', $request->name.' has be registered successfully');
        return redirect()->back();


    }

    public function update(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $id = $request->id;
        User::find(id)->delete();
        Alert::success('Deleted', 'Deleted Successfully');
        return redirect()->back();
    }

    public function subscription(){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $all = ClientSubscription::where('status', 'active')->get();
        return view('admin.clients.subcriptions', ['all' => $all]);
    }

    public function addsubscription(){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $all = ClientSubscription::get();
        return view('admin.clients.addpos', ['all' => $all]);
    }

    public function storesubscription(Request $request){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $request->validate([
            'posnumber' => 'unique:client_subscriptions|required',
            'user' => 'required',
            'startdate' => 'required',
            'duedate' => 'required',
        ]);

        ClientSubscription::where('user_id', $request->user)
            ->update([
                'posnumber' => $request->posnumber,
                'startdate' => $request->startdate,
                'duedate' => $request->duedate,
                'status' => 'active',
        ]);

        $user = ClientSubscription::where('user_id', $request->user)->first();

        Alert::success('Successful', $request->posnumber.' has be added successfully to '.$user->user->name);
        return redirect()->back();
    }
}
