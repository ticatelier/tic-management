<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Detail;
use App\Models\AssignTrainer;
use Illuminate\Support\Facades\Hash;
use Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class TrainingController extends Controller
{
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
        $all = User::where('role', 'trainer')->orderBy('name', 'asc')->get();
        return view('admin.trainers.index', ['all' => $all]);
    }

    public function create()
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        return view('admin.trainers.create');
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
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('user123'),
            'role' => 'trainer'
        ]);

        Detail::create([
            'user_id' => $user->id
        ]);

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
        return view('admin.trainers.edit', ['user' => $user]);
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
        return redirect()->intended(route('admin.trainer.index'));
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

    public function assign(){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $all = User::where('role', 'trainer')->orderBy('name', 'asc')->get();
        $clients = User::where('role', 'user')->orderBy('name', 'asc')->get();
        return view('admin.trainers.assign', ['all' => $all, 'clients' => $clients]);
    }

    public function unassign(Request $request){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $trainer = User::where('id', $request->vim)->first();
        return view('admin.trainers.unassign', ['trainer' => $trainer]);
    }

    public function unassign_destroy(Request $request){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $request->validate([
            'client' => 'required'
        ]);
        AssignTrainer::where(['trainer_id' => $request->id, 'client_id' => $request->client])->delete();
        Alert::success('Deleted', 'Deleted Successfully');
        return redirect()->intended(route('admin.trainer.assign'));;
    }

    public function assign_store(Request $request){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $request->validate([
            'trainer' => 'required',
            'users' => 'required'
        ]);
        $users = $request->users;
        $trainer = $request->trainer;

        //Check if authorization number is still valid. Insert code here.
        foreach ($users as $user)
        {
            if($this->check_assign($trainer, $user)){

            }else{
                AssignTrainer::create([
                    'trainer_id' => $trainer,
                    'client_id' => $user
                ]);
            }
        }
        $name = User::find($trainer)->name;
        Alert::success('Successful', $name.'has been assigned to '.count($users).' client(s)');
        return redirect()->back();
    }

    private function check_assign($trainer, $client){
        if (AssignTrainer::where(['trainer_id' => $trainer, 'client_id' => $client])->first() != null){
            return true;
        }else{
            return false;
        }
    }


}
