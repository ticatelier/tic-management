@extends('layouts.admin.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css')}}">
@endpush

@section('contents')
    <div class="page-wrapper">

        <div class="content container-fluid pb-0">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Admin!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
                            <div class="dash-widget-info">
                                @php
                                    $clients = DB::table('users')->where('role', 'user')->count();
                                @endphp
                                <h3>{{ $clients }}</h3>
                                <span>Participants</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
                            <div class="dash-widget-info">
                                @php
                                    $trainers = DB::table('users')->where('role', 'trainer')->count();
                                @endphp
                                <h3>{{ $trainers }}</h3>
                                <span>Trainers</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-regular fa-gem"></i></span>
                            <div class="dash-widget-info">
                                @php
                                    $service = DB::table('service_types')->count();
                                @endphp
                                <h3>{{ $service }}</h3>
                                <span>Service Types</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
                            <div class="dash-widget-info">
                                @php
                                    $sub = DB::table('client_subscriptions')->where('status', 'active')->count();
                                @endphp
                                <h3>{{ $sub }}</h3>
                                <span>Active Subcriptions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Total Revenue</h3>
                                    <div id="bar-charts"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Sales Overview</h3>
                                    <div id="line-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="card-group m-b-30">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">New Employees</span>
                                    </div>
                                    <div>
                                        <span class="text-success">+10%</span>
                                    </div>
                                </div>
                                <h3 class="mb-3">10</h3>
                                <div class="progress height-five mb-2">
                                    <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">Overall Employees 218</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">Earnings</span>
                                    </div>
                                    <div>
                                        <span class="text-success">+12.5%</span>
                                    </div>
                                </div>
                                <h3 class="mb-3">$1,42,300</h3>
                                <div class="progress height-five mb-2">
                                    <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">Previous Month <span class="text-muted">$1,15,852</span></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">Expenses</span>
                                    </div>
                                    <div>
                                        <span class="text-danger">-2.8%</span>
                                    </div>
                                </div>
                                <h3 class="mb-3">$8,500</h3>
                                <div class="progress height-five mb-2">
                                    <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">Previous Month <span class="text-muted">$7,500</span></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="d-block">Profit</span>
                                    </div>
                                    <div>
                                        <span class="text-danger">-75%</span>
                                    </div>
                                </div>
                                <h3 class="mb-3">$1,12,000</h3>
                                <div class="progress height-five mb-2">
                                    <div class="progress-bar bg-primary w-70" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mb-0">Previous Month <span class="text-muted">$1,42,000</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-4 d-flex">
                    <div class="card flex-fill dash-statistics">
                        <div class="card-body">
                            <h5 class="card-title">Statistics</h5>
                            <div class="stats-list">
                                <div class="stats-info">
                                    <p>Today Leave <strong>4 <small>/ 65</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary w-31" role="progressbar"
                                            aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Pending Invoice <strong>15 <small>/ 92</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning w-31" role="progressbar"
                                            aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Completed Projects <strong>85 <small>/ 112</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-success w-62" role="progressbar"
                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Open Tickets <strong>190 <small>/ 212</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger w-62" role="progressbar"
                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Closed Tickets <strong>22 <small>/ 212</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-info w-22" role="progressbar" aria-valuenow="22"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h4 class="card-title">Task Statistics</h4>
                            <div class="statistics">
                                <div class="row">
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box mb-4">
                                            <p>Total Tasks</p>
                                            <h3>385</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6 text-center">
                                        <div class="stats-box mb-4">
                                            <p>Overdue Tasks</p>
                                            <h3>19</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-purple w-30" role="progressbar" aria-valuenow="30"
                                    aria-valuemin="0" aria-valuemax="100">30%</div>
                                <div class="progress-bar bg-warning w-22" role="progressbar" aria-valuenow="18"
                                    aria-valuemin="0" aria-valuemax="100">22%</div>
                                <div class="progress-bar bg-success w-24" role="progressbar" aria-valuenow="12"
                                    aria-valuemin="0" aria-valuemax="100">24%</div>
                                <div class="progress-bar bg-danger w-21" role="progressbar" aria-valuenow="14"
                                    aria-valuemin="0" aria-valuemax="100">21%</div>
                                <div class="progress-bar bg-info w-10" role="progressbar" aria-valuenow="14"
                                    aria-valuemin="0" aria-valuemax="100">10%</div>
                            </div>
                            <div>
                                <p><i class="fa-regular fa-circle-dot text-purple me-2"></i>Completed Tasks <span
                                        class="float-end">166</span></p>
                                <p><i class="fa-regular fa-circle-dot text-warning me-2"></i>Inprogress Tasks <span
                                        class="float-end">115</span></p>
                                <p><i class="fa-regular fa-circle-dot text-success me-2"></i>On Hold Tasks <span
                                        class="float-end">31</span></p>
                                <p><i class="fa-regular fa-circle-dot text-danger me-2"></i>Pending Tasks <span
                                        class="float-end">47</span></p>
                                <p class="mb-0"><i class="fa-regular fa-circle-dot text-info me-2"></i>Review Tasks
                                    <span class="float-end">5</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <h4 class="card-title">Today Absent <span class="badge bg-inverse-danger ms-2">5</span>
                            </h4>
                            <div class="leave-info-box">
                                <div class="media d-flex align-items-center">
                                    <a href="profile.html" class="avatar"><img src="assets/img/user.jpg"
                                            alt="User Image"></a>
                                    <div class="media-body flex-grow-1">
                                        <div class="text-sm my-0">Martin Lewis</div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-6">
                                        <h6 class="mb-0">4 Sep 2019</h6>
                                        <span class="text-sm text-muted">Leave Date</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="badge bg-inverse-danger">Pending</span>
                                    </div>
                                </div>
                            </div>
                            <div class="leave-info-box">
                                <div class="media d-flex align-items-center">
                                    <a href="profile.html" class="avatar"><img src="assets/img/user.jpg"
                                            alt="User Image"></a>
                                    <div class="media-body flex-grow-1">
                                        <div class="text-sm my-0">Martin Lewis</div>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3">
                                    <div class="col-6">
                                        <h6 class="mb-0">4 Sep 2019</h6>
                                        <span class="text-sm text-muted">Leave Date</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="badge bg-inverse-success">Approved</span>
                                    </div>
                                </div>
                            </div>
                            <div class="load-more text-center">
                                <a class="text-dark" href="javascript:void(0);">Load More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Participant's Subscriptions</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>POS Number</th>
                                            <th>Client</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $subs = App\Models\ClientSubscription::latest()->take(3)->get()
                                        @endphp
                                        @foreach ($subs as $item)
                                            <tr>
                                                <td><a>{{ $item->posnumber }}</a></td>
                                                <td>
                                                    <h2><a href="#">{{ $item->user->name }}</a></h2>
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($item->duedate)->format('m-d-Y') }}</td>
                                                <td>
                                                    <span class="badge @if($item->status == 'active')bg-inverse-success @else bg-inverse-danger @endif">{{ $item->status }}</span>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.users.subscription') }}">View all subscriptions</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Services</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table table-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th>Service Options</th>
                                            <th>Service Type</th>
                                            <th>Hours</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $services = App\Models\ServiceOption::latest()->take(3)->get();
                                        @endphp
                                        @foreach ($services as $item)
                                            <tr>
                                                <td><a>{{ $item->option }}</a></td>
                                                <td>
                                                    <h2><a href="#">{{ $item->service->type }}</a></h2>
                                                </td>
                                                <td>{{ $item->hours }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.service.option') }}">View all services</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Participants</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $clients = App\Models\User::where('role', 'user')->take(5)->get()
                                        @endphp
                                        @foreach ($clients as $item)
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        {{-- <a href="#" class="avatar"><img
                                                                src="assets/img/profiles/avatar-19.jpg"
                                                                alt="User Image"></a> --}}
                                                        <a href="">{{ $item->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    {{ $item->email }}
                                                </td>
                                                <td>
                                                    <div class="dropdown action-label">
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                            href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-regular fa-circle-dot text-success"></i> Active
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fa-regular fa-circle-dot text-success"></i>
                                                                Active</a>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fa-regular fa-circle-dot text-danger"></i>
                                                                Inactive</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <form action="{{ route('admin.users.edit') }}">
                                                                        @csrf
                                                                        <input type="text" name="vim" value="{{ $item->id }}" hidden>
                                                                        <button class="dropdown-item" href="#"
                                                                            data-bs-toggle="modal" data-bs-target="#edit_type"><i
                                                                                class="fa-solid fa-pencil m-r-5"></i> Edit</button>
                                                                    </form>
                                                                    <form action="{{ route('admin.users.destroy') }}" method="POST">
                                                                        @csrf
                                                                        <input type="text" name="vim" value="{{ $item->id }}" hidden>

                                                                        <button class="dropdown-item" href="#"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_type"><i
                                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                                            Delete</button>
                                                                    </form>
                                                                </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.users.index') }}">View all participants</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Trainers</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $clients = App\Models\User::where('role', 'trainer')->take(5)->get()
                                        @endphp
                                        @foreach ($clients as $item)
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        {{-- <a href="#" class="avatar"><img
                                                                src="assets/img/profiles/avatar-19.jpg"
                                                                alt="User Image"></a> --}}
                                                        <a href="">{{ $item->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    {{ $item->email }}
                                                </td>
                                                <td>
                                                    <div class="dropdown action-label">
                                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                                            href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-regular fa-circle-dot text-success"></i> Active
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fa-regular fa-circle-dot text-success"></i>
                                                                Active</a>
                                                            <a class="dropdown-item" href="#"><i
                                                                    class="fa-regular fa-circle-dot text-danger"></i>
                                                                Inactive</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="material-icons">more_vert</i></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <form action="{{ route('admin.trainer.edit') }}">
                                                                        @csrf
                                                                        <input type="text" name="vim" value="{{ $item->id }}" hidden>
                                                                        <button class="dropdown-item" href="#"
                                                                            data-bs-toggle="modal" data-bs-target="#edit_type"><i
                                                                                class="fa-solid fa-pencil m-r-5"></i> Edit</button>
                                                                    </form>
                                                                    <form action="{{ route('admin.trainer.destroy') }}" method="POST">
                                                                        @csrf
                                                                        <input type="text" name="vim" value="{{ $item->id }}" hidden>

                                                                        <button class="dropdown-item" href="#"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#delete_type"><i
                                                                                class="fa-regular fa-trash-can m-r-5"></i>
                                                                            Delete</button>
                                                                    </form>
                                                                </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.trainer.index') }}">View all trainers</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script data-cfasync="false" src="{{ asset('cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/chart.js')}}" type="text/javascript"></script>
    <script src="{{ asset('cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"
    data-cf-settings="6404336b096bca57691aff4d-|49" defer></script>
@endpush
