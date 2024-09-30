@extends('layouts.trainer.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
@endpush

@section('contents')
<div class="page-wrapper">

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Services</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active">Service Note</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="{{ route('admin.users.index') }}"><button class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#add_trainer"> View Service Notes</button></a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Add Service Note</h4>
                    </div>
                    <div class="card-body">
                        @if($errors)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ route('trainer.services.note.create') }}">
                            @csrf
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Date</label>
                                <div class="col-md-10">
                                    <input type="date" value="{{$date}}" class="form-control" disabled>
                                    <input name="date" type="date" value="{{$date}}" class="form-control" hidden>
                                </div>
                            </div>
                            
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Client</label>
                                <div class="col-md-10">
                                    <select name="client" class="form-control form-select">
                                        <option value="" disabled>-Select a Client</option>
                                        @if ($client != null)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endif
                                        {{-- <option value="" disabled>--Other Clients--</option>
                                        @foreach ($myclients as $myclient)
                                            <option value="{{ $myclient->client_id }}">{{ $myclient->client->name }}</option>
                                        @endforeach --}}

                                    </select>
                                </div>
                            </div>
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Time In</label>
                                <div class="col-md-10">
                                    <input name="timein" type="time" class="form-control">
                                </div>
                            </div>

                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Time Out</label>
                                <div class="col-md-10">
                                    <input name="timeout" type="time" class="form-control" required>
                                </div>
                            </div>
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Location</label>
                                <div class="col-md-10">
                                    <input name="location" type="text" class="form-control">
                                </div>
                            </div>

                            

                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Classes Taught</label>
                                <div class="col-md-10">
                                    <textarea name="classes_taught" rows="5" cols="5" class="form-control" placeholder="Eg, Basic 1, Basic 2, Basic 3"></textarea>
                                </div>
                            </div>

                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Report</label>
                                <div class="col-md-10">
                                    <textarea name="report" rows="5" cols="5" class="form-control" placeholder="Enter your daily report here"></textarea>
                                </div>
                            </div>

                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Remarks</label>
                                <div class="col-md-10">
                                    <textarea name="remark" rows="5" cols="5" class="form-control" placeholder="Enter each remarks for each classes here"></textarea>
                                </div>
                            </div>



                            <div class="col-auto float-end ms-auto">
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add_trainer"><i
                                        class="fa-solid fa-plus"></i> Add Service Note</button>
                            </div>
                            {{-- <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Password</label>
                                <div class="col-md-10">
                                    <input type="password" class="form-control">
                                </div>
                            </div>
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Disabled Input</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" disabled="disabled">
                                </div>
                            </div>
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Readonly Input</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" value="readonly" readonly="readonly">
                                </div>
                            </div>
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Placeholder</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Placeholder">
                                </div>
                            </div>
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">File Input</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="file">
                                </div>
                            </div>
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Default Select</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select">
                                        <option>-- Select --</option>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Radio</label>
                                <div class="col-md-10">
                                    <div class="radio">
                                        <label class="col-form-label">
                                            <input type="radio" name="radio"> Option 1
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="col-form-label">
                                            <input type="radio" name="radio"> Option 2
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="col-form-label">
                                            <input type="radio" name="radio"> Option 3
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Checkbox</label>
                                <div class="col-md-10">
                                    <div class="checkbox">
                                        <label class="col-form-label">
                                            <input type="checkbox" name="checkbox"> Option 1
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-form-label">
                                            <input type="checkbox" name="checkbox"> Option 2
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label class="col-form-label">
                                            <input type="checkbox" name="checkbox"> Option 3
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="input-block mb-3 row">
                                <label class="col-form-label col-md-2">Textarea</label>
                                <div class="col-md-10">
                                    <textarea rows="5" cols="5" class="form-control" placeholder="Enter text here"></textarea>
                                </div>
                            </div>
                            <div class="input-block row">
                                <label class="col-form-label col-md-2">Input Addons</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input class="form-control" type="text">
                                        <button class="btn btn-primary" type="button">Button</button>
                                    </div>
                                </div>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@push('js')
    {{-- <script src="{{ asset('assets/js/select2.min.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/select2/js/custom-select.js') }}" type="text/javascript"></script>

    {{-- <script src="{{ asset('mutli/js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script> --}}
    <script src="{{ asset('assets/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
@endpush
