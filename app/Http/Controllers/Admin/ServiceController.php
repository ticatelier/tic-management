<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceType;
use App\Models\ServiceOption;
use App\Models\ServiceNote;
use App\Models\User;
use Alert;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view service note', ['only' => ['servicenote']]);
        $this->middleware('permission:view monthly attendance', ['only' => ['calender', 'precalender']]);
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
        $all = ServiceType::get();
        return view('admin.services.index', ['all' => $all]);
    }

    public function create()
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $request->validate([
            'type' => 'unique:service_types|required',
            'description' => 'required',
        ]);

        $user = ServiceType::create([
            'type' => $request->type,
            'description' => $request->description,
        ]);

        Alert::success('Successful', $request->type.' has be registered successfully');
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }

        $id = $request->vim;
        $service = ServiceType::where('id', $id)->first();
        return view('admin.services.edit', ['service' => $service]);
    }

    public function update(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }

        $request->validate([
            'type' => 'required',
            'description' => 'required',
        ]);

        ServiceType::where('id', $request->id)
            ->update([
            'type' => $request->type,
            'description' => $request->description,
        ]);

        Alert::success('Successful', $request->type.' has be updated successfully');
        return redirect()->route('admin.service.index');
    }

    public function destroy(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $id = $request->vim;
        ServiceType::find($id)->delete();
        Alert::success('Deleted', 'Deleted Successfully');
        return redirect()->back();
    }

    public function option()
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $all = ServiceOption::orderBy('option', 'asc')->get();
        return view('admin.services.option.index', ['all' => $all]);
    }

    public function option_create(){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $services = ServiceType::orderBy('type', 'asc')->get();
        return view('admin.services.option.create', ['services' => $services]);
    }

    public function option_store(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $request->validate([
            'option' => 'unique:service_options|required',
            'service' => 'required',
            'hours' => 'required',
            'rate' => 'required',
        ]);

        $user = ServiceOption::create([
            'service_type_id' => $request->service,
            'option' => $request->option,
            'hours' => $request->hours,
            'rate' => $request->rate,
        ]);

        Alert::success('Successful', $request->option.' has be registered successfully');
        return redirect()->back();
    }

    public function option_edit(Request $request){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $services = ServiceType::orderBy('type', 'asc')->get();
        $option = ServiceOption::where('id', $request->vim)->first();
        return view('admin.services.option.edit', ['services' => $services, 'option' => $option]);
    }

    public function option_update(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $request->validate([
            'option' => 'required',
            'service' => 'required',
            'hours' => 'required',
            'rate' => 'required',
        ]);

        ServiceOption::where('id', $request->id)
            ->update([
            'service_type_id' => $request->service,
            'option' => $request->option,
            'hours' => $request->hours,
            'rate' => $request->rate,
        ]);

        Alert::success('Successful', $request->option.' has be updated successfully');
        return redirect()->route('admin.service.option');
    }

    public function option_destroy(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $id = $request->vim;
        ServiceOption::find($id)->delete();
        Alert::success('Deleted', 'Deleted Successfully');
        return redirect()->back();
    }

    public function pre_calender(){
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $services = ServiceType::orderBy('type', 'asc')->get();
        $years = ServiceNote::distinct()->select('year')->get();
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return view('admin.analytics.getMonthly', ['years' => $years, 'months' => $months, 'services' => $services]);
    }

    public function calender(Request $request)
    {
        $access = $this->access();
        if($access == 'no access'){
            Alert::error('Access Denied', 'You are trespassing and going beyond limits');
            return redirect()->back();
        }
        $request->validate([
            'month' => 'required',
            'year' => 'required',
            ''
        ]);

        if($request->service == 'all'){
            $attendance = ServiceNote::where(['month' => $request->month, 'year' => $request->year])->get()->groupBy('client_id');
        }else{
            $group = ServiceNote::where(['month' => $request->month, 'year' => $request->year])->get()->groupBy('client_id');
            foreach($group as $item){
                if($item->first()->subscription->service->service->type == $request->service){
                    $attendance[] = $item;
                }
            }
        }
        // foreach($attendance as $one){
        //     $date = Carbon::parse($request->timein)->format('d');
        //     echo $date;
        // }

        $monthNames = [
            'January' => 1, 'February' => 2, 'March' => 3, 'April' => 4,
            'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8,
            'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12,
        ];

        $date = $request->year.'-'.$monthNames[$request->month];
        $start = Carbon::parse($date)->startOfMonth();
        $end = Carbon::parse($date)->endOfMonth();

        $period = CarbonPeriod::create($start, $end);
        foreach($period as $date){
            $days[] = substr($date->format('l'), 0, 3)." ".$date->format('d-m');
        }

        foreach($period as $date){
            $dates[] = $date->format('d-m-Y');
        }
        $month = $request->month;
        $year = $request->year;



        // foreach($dates as $date){
        //     echo $date;
        // }
        return view('admin.analytics.viewMonthly', ['attendance' => $attendance, 'dates' => $dates, 'days' => $days, 'month' => $month, 'year' => $year]);
    }

    public function servicenoteform(){
        return view('admin.analytics.getServiceNotes');
    }

    public function servicenotelist(Request $request){
        $request->validate([
            'day' => 'required'
        ]);

        $date = Carbon::parse($request->day);
        $monthName = $date->format('F');
        $day = $date->format('l');
        $year = $date->format('Y');

        $notesall = ServiceNote::where([
            'month' => $monthName,
            'year' => $year
        ])->get();

        $notes = array();

        foreach($notesall as $item){
            $today = $date->format('Y-m-d');
            $queriedDate = Carbon::parse($item->created_at)->format('Y-m-d');
            if($today == $queriedDate){
                $notes[] = $item;
            }
        }

        return view('admin.analytics.serviceNotesLog', ['notes' => $notes]);
    }

    public function todayServiceNotes()
    {
        $date = Carbon::now();
        $monthName = $date->format('F');
        $day = $date->format('l');
        $year = $date->format('Y');

        $notesall = ServiceNote::where([
            'month' => $monthName,
            'year' => $year
        ])->get();

        $notes = array();

        foreach($notesall as $item){
            $today = $date->format('Y-m-d');
            $queriedDate = Carbon::parse($item->created_at)->format('Y-m-d');
            if($today == $queriedDate){
                $notes[] = $item;
            }
        }

        return view('admin.analytics.serviceNotesLog', ['notes' => $notes]);
    }

    public function servicenote(Request $request){
        $note = ServiceNote::where('id', $request->vim)->first();
        return view('admin.analytics.singleServiceNote', ['note' => $note]);
    }
}
