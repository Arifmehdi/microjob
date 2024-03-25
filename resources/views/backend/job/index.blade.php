@extends('backend.layouts.app')
@section('title')
    {{ __('Jobs') }}
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/sweetalerts/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/components/custom-modal.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/animate/animate.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>{{ __('Jobs') }}</h5>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <a href="{{ route('admin.jobs.create') }}"
                               class="btn btn-primary">{{ __('Add Job') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="users" class="table dt-table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            {{-- <th>Link</th> --}}
                            <th>Author</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created AT</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td>#{{ $job->id ?? '' }}</td>
                                <td><img src="{{ asset('storage/upload/'.$job->image ?? '') }}" alt="Thumbnail"
                                         width="70"></td>
                                <td>{{ str()->limit($job->title,20) ?? '' }}</td>
                                {{-- <td>{{ str()->limit($job->link,20) ?? '' }}</td> --}}
                                <td>{{ $job->user ? $job->user->name:'' }}</td>
                                <td>{{ $job->category ? $job->category->name:'' }}</td>
                                <td>{{  balanceFormat($job->estimated_cost ?? 0) }}</td>
                                <td>
                                    @if($job->is_approved)
                                        <span class="badge badge-success">Approved</span>
                                    @elseif(is_null($job->is_approved))
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $job->created_at ? $job->created_at->format('d-m-Y h:i a') : '' }}</td>
                                <td>
                                    {{--<button
                                        class="border-0 bg-transparent {{ $job->is_approved ? 'text-danger':'text-success' }}"
                                        onclick="event.preventDefault(); jobApproved(this,{{ $job->id }})">
                                        @if($job->is_approved)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-x-circle">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-check-square">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path
                                                    d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                            </svg>
                                        @endif
                                    </button>--}}
                                    <a href="{{ route('admin.jobs.show',$job->id) }}"
                                       class="text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-edit table-sm">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            {{-- <th>Link</th> --}}
                            <th>Author</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created AT</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('backend/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/blockui/jquery.blockUI.min.js') }}"></script>
    <script>
        $('#users').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [25, 50, 100, 200],
            "pageLength": 25,
            "ordering": false,
            "columns":[
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {'searchable': false},
                {'searchable': false}
            ]
        });

        function deleteData(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                padding: '1.5em'
            }).then(function (result) {
                if (result.value) {
                    $('#delete-data-' + id).submit();
                }
            })
        }

        function jobApproved(event, id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Proceed',
                padding: '1.5em'
            }).then(function (result) {
                if (result.value) {
                    ajaxBlockUi(true);
                    $.ajax({
                        url: '{{ route('admin.ajax.jobs.approved') }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "id": id, "_token": "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            let checkSvg = ` <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-check-square">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path
                                                    d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                            </svg>`;
                            let timesSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-x-circle">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                            </svg>`;
                            if (data.data.is_approved === 1) {
                                event.classList.remove('text-success');
                                event.classList.add('text-danger');
                                event.innerHTML = timesSvg;
                            } else if (data.data.is_approved === 0) {
                                event.classList.remove('text-danger');
                                event.classList.add('text-success');
                                event.innerHTML = checkSvg;
                                console.log('test');
                            }
                            console.log(data.data);
                        },
                        complete: () => {
                            ajaxBlockUi(false)
                        }
                    });
                }
            })
        }

        function ajaxBlockUi(isBlock = true) {
            let block = $('#users');
            if (isBlock) {
                $(block).block({
                    message: '<svg> ... </svg>',
                    overlayCSS: {
                        backgroundColor: '#515365',
                        opacity: 0.9,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        color: '#fff',
                        backgroundColor: 'transparent'
                    }
                });
            } else {
                $(block).unblock();
            }
        }
    </script>
@endpush
