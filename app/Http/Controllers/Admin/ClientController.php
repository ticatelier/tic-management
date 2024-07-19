<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Detail;
use App\Models\ServiceType;
use App\Models\ClientSubscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Alert;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create','store']]);
        $this->middleware('permission:update user', ['only' => ['update','edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
        $this->middleware('permission:view pos number', ['only' => ['subscription', 'expiringPOS']]);
        $this->middleware('permission:create pos number', ['only' => ['addsubcription','storesubscription']]);
    }

    private function access(){
        $role = User::find(Auth::id())->role;
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

        Detail::create([
            'user_id' => $user->id
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
        $all = ServiceType::orderBy('type', 'asc')->get();
        return view('admin.clients.edit', ['all' => $all, 'user' => $user]);
    }

    public function update(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }

        $request->validate([
            'name' => 'required',
            'service' => 'required',
        ]);

        User::where('id', $request->id)
            ->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        ClientSubscription::where('user_id', $request->id,)
            ->update([
            'service_option_id' => $request->service
        ]);

        Alert::success('Successful', $request->name.' has be updated successfully');
        return redirect()->back();
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

    public function subscription(){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $all = ClientSubscription::where('status', 'active')->orderBy('duedate', 'asc')->get();
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
            'posnumber' => 'unique:client_subscriptions|required|regex:/^(\d{8})$/',
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

    public function destroysubscription(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $id = $request->vim;
        ClientSubscription::find($id)->delete();
        Alert::success('Deleted', 'Deleted Successfully');
        return redirect()->back();
    }

    public function expiringPOS(){
        $date = Carbon::now();
        $monthYear = $date->format('Y-m');
        $month = $date->format('F');
        $allposnumbers = ClientSubscription::where('status', 'active')->orderBy('duedate', 'asc')->get();
        $all = [];

        foreach($allposnumbers as $number){
            if(Carbon::parse($number->duedate)->format('Y-m') == $monthYear){
                $all[] = $number;
            }
        }

        return view('admin.clients.expiringpos', ['all' => $all, 'month' => $month]);
    }
}
