@extends('layouts.admin.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
@endpush

@section('contents')
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">View Monthly Attendance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active">View Monthly Attendance</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="{{ route('admin.analytics.monthly') }}"><button class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#add_trainer"> Previous Page
                            </button></a>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">{{ $month . ' ' . $year }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" style="border-color: black">
                                    <thead>
                                        <tr style="font-size:12px">
                                            <th style="position: sticky; font-size:12px;">Client Name</th>
                                            <th style="position: relative; font-size:12px;">POS Number</th>
                                            @foreach ($days as $day)
                                                <th
                                                    style="@if (str_contains($day, 'Sat') || str_contains($day, 'Sun')) background-color: lightblue; @endif font-size:12px;">
                                                    {{ $day }}</th>
                                            @endforeach
                                            <th>Hours</th>
                                            <th>Type</th>
                                            <th>SLS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendance as $item)
                                            <tr style="font-size:12px;">
                                                <td style="position: sticky">{{ $item->first()->client->name }}</td>
                                                <td style="color: blue; position: relative; margin-left:60px;">
                                                    {{ $item->first()->subscription->posnumber }}</td>
                                                @php
                                                    $totalhours = 0;

                                                    $monthNames = [
                                                        'January' => 1,
                                                        'February' => 2,
                                                        'March' => 3,
                                                        'April' => 4,
                                                        'May' => 5,
                                                        'June' => 6,
                                                        'July' => 7,
                                                        'August' => 8,
                                                        'September' => 9,
                                                        'October' => 10,
                                                        'November' => 11,
                                                        'December' => 12,
                                                    ];

                                                @endphp
                                                @foreach ($dates as $date)
                                                    @php
                                                        $i = 'none';
                                                        $day = Carbon\Carbon::parse($date)->format('l');
                                                    @endphp
                                                    @foreach ($item as $hour)
                                                        @if (Carbon\Carbon::parse($hour->date."-".$monthNames[$hour->month]."-".$hour->year)->format('d-m-Y') == $date)
                                                            @php
                                                                $i = 'full';
                                                                $totalhours = $totalhours + $hour->daily_hour;
                                                            @endphp
                                                            <td
                                                                style="@if ($day == 'Saturday' || $day == 'Sunday') background-color: lightblue; @endif text-align: center">
                                                                {{ $hour->daily_hour }}
                                                                <br>
                                                                <small style="color: blue">
                                                                    {{ $hour->trainer->name }}
                                                                </small>
                                                                <form action="{{ route('admin.analytics.servicenote') }}"
                                                                    method="GET">
                                                                    @csrf
                                                                    <input type="text" name="vim"
                                                                        value="{{ $hour->id }}" hidden>
                                                                    <button class="dropdown-item" href="#">View
                                                                        Service Note</button>
                                                                </form>
                                                            </td>
                                                        @else
                                                        @endif
                                                    @endforeach
                                                    @if ($i == 'none')
                                                        <td
                                                            style="@if ($day == 'Saturday' || $day == 'Sunday') background-color: lightblue @endif">
                                                        </td>
                                                    @endif
                                                @endforeach
                                                <td>{{ $totalhours }}</td>
                                                <td>{{ $item->first()->subscription->service->option }}</td>
                                                <td>{{ $item->first()->subscription->service->service->type }}</td>
                                            </tr>
                                        @endforeach

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
@endpush
