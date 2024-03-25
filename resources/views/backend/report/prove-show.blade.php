@extends('backend.layouts.app')
@section('title')
    Report
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components/cards/card.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/magnific-popup/magnific-popup.css') }}">
    <link href="{{ asset('backend/assets/css/apps/mailing-chat.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card component-card_9 w-100">
                <div class="card-body">
                    <h6>{{ __('Report Details.') }}</h6>
                    <hr>
                    <p>{{ $report->details ?? '' }}</p>
                </div>
            </div>
            <div class="card component-card_9 w-100 mt-4">
                <div class="card-body">
                    <h6>{{ __('Proof Details.') }}</h6>
                    <hr>
                    <p>{{ $report->work?->proof_details ?? '' }}</p>
                </div>
            </div>
            <div class="card component-card_9 w-100 mt-4">
                <div class="card-body">
                    <h6>{{ __('Screenshots') }}</h6>
                    <hr>
                    <div class="screenshots-gallery row">
                        @if(is_array($report->work?->screenshots))
                            @foreach($report->work?->screenshots as $key => $screenshot)
                                <div class="col-lg-4">
                                    <a class="border m-1 d-block" target="_blank"
                                       href="{{ $screenshot ? asset('storage/upload/proves/'.$screenshot) : '' }}">
                                        <img src="{{ $screenshot ? asset('storage/upload/proves/'.$screenshot) : '' }}"
                                             alt="image-gallery" class="img-fluid">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-bordered mb-4">
                        <tbody>
                        <tr>
                            <th>{{ __('User') }}</th>
                            <td class="text-center" style="width: 15px;"> :</td>
                            <td>{{ $report->work?->user?->name ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Amount') }}</th>
                            <td class="text-center" style="width: 15px;"> :</td>
                            <td>{{ $report->work?->per_worker_amount ? balanceFormat($report->work?->per_worker_amount) : balanceFormat() }}</td>
                        </tr>
                        </tbody>
                    </table>
                    @if($report->status === 'pending')
                        <div class="row">
                            <div class="col-sm-6">
                                <form action="{{ route('admin.reports.proves.update',$report) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-danger">{{ __('Reject') }}</button>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <form action="{{ route('admin.reports.proves.update',$report) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="pending">
                                    <button type="submit" class="btn btn-warning">{{ __('Pending') }}</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('backend/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <script>
        // $('.screenshots-gallery').magnificPopup({
        //     delegate: 'a', // child items selector, by clicking on it popup will open
        //     type: 'image',
        //     gallery: {
        //         enabled: true,
        //         navigateByImgClick: true,
        //     },
        // });
    </script>
@endpush
