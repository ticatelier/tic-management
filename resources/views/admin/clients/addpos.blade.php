@extends('layouts.admin.app')

@push('css')

@endpush

@section('contents')
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Subscription</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active">POS number</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="{{ route('admin.users.subscription') }}"><button class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#add_trainer"> View Subscriptions</button></a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Update POS Number</h4>
                        </div>
                        <div class="card-body">
                            @if($errors)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('admin.users.subscription.store') }}">
                                @csrf
                                <div class="input-block mb-3 row">
                                    <label class="col-form-label col-md-2">Participant</label>
                                    <div class="col-md-10">
                                        <select name="user" class="form-control form-select">
                                            <option value="" selected disabled>-Select Participant</option>
                                            @foreach ($all as $sub)
                                                <option value="{{ $sub->user_id }}">{{ $sub->user->name }} ({{ $sub->service->option }})</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="input-block mb-3 row">
                                    <label class="col-form-label col-md-2">Pos Number</label>
                                    <div class="col-md-10">
                                        <input name="posnumber" type="text" class="form-control" required>
                                    </div>
                                </div>

                                <div class="input-block mb-3 row">
                                    <label class="col-form-label col-md-2">Start Date</label>
                                    <div class="col-md-10">
                                        <input name="startdate" type="date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="input-block mb-3 row">
                                    <label class="col-form-label col-md-2">Due Date</label>
                                    <div class="col-md-10">
                                        <input name="duedate" type="date" class="form-control" required>
                                    </div>
                                </div>


                                <div class="col-auto float-end ms-auto">
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add_trainer"><i
                                            class="fa-solid fa-plus"></i> Add Subscription</button>
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

@endpush
