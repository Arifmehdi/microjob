sm-@extends('layouts.app')
@section('title')
    {{ __('Withdraws') }}
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/sweetalerts/sweetalert.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>{{ __('Withdraws') }}</h5>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <a href="{{ route('withdraws.create') }}"
                               class="btn btn-primary">{{ __('New Withdraw') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="withdraws" class="table dt-table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Method</th>
                            <th>Amount</th>
                            <th>Account Number</th>
                            <th>Status</th>
                            <th>Created AT</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($withdraws as $withdraw)
                            <tr>
                                <td>{{ $withdraw->id ?? '' }}</td>
                                <td>{{ $withdraw->method ?? '' }}</td>
                                <td>{{ $withdraw->amount ? balanceFormat($withdraw->amount): balanceFormat() }}</td>
                                <td>{{ $withdraw->account_number ?? '' }}</td>
                                <td>
                                    @if($withdraw->status)
                                        <span class="badge badge-success">Approved</span>
                                    @elseif(is_null($withdraw->status))
                                        <span class="badge badge-warning">Pending</span>
                                    @else
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $withdraw->created_at ? $withdraw->created_at->format('d-m-Y h:i a') : '' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#ID</th>
                            <th>Method</th>
                            <th>Amount</th>
                            <th>Account Number</th>
                            <th>Status</th>
                            <th>Created AT</th>
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
    <script>
        $('#withdraws').DataTable({
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
                {'searchable': false}
            ]
        });

    </script>
@endpush
