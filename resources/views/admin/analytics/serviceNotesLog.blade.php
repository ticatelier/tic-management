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
                        <h3 class="page-title">Service Note</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active">Service Note</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="{{ route('admin.analytics.servicenote.form') }}"><button class="btn btn-info"
                                data-bs-toggle="modal" data-bs-target="#add_trainer"> Service Notes</button></a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Service Note Log</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <div id="DataTables_Table_0_wrapper"
                                            class="dataTables_wrapper dt-bootstrap4 no-footer">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table
                                                        class="table table-striped custom-table mb-0 datatable dataTable no-footer"
                                                        id="DataTables_Table_0" role="grid"
                                                        aria-describedby="DataTables_Table_0_info">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="width-thirty sorting_asc" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1" aria-sort="ascending"
                                                                    aria-label="#: activate to sort column descending"
                                                                    style="width: 11.1094px;">#</th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Client Name : activate to sort column ascending"
                                                                    style="width: 140.922px;">Client Name </th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Trainer Name : activate to sort column ascending"
                                                                    style="width: 115.406px;">Trainer Name </th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Location : activate to sort column ascending"
                                                                    style="width: 178.703px;">Location </th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Time in : activate to sort column ascending"
                                                                    style="width: 119.109px;">Time in </th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Time out : activate to sort column ascending"
                                                                    style="width: 97.4531px;">Time out </th>
                                                                <th class="sorting" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Created at : activate to sort column ascending"
                                                                    style="width: 97.4531px;">Created at </th>
                                                                <th class="text-end sorting" tabindex="0"
                                                                    aria-controls="DataTables_Table_0" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Action: activate to sort column ascending"
                                                                    style="width: 45.4062px;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>


                                                            @php
                                                                $i = 0;
                                                            @endphp

                                                            @foreach ($notes as $note)
                                                                <tr class="odd">
                                                                    <td class="sorting_1">{{ $i = $i + 1 }}</td>
                                                                    <td>
                                                                        {{ $note->client->name }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $note->trainer->name }}
                                                                    </td>
                                                                    <td>{{ $note->Location }}</td>
                                                                    <td>{{ $note->timein }}</td>
                                                                    <td>{{ $note->timeout }}</td>
                                                                    <td>{{ Carbon\Carbon::parse($note->created_at)->format('m-d-Y') }}
                                                                    </td>

                                                                    <td class="text-end">
                                                                        <form
                                                                            action="{{ route('admin.analytics.servicenote') }}"
                                                                            method="GET">
                                                                            @csrf
                                                                            <input type="text" name="vim"
                                                                                value="{{ $note->id }}" hidden>
                                                                            <button class="dropdown-item"
                                                                                href="#">View Service Note</button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            {{-- <div class="row">

                                                <div class="col-sm-12 col-md-7">
                                                    <div class="dataTables_paginate paging_simple_numbers"
                                                        id="DataTables_Table_0_paginate">
                                                        <ul class="pagination">
                                                            <li class="paginate_button page-item previous disabled"
                                                                id="DataTables_Table_0_previous"><a href="#"
                                                                    aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0"
                                                                    class="page-link"><i class="fa fa-angle-double-left"></i> </a></li>
                                                            <li class="paginate_button page-item active"><a href="#"
                                                                    aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0"
                                                                    class="page-link">1</a></li>
                                                            <li class="paginate_button page-item next disabled"
                                                                id="DataTables_Table_0_next"><a href="#"
                                                                    aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0"
                                                                    class="page-link"> <i class=" fa fa-angle-double-right"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
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
