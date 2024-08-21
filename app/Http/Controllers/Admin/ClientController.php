<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Detail;
use App\Models\ClientFile;
use App\Models\PosAttachment;
use App\Models\ServiceType;
use App\Models\ClientSubscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Alert;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create','store', 'attachment', 'add_attachment', 'downloadattachment', 'destroy_attachment']]);
        $this->middleware('permission:update user', ['only' => ['update','edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
        $this->middleware('permission:view pos number', ['only' => ['subscription', 'expiringPOS']]);
        $this->middleware('permission:create pos number', ['only' => ['addsubcription','storesubscription']]);
        $this->middleware('permission:pos document', ['only' => ['posattachment','add_posattachment', 'downloadposattachment', 'destroy_posattachment']]);
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

        // $attachmentData = [];
        // if($files = $request->file('attachments')){
        //     foreach($files as $key => $file){
        //         $filename = $file->getClientOriginalName();

        //         $check = ClientFile::where(['path' => $filename, 'user_id' => $user->id])->first();

        //         if($check != null){
        //             Alert::error('Duplicate File Name', 'An existing file has the same name. User has been registered');
        //             return redirect()->back();
        //         }
        //         $path = "attachments/participants/".$user->id."/";
        //         $file->move($path, $filename);

        //         $attachmentData[] = [
        //             'user_id' => $user->id,
        //             'type'=> $request->type,
        //             'path' => $filename,
        //             'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        //         ];
        //     }
        // }
        // ClientFile::insert($attachmentData);

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

    public function attachment(Request $request)
    {
        $client = User::where('id', $request->vim)->first();
        $attachment = ClientFile::where('user_id', $client->id)->latest()->get();
        $type = "All";
        return view('admin.clients.attachment', ['client' => $client, 'attachment'=> $attachment, 'type' => $type]);
    }

    public function query_attachment(Request $request)
    {
        $client = User::where('id', $request->vim)->first();
        if($request->type == "All" || $request->type == ""){
            $attachment = ClientFile::where('user_id', $client->id)->latest()->get();
        }else{
            $attachment = ClientFile::where([
                'user_id' => $client->id,
                'type' => $request->type,
                ])->latest()->get();
        }
        $type = $request->type;
        return view('admin.clients.attachment', ['client' => $client, 'attachment'=> $attachment, 'type' => $type]);
    }


    public function add_attachment(Request $request)
    {
        $request->validate([
            'attachments' => 'required',
            'type' => 'required',
        ]);
        $attachmentData = [];
        if($files = $request->file('attachments')){
            foreach($files as $key => $file){
                // $extension = $file->getClientOriginalExtension();
                // $filename = $key."-".time().".".$extension;
                $filename = $file->getClientOriginalName();

                $check = ClientFile::where(['path' => $filename, 'user_id' => $request->id])->first();

                if($check != null){
                    Alert::error('Duplicate File Name', 'An existing file has the same name');
                    return redirect()->back();
                }

                $path = "attachments/participants/".$request->id."/";
                $file->move($path, $filename);

                $attachmentData[] = [
                    'user_id' => $request->id,
                    'type'=> $request->type,
                    'path' => $filename,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];
            }
        }
        ClientFile::insert($attachmentData);

        Alert::success('Successful', 'Attachments added successfully');
        return redirect()->back();
    }

    public function downloadattachment(Request $request){
        $path = ClientFile::where("id", $request->vim)->first();
        return Response::download('attachments/participants/'.$path->user_id."/".$path->path);
      }

    public function destroy_attachment(Request $request)
    {
        $id = $request->vim;
        ClientFile::where('id', $id)->delete();
        Alert::success('Deleted', 'Deleted Successfully');
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
        $users = User::where('role', 'user')->get();
        $services = ServiceType::orderBy('type', 'asc')->get();
        return view('admin.clients.addpos', ['all' => $all, 'users' => $users, 'services' => $services]);
    }

    public function storesubscription(Request $request){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $request->validate([
            'posnumber' => 'unique:client_subscriptions|required|numeric|regex:/^(\d{8})$/',
            'user' => 'required',
            'startdate' => 'required',
            'service' => 'required',
            'duedate' => 'required',
        ]);

        $user = ClientSubscription::where('user_id', $request->user)->first();

        if($user != null){
            $client = ClientSubscription::where('user_id', $request->user)
                ->update([
                    'posnumber' => $request->posnumber,
                    'startdate' => $request->startdate,
                    'duedate' => $request->duedate,
                    'status' => 'active',
            ]);
        }else{
            if($request->service == 'same'){
                Alert::error('No Service Type', 'No current service type for selected participant');
                return redirect()->back();
            }
            $client = ClientSubscription::create([
                'posnumber' => $request->posnumber,
                'startdate' => $request->startdate,
                'duedate' => $request->duedate,
                'service_option_id' => $request->service,
                'status' => 'active',
                'user_id' => $request->user,
            ]);
        }

        $user = ClientSubscription::where('user_id', $request->user)->first();

        $attachmentData = [];
        if($files = $request->file('attachments')){
            foreach($files as $key => $file){
                $extension = $file->getClientOriginalExtension();
                $filename = $key."-".time().".".$extension;

                $path = "attachments/pos/";
                $file->move($path, $filename);

                $attachmentData[] = [
                    'client_subscription_id' => $client->id,
                    'path' => $filename,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];
            }
        }
        PosAttachment::insert($attachmentData);

        Alert::success('Successful', $request->posnumber.' has be added successfully to '.$user->user->name);
        return redirect()->back();
    }

    public function posattachment(Request $request)
    {
        $client = ClientSubscription::where('id', $request->vim)->first();
        $posAttach = PosAttachment::where('client_subscription_id', $client->id)->latest()->get();
        $type = "All";
        return view('admin.clients.posattachment', ['client' => $client, 'posAttach'=> $posAttach, 'type' => $type]);
    }

    public function add_posattachment(Request $request)
    {
        $request->validate([
            'attachments' => 'required'
        ]);
        $attachmentData = [];
        if($files = $request->file('attachments')){
            foreach($files as $file){
                // $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();

                $check = PosAttachment::where(['path' => $filename, 'client_subscription_id' => $request->id])->first();

                if($check != null){
                    Alert::error('Duplicate File Name', 'An existing file has the same name');
                    return redirect()->back();
                }

                $user_id = ClientSubscription::where('id', $request->id)->first()->user_id;

                $path = "attachments/pos/".$user_id."/";
                $file->move($path, $filename);

                $attachmentData[] = [
                    'client_subscription_id' => $request->id,
                    'path' => $filename,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];
            }
        }
        PosAttachment::insert($attachmentData);

        Alert::success('Successful', 'Attachments added successfully');
        return redirect()->back();
    }

    public function downloadposattachment(Request $request){
        $path = PosAttachment::where("id", $request->vim)->first();
        return Response::download('attachments/pos/'.$path->subscription->user_id."/".$path->path);
      }

    public function destroy_posattachment(Request $request)
    {
        $id = $request->vim;
        PosAttachment::where('id', $id)->delete();
        Alert::success('Deleted', 'Deleted Successfully');
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
