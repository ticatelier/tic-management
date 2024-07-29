@extends('layouts.trainer.app')

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
                        <a href="{{ route('dashboard') }}"><button class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#add_trainer"> Dashboard</button></a>
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
                                    <h4>DSP Trainer</h4>
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
                                @php
                                    $categories = json_decode($note->categories);
                                @endphp
                                @foreach ($categories as $item)
                                    <div class="col-md-3">
                                        <div class="checkbox">
                                            <label class="col-form-label">
                                                <input
                                                    type="checkbox"
                                                    checked
                                                />
                                                {{ $item }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row mb-2 border border-secondary" style="padding: 14px 6px;">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label class="col-form-label">
                                            <input
                                                type="checkbox"
                                                {{ $note->medadmin == "As Directed" ? 'checked':'' }}
                                            />
                                            <span class="h4"> Medications Administered as directed</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2 border border-secondary" style="padding: 14px 6px;">
                                <h4>Medication Changes</h4>
                                <p>{{ $note->medchanges }}</p>
                            </div>

                            <div class="row mb-2 border border-secondary" style="padding: 14px 6px;">
                                <h4>Behaviour Problems</h4>
                                <p>{{ $note->behaviour }}</p>
                            </div>

                            <div class="row mb-2 border border-secondary" style="padding: 14px 6px;">
                                <h4>Activities and Staff Communication</h4>
                                <p>{{ $note->activities }}</p>
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
