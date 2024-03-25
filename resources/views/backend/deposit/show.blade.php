@extends('backend.layouts.app')
@section('title')
    {{ __('Deposit') }} #{{ $deposit->id ?? '' }}
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/sweetalerts/sweetalert.css') }}">
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <tbody>
                            <tr>
                                <th>{{ __('User') }}</th>
                                <td class="text-center" style="width: 15px;"> :</td>
                                <td>{{ $deposit->user ? $deposit->user->name ?? '' : '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Payment Method') }}</th>
                                <td class="text-center" style="width: 15px;"> :</td>
                                <td>{{ $deposit->method ? ucfirst($deposit->method) : '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Amount') }}</th>
                                <td class="text-center" style="width: 15px;"> :</td>
                                <td>{{ $deposit->amount ? balanceFormat($deposit->amount) : balanceFormat() }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Phone') }}</th>
                                <td class="text-center" style="width: 15px;"> :</td>
                                <td>{{ $deposit->phone ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Transaction ID') }}</th>
                                <td class="text-center" style="width: 15px;"> :</td>
                                <td>{{ $deposit->transaction_id ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Status') }}</th>
                                <td class="text-center" style="width: 15px;"> :</td>
                                <td>
                                    @if($deposit->status)
                                        <span class="text-success">Approved</span>
                                    @elseif(is_null($deposit->status))
                                        <span class="text-warning">Pending</span>
                                    @else
                                        <span class="text-danger">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                            @if(is_null($deposit->status))
                                <tr>
                                    <th>{{ __('Action') }}</th>
                                    <td class="text-center" style="width: 15px;"> :</td>
                                    <td>
                                        <button class="btn btn-success"
                                                onclick="event.preventDefault(); depositApprove({{ $deposit->id }},'approved')">{{ __('Approve') }}</button>
                                        <form action="{{ route('admin.deposits.update',$deposit->id) }}"
                                              method="post" id="deposit-approved-{{ $deposit->id }}" class="d-none">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="completed">
                                        </form>
                                        <button class="btn btn-danger"
                                                onclick="event.preventDefault(); depositApprove({{ $deposit->id }},'rejected')">{{ __('Reject') }}</button>
                                        <form action="{{ route('admin.deposits.update',$deposit->id) }}"
                                              method="post" id="deposit-rejected-{{ $deposit->id }}" class="d-none">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/plugins/sweetalerts/sweetalert2.min.js') }}"></script>
    <script>
        function depositApprove(id, status) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                padding: '1.5em',
                confirmButtonClass: 'btn-success',
            }).then(function (result) {
                if (result.value) {
                    $('#deposit-' + status + '-' + id).submit();
                }
            })
        }
    </script>
@endpush
