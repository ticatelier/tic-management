<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Detail;

class DashboardController extends Controller
{
    public function index()
    {
        $role = User::find(Auth::id())->role;
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
}
