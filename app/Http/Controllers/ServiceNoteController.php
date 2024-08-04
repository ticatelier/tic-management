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
use Illuminate\Support\Facades\Mail;
use App\Mail\NoteNotify;

class ServiceNoteController extends Controller
{
    public function note(Request $request){
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

        $myclients = AssignTrainer::where('trainer_id', User::find(Auth::id())->id)->get();
        $client = User::where('id', $request->client)->first();
        return view('trainer.services.note', ['myclients' => $myclients, 'client' => $client]);
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

        // check the subscription
        $status = ClientSubscription::where('user_id', $request->client)->latest()->first();
        if($status == null){
            Alert::error('Error', 'No active subscription for selected client');
            return redirect()->back();
        }
        if($status->status == 'unactive'){
            Alert::error('Error', 'No active subscription for selected client');
            return redirect()->back();
        }

        $max_hour = $status->service->hours;

        $start = Carbon::parse($request->timein);
        $end = Carbon::parse($request->timeout);
        $hours = $start->diffInHours($end);

        $date = Carbon::now();
        $monthName = $date->format('F');
        $day = $date->format('l');
        $year = $date->format('Y');

        // Sum of the previous hours and the entered hours
        $service_hour = ServiceNote::where([
            'client_id' => $request->client,
            'month' => $monthName,
            'year' => $year
        ])->sum('daily_hour');

        $client_hour = $hours;

        if($service_hour != null){
            $client_hour = $client_hour + $service_hour;
        }

        if($client_hour > $max_hour){
            Alert::error('Maximum Hours', 'Maximum Hours logged in already');
            return redirect()->back();
        }

        if($hours <= 0){
            Alert::error('Invalid Hours Spent', 'Check your time in and time out values');
            return redirect()->back();
        }


        $sub = ClientSubscription::where(
            'user_id', $request->client
        )->first();


        $service = ServiceNote::create([
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

        $user = User::where('role', 'superadmin')->first();
        $trainer = User::where('id', Auth::id())->first()->name;
        $client = User::where('id', $request->client)->first()->name;
        $time = $service->created_at;
        Mail::to($user->email)->send(new NoteNotify([
            'name' => $user->name,
            'trainer' => $trainer,
            'client' => $client,
            'time' => Carbon::parse($time)->format('m-d-Y H:m')
        ]));

        Alert::success('Successful', 'Service note has be added successfully');
        return redirect()->intended(route('trainer.clients.index'));
    }

    public function servicenote(Request $request){
        $note = ServiceNote::where('id', $request->client)->first();
        return view('trainer.services.singleServiceNote', ['note' => $note]);
    }
}
