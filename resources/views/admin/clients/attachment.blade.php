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
                            <li class="breadcrumb-item active">Participants</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="{{ route('admin.users.index') }}"><button class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#add_trainer"> View Participants</button></a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0 text-center">{{$client->name}}</h4>
                        </div>
                        <div class="card-body">
                            @if($errors)
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('admin.users.attachment.add') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="id" value="{{$client->id}}">
                                <div class="input-block mb-3 row">
                                    <label class="col-form-label col-md-2">File Type</label>
                                    <div class="col-md-8">
                                        <select name="type" class="form-control form-select">
                                            <option value="" selected disabled>-- Select --</option>
                                            <option>Service Type</option>
                                            <option>Face Sheet</option>
                                            <option>Admission Agreement</option>
                                            <option>Copy of ID</option>
                                            <option>Copy of Social</option>
                                            <option>Current Progress Report</option>
                                            <option>Latest C.D.E.R</option>
                                            <option>Psych Evaluation</option>
                                            <option>Latest IPP</option>
                                            <option>Leasing Contracts</option>
                                            <option>ID Notes</option>
                                        </select>
                                    </div>
                                </div>
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
                            <h4 class="card-title mb-0">View Attachments</h4>
                            <h4 class="mb-0 text-center">{{ $type }} Documents</h4>
                        </div>
                        <div class="card-body">
                            <div class="row d-flex" style="width: 100%; justify-content: center; margin-bottom: 45px;">
                                <div class="col-md-6">
                                    <form action="{{ route('admin.users.attachment.query') }}" method="get">
                                        <input type="hidden" name="vim" value="{{ $client->id }}">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <select name="type" class="form-control form-select">
                                                        <option value="" selected disabled>-- Select File Type --
                                                        </option>
                                                        <option>All</option>
                                                        <option>Service Type</option>
                                                        <option>Face Sheet</option>
                                                        <option>Admission Agreement</option>
                                                        <option>Copy of ID</option>
                                                        <option>Copy of Social</option>
                                                        <option>Current Progress Report</option>
                                                        <option>Latest C.D.E.R</option>
                                                        <option>Psych Evaluation</option>
                                                        <option>Latest IPP</option>
                                                        <option>Leasing Contracts</option>
                                                        <option>ID Notes</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="form-control btn btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#add_trainer"><i class="fa-solid fa-search"></i>
                                                        Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                {{-- {{ $client->attachment }} --}}
                                @foreach ($attachment as $item)
                                    <div class="col-md-3 col-sm-6">
                                        <p class="text-center">{{$item->path}}</p>
                                        <div class="row flex justify-content-center">
                                            @if(str_contains(strtolower($item->path), 'jpg') || str_contains(strtolower($item->path), 'png') || str_contains(strtolower($item->path), 'jpeg') || str_contains(strtolower($item->path), 'webp'))
                                                <img id="attached" src="{{asset('attachments/participants/'.$item->user_id."/".$item->path)}}" alt="File Img" style="width: 200px; height: 200px">
                                            @else
                                                <img id="attached" src="{{asset('attachments/file.png')}}" alt="File Img" style="width: 200px; height: 200px">
                                            @endif
                                        </div>

                                        <form action="{{route('admin.users.attachment.download')}}" method="get">
                                            @csrf
                                            <div class="row justify-content-center" style="padding: 10px 10px;">
                                                <input type="hidden" name="vim" value="{{$item->id}}">
                                                <button type="submit" class="btn btn-info" style="width: 120px">
                                                    <i class="fa-solid fa-arrow-down"></i> Download
                                                </button>
                                            </div>
                                        </form>

                                        <form action="{{route('admin.users.attachment.delete')}}" method="post">
                                            @csrf
                                            <div class="row justify-content-center" style="padding: 10px 10px;">
                                                <input type="hidden" name="vim" value="{{$item->id}}">
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
        function standby()
        {
            document.getElementById('attached').src = '/attachments/file.png'
        }
    </script>
@endpush
