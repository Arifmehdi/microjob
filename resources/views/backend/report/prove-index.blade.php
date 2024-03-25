@extends('backend.layouts.app')
@section('title')
    Prove Reports
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/dt-global_style.css') }}">
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
                            <h5>{{ __('Proves') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="job-proves-table" class="table dt-table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Proof</th>
                            <th>Prove Status</th>
                            <th>Report Status</th>
                            <th>Reported AT</th>
                            <th class="no-content">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td>{{ '#'.$report->id ?? '' }}</td>
                                <td>{{ str()->limit($report->work?->proof_details,40) ?? '' }}</td>
                                <td>
                                    @if($report->work?->status === 'pending')
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                    @elseif($report->work?->status === 'rejected')
                                        <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                    @elseif( $report->work?->status === 'completed')
                                        <span class="badge badge-success">{{ __('Approved') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(is_null($report->status) || $report->status === 'pending')
                                        <span class="badge badge-warning">{{ __('Not Reviewed') }}</span>
                                    @elseif($report->status === 'completed')
                                        <span class="badge badge-success">{{ __('Reviewed') }}</span>
                                    @endif
                                </td>
                                <td>{{ $report->created_at ? $report->created_at->format('d-m-Y h:i a') : '' }}</td>
                                <td>
                                    <a href="{{ route('admin.reports.proves.show',$report->id) }}"
                                       class="btn btn-success btn-sm">
                                        {{ __('Details') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Report ID</th>
                            <th>Proof</th>
                            <th>Prove Status</th>
                            <th>Report Status</th>
                            <th>Reported AT</th>
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
        $('#job-proves-table').DataTable({
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
            "ordering": false
        });
    </script>
@endpush
