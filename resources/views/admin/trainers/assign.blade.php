@extends('layouts.admin.app')

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
                        <h3 class="page-title">Assign Trainers</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                            <li class="breadcrumb-item active">Assign Trainers</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="{{ route('admin.trainer.index') }}"><button class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#add_trainer">View Trainer</button></a>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.trainer.assign.store') }}">
                @csrf
                <div class="row filter-row">

                    <div class="col-sm-6 col-md-3" data-select2-id="select2-data-6-jit7">
                        <div class="input-block mb-3 form-focus select-focus focused" data-select2-id="select2-data-5-083d">
                            <select name="trainer" class="select floating select2-hidden-accessible"
                                data-select2-id="select2-data-1-vus5" tabindex="-1" aria-hidden="true">
                                <option value="" selected disabled>Select Trainer</option>
                                @foreach ($all as $trainer)
                                    <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                @endforeach

                            </select>
                            <label class="focus-label">Select Trainer</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="input-block mb-3 form-focus select-focus focused" data-select2-id="select2-data-5-083d">
                            <select name="users[]" class="select floating select2-hidden-accessible"
                                id="multiple-checkboxes" multiple="multiple" style="height: 50px">
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }} (
                                        @if ($client->subscription != null)
                                            {{ $client->subscription->service->option }}
                                        @endif
                                        )
                                    </option>
                                @endforeach
                            </select>
                            <label class="focus-label">Select User</label>
                            <span class="select2 select2-container select2-container--default select2-container--above"
                                dir="ltr" data-select2-id="8" style="width: 431px;"><span
                                    class="selection"></span><span class="dropdown-wrapper"
                                    aria-hidden="true"></span></span>

                            {{-- <span
                                class="select2 select2-container select2-container--default select2-container--below select2-container--focus"
                                dir="ltr" data-select2-id="3" style="width: 100%; padding-top:8px; height:50px;"><span class="selection" style="width: 100%; padding-top:8px; height:50px;"></span><span class="dropdown-wrapper" aria-hidden="true"></span>
                            </span> --}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-info"> Assign Trainer</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            {{-- <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select
                                                name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                                class="custom-select custom-select-sm form-control form-control-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> entries</label></div>
                                </div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div> --}}
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped custom-table mb-0 datatable dataTable no-footer"
                                        id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="width-thirty sorting_asc" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-sort="ascending"
                                                    aria-label="#: activate to sort column descending"
                                                    style="width: 11.1094px;">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Trainer Name : activate to sort column ascending"
                                                    style="width: 140.922px;">Trainer Name </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Assigned Clients : activate to sort column ascending"
                                                    style="width: 115.406px;">Assigned Clients </th>

                                                <th class="text-end sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    aria-label="Action: activate to sort column ascending"
                                                    style="width: 45.4062px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @php
                                                $i = 0;
                                            @endphp

                                            @foreach ($all as $user)
                                                <tr class="odd">
                                                    <td class="sorting_1">{{ $i = $i + 1 }}</td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="">{{ $user->name }} </a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $collection = $user->trainer;
                                                        @endphp
                                                        @foreach ($collection as $item)
                                                            <p>
                                                                {{ $item->client->name }}
                                                            </p>
                                                        @endforeach
                                                    </td>

                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                    class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <form action="{{ route('admin.trainer.unassign') }}">
                                                                    @csrf
                                                                    <input type="text" name="vim" value="{{ $user->id }}" hidden>
                                                                    <button class="dropdown-item" href="#"
                                                                        data-bs-toggle="modal" data-bs-target="#edit_type"><i
                                                                            class="fa-solid fa-pencil m-r-5"></i> Unassign</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                        aria-live="polite">Showing 1 to 5 of 5 entries</div>
                                </div> --}}
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
                            </div>
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
