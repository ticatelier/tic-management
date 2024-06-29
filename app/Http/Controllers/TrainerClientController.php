<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignTrainer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Alert;

class TrainerClientController extends Controller
{
    public function index(){
        $myclients = AssignTrainer::where('trainer_id', User::find(Auth::id())->id)->get();
        return view('trainer.clients.index', ['myclients' => $myclients]);
    }
}
