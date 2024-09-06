@extends('layouts.admin.app')

@push('css')

@endpush

@section('contents')
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Service Note</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active">Service Note</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="{{ route('admin.analytics.servicenote.form') }}"><button class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#add_trainer"> Service Note</button></a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card p-2 border border-secondary border-3">
                        <div class="card-header text-center">
                            <div class="row justify-content-center">
                                <img src="{{ asset('assets/img/logo2.jpg')}}" alt="Logo" style="width: 230px">
                            </div>
                            <h4 class="card-title mb-0">DAILY SERVICE LOG</h4>
                            <h5>{{ $note->day }} {{ Carbon\Carbon::parse($note->created_at)->format('d') }} {{ $note->month }}, {{ $note->year }}</h5>
                        </div>
                        <div class="card-body" style="padding: 14px 6px;">
                            <div class="row border mb-2 border-secondary" style="padding: 14px 6px;">
                                <div class="col-4 p-2 text-right border border-secondary" style="padding: 14px 6px;">
                                    <h4>Participant</h4>
                                    <p>{{ $note->client->name }}</p>
                                </div>
                                <div class="col-4 p-2 text-right border border-secondary" style="padding: 14px 6px;">
                                    <h4>TIC Trainer</h4>
                                    <p>{{ $note->trainer->name }}</p>
                                </div>
                                <div class="col-4 p-2 text-right border border-secondary" style="padding: 14px 6px;">
                                    <h4>Hours Per Month</h4>
                                    <p>{{ $note->client->subscription->service->hours }}</p>
                                </div>
                            </div>

                            <div class="row mb-2 border border-secondary" style="padding: 14px 6px;">
                                <div class="col-3 p-2 text-right border border-secondary" style="padding: 14px 6px;">
                                    <h4>Time in:</h4>
                                    <p>{{ $note->timein }}</p>
                                </div>
                                <div class="col-3 p-2 text-right border border-secondary" style="padding: 14px 6px;">
                                    <h4>Time out:</h4>
                                    <p>{{ $note->timeout }}</p>
                                </div>
                                <div class="col-3 p-2 text-right border border-secondary" style="padding: 14px 6px;">
                                    <h4>Daily Hours:</h4>
                                    <p>{{ $note->daily_hour }}</p>
                                </div>
                                <div class="col-3 p-2 text-right border border-secondary" style="padding: 14px 6px;">
                                    <h4>Location:</h4>
                                    <p>{{ $note->Location }}</p>
                                </div>
                            </div>
                            <div class="row mb-2 border border-secondary" style="padding: 14px 6px;">
                                <h4>Classes Taught</h4>
                                <p>{{ $note->classes_taught }}</p>
                            </div>

                            <div class="row mb-2 border border-secondary" style="padding: 14px 6px;">
                                <h4>Report</h4>
                                <p>{{ $note->report }}</p>
                            </div>

                            <div class="row mb-2 border border-secondary" style="padding: 14px 6px;">
                                <h4>Remarks</h4>
                                <p>{{ $note->remark }}</p>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('js')

@endpush
