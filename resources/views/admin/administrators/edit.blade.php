@extends('layouts.admin.app')

@push('css')

@endpush

@section('contents')
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Administrators</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Administrators</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="{{ route('admin.administrators.index') }}"><button class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#add_trainer"> View Administrators</button></a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Add Administrator</h4>
                        </div>
                        <div class="card-body">
                            @if($errors)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('admin.administrators.update') }}">
                                @csrf
                                <input type="text" name="id" value="{{ $user->id }}" hidden>
                                <div class="input-block mb-3 row">
                                    <label class="col-form-label col-md-2">Name</label>
                                    <div class="col-md-10">
                                        <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="input-block mb-3 row">
                                    <label class="col-form-label col-md-2">Email</label>
                                    <div class="col-md-10">
                                        <input name="email" type="email" value="{{ $user->email }}" class="form-control" required>
                                    </div>
                                </div>

                                {{-- <div class="input-block mb-3 row">
                                    <label class="col-form-label col-md-2">Service Option</label>
                                    <div class="col-md-10">
                                        <select name="service" class="form-control form-select">
                                            <option value="" selected disabled>-Select Service Option</option>
                                            @foreach ($all as $service)
                                                <option value="" disabled>---- {{ $service->type }} ----</option>
                                                @php
                                                    $collection = $service->options
                                                @endphp
                                                @foreach ($collection as $item)
                                                    <option value="{{ $item->id }}">{{ $item->option }}</option>
                                                @endforeach
                                            @endforeach

                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-auto float-end ms-auto">
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add_trainer"><i
                                            class="fa-solid fa-plus"></i> Update Administrator</button>
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
