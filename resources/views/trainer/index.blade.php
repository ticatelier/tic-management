@extends('layouts.trainer.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
@endpush

@section('contents')
    <div class="page-wrapper">

        <div class="content container-fluid pb-0">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Trainer!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>

            @php
                $myclients = App\Models\AssignTrainer::where(
                    'trainer_id',
                    Illuminate\Support\Facades\Auth::id()
                )->latest()->take(3)->get();

                $date = Carbon\Carbon::now();
                $monthName = $date->format('F');
                $day = $date->format('l');
                $year = $date->format('Y');

                $notesall = App\Models\ServiceNote::where([
                    'trainer_id' => Illuminate\Support\Facades\Auth::id(),
                    'day' => $day,
                    'month' => $monthName,
                    'year' => $year
                ])->get();
            @endphp

            <div class="row">
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Clients</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($myclients as $item)
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        {{-- <a href="#" class="avatar"><img
                                                    src="assets/img/profiles/avatar-19.jpg"
                                                    alt="User Image"></a> --}}
                                                        <a href="">{{ $item->client->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    {{ $item->client->email ?? "N/A" }}
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
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('trainer.clients.index') }}">View all clients</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex">
                    <div class="card card-table flex-fill">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Daily Service Notes</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name of Participants</th>
                                            <th>Hours Spent</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notesall as $item)
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        {{-- <a href="#" class="avatar"><img
                                                    src="assets/img/profiles/avatar-19.jpg"
                                                    alt="User Image"></a> --}}
                                                        <a href="">{{ $item->client->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    {{ $item->daily_hour }}
                                                </td>
                                                <td>
                                                    <form method="GET" action="{{ route('trainer.services.note.view') }}">
                                                        @csrf
                                                        <input type="text" name="client" value="{{ $item->id }}" hidden>
                                                        <button type="submit" class="btn btn-info float-end">View Service Notes</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="card-footer">
                            <a href="{{ route('admin.trainer.index') }}">View all trainers</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script data-cfasync="false" src="{{ asset('cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/chart.js') }}" type="text/javascript"></script>
    <script src="{{ asset('cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="6404336b096bca57691aff4d-|49" defer></script>
@endpush
