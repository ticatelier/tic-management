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
                        <a href="{{ route('admin.service.option') }}"><button class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#add_trainer"> View Service Options</button></a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Service Note</h4>
                            <h5>{{ $note->day }} {{ $note->month }}, {{ $note->year }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 p-2 text-right">
                                    <h5>Participant</h5>
                                    <p>{{ $note->client->name }}</p>
                                </div>
                                <div class="col-4 p-2 text-right">
                                    <h5>DSP Trainer</h5>
                                    <p>{{ $note->trainer->name }}</p>
                                </div>
                                <div class="col-4 p-2 text-right">
                                    <h5>Hours Per Month</h5>
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3 p-2 text-right">
                                    <h5>Time in:</h5>
                                    <p>{{ $note->timein }}</p>
                                </div>
                                <div class="col-3 p-2 text-right">
                                    <h5>Time out:</h5>
                                    <p>{{ $note->timeout }}</p>
                                </div>
                                <div class="col-3 p-2 text-right">
                                    <h5>Daily Hours:</h5>
                                    <p>{{ $note->daily_hour }}</p>
                                </div>
                                <div class="col-3 p-2 text-right">
                                    <h5>Location:</h5>
                                    <p>{{ $note->Location }}</p>
                                </div>
                            </div>
                            <div class="row">
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

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label class="col-form-label">
                                            <input
                                                type="checkbox"
                                                {{ $note->medadmin == "As Directed" ? 'checked':'' }}
                                            />
                                            All Medications Administered as directed
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h4>Medication Changes</h4>
                                <p>{{ $note->medchanges }}</p>
                            </div>

                            <div class="row">
                                <h4>Behaviour Problems</h4>
                                <p>{{ $note->behaviour }}</p>
                            </div>

                            <div class="row">
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
