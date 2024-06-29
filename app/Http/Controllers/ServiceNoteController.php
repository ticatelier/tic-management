<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignTrainer;
use App\Models\ClientSubscription;
use App\Models\ServiceNote;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Alert;
use Carbon\Carbon;

class ServiceNoteController extends Controller
{
    public function note(){
        $myclients = AssignTrainer::where('trainer_id', User::find(Auth::id())->id)->get();
        return view('trainer.services.note', ['myclients' => $myclients]);
    }

    public function note_create(Request $request)
    {
        $request->validate([
            'client' => 'required',
            'timein' => 'required',
            'timeout' => 'required',
            'location' => 'required',
            'medadmin' => 'required',
            'medchanges' => 'required',
            'behaviour' => 'required',
            'activities' => 'required',
            'categories' => 'required'
        ]);

        $start = Carbon::parse($request->timein);
        $end = Carbon::parse($request->timeout);
        $hours = $start->diffInHours($end);

        $date = Carbon::now();
        $monthName = $date->format('F');
        $day = $date->format('l');
        $year = $date->format('Y');

        $check = ServiceNote::where([
            'client_id' => $request->client,
            'trainer_id' => Auth::id(),
            'month' => $monthName,
            'day' => $day,
            'year' => $year,
        ])->first();

        if($check != null){
            Alert::error('Duplicate', 'Service note has been added for today');
            return redirect()->back();
        }


        $sub = ClientSubscription::where(
            'user_id', $request->client
        )->first();


        ServiceNote::create([
            'client_id' => $request->client,
            'trainer_id' => Auth::id(),
            'client_subscription_id' => $sub->id,
            'timein' => $request->timein,
            'timeout' => $request->timeout,
            'medchanges' => $request->medchanges,
            'medadmin' => $request->medadmin,
            'Location' => $request->location,
            'behaviour' => $request->behaviour,
            'activities' => $request->activities,
            'categories' => json_encode($request->categories),
            'daily_hour' => $hours,
            'month' => $monthName,
            'day' => $day,
            'year' => $year,
        ]);

        Alert::success('Successful', 'Service note has be added successfully');
        return redirect()->intended(route('trainer.clients.index'));
    }
}
