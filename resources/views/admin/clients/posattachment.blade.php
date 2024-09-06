@extends('layouts.admin.app')

@push('css')
@endpush

@section('contents')
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Attachments</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active">POS</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="{{ route('admin.users.subscription') }}"><button class="btn btn-info"
                                data-bs-toggle="modal" data-bs-target="#add_trainer"> View Clients</button></a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0 text-center">{{ $client->user->name }} POS Documents</h4>
                            <p class="mb-0 text-center">Active POS Number : {{ $client->posnumber }}</p>
                        </div>
                        <div class="card-body">
                            @if ($errors)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('admin.users.subscription.attachment.add') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $client->id }}">
                                
                                <div class="input-block mb-3 row">
                                    <label class="col-form-label col-md-2">Attachments {Max: 10 files}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="file" name="attachments[]" multiple>
                                    </div>
                                    <div class="col-md-2 float-end ms-auto">
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add_trainer"><i
                                                class="fa-solid fa-plus"></i> Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">View POS Documents</h4>
                        </div>
                        <div class="card-body">
                            
                            <div class="row">
                                {{-- {{ $client->attachment }} --}}
                                @foreach ($posAttach as $item)
                                    <div class="col-md-3 col-sm-6">
                                        <p class="text-center">{{ $item->path }}</p>
                                        <div class="row flex justify-content-center">
                                            @if (str_contains(strtolower($item->path), 'jpg') ||
                                                    str_contains(strtolower($item->path), 'png') ||
                                                    str_contains(strtolower($item->path), 'jpeg') ||
                                                    str_contains(strtolower($item->path), 'webp'))
                                                <img id="attached"
                                                    src="{{ asset('attachments/pos/' . $client->id . '/' . $item->path) }}"
                                                    alt="File Img" style="width: 200px; height: 200px">
                                            @else
                                                <img id="attached" src="{{ asset('attachments/file.png') }}"
                                                    alt="File Img" style="width: 200px; height: 200px">
                                            @endif
                                        </div>

                                        <form action="{{ route('admin.users.subscription.attachment.download') }}"
                                            method="get">
                                            @csrf
                                            <div class="row justify-content-center" style="padding: 10px 10px;">
                                                <input type="hidden" name="vim" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-info" style="width: 120px">
                                                    <i class="fa-solid fa-arrow-down"></i> Download
                                                </button>
                                            </div>
                                        </form>

                                        <form action="{{ route('admin.users.subscription.attachment.delete') }}"
                                            method="post">
                                            @csrf
                                            <div class="row justify-content-center" style="padding: 10px 10px;">
                                                <input type="hidden" name="vim" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-danger" style="width: 120px">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('js')
    <script>
        function standby() {
            document.getElementById('attached').src = '/attachments/file.png'
        }
    </script>
@endpush
