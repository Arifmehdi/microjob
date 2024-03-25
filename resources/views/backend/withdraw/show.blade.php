@extends('backend.layouts.app')
@section('title')
    {{ __('Withdraw') }} #{{ $withdraw->id ?? '' }}
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
                                <td>{{ $withdraw->user ? $withdraw->user->name ?? '' : '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Withdraw Method') }}</th>
                                <td class="text-center" style="width: 15px;"> :</td>
                                <td>{{ $withdraw->method ? ucfirst($withdraw->method) : '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Amount') }}</th>
                                <td class="text-center" style="width: 15px;"> :</td>
                                <td>{{ $withdraw->amount ? balanceFormat($withdraw->amount) : balanceFormat() }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Account Number') }}</th>
                                <td class="text-center" style="width: 15px;"> :</td>
                                <td>{{ $withdraw->account_number ?? '' }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Status') }}</th>
                                <td class="text-center" style="width: 15px;"> :</td>
                                <td>
                                    @if($withdraw->status)
                                        <span class="text-success">Approved</span>
                                    @elseif(is_null($withdraw->status))
                                        <span class="text-warning">Pending</span>
                                    @else
                                        <span class="text-danger">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                            @if(is_null($withdraw->status))
                                <tr>
                                    <th>{{ __('Action') }}</th>
                                    <td class="text-center" style="width: 15px;"> :</td>
                                    <td>
                                        <button class="btn btn-success"
                                                onclick="event.preventDefault(); withdrawApprove({{ $withdraw->id }},'approved')">{{ __('Approve') }}</button>
                                        <form action="{{ route('admin.withdraws.update',$withdraw->id) }}"
                                              method="post" id="withdraw-approved-{{ $withdraw->id }}" class="d-none">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="completed">
                                        </form>
                                        <button class="btn btn-danger"
                                                onclick="event.preventDefault(); withdrawApprove({{ $withdraw->id }},'rejected')">{{ __('Reject') }}</button>
                                        <form action="{{ route('admin.withdraws.update',$withdraw->id) }}"
                                              method="post" id="withdraw-rejected-{{ $withdraw->id }}" class="d-none">
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
        function withdrawApprove(id, status) {
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
                    $('#withdraw-' + status + '-' + id).submit();
                }
            })
        }
    </script>
@endpush
