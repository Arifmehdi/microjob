@extends('backend.layouts.app')
@section('title')
    {{ __('Dashboard') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components/cards/card.css') }}">
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row">
                <div class="col-md-4">
                    <div class="card component-card_8 w-auto m-2">
                        <div class="card-body text-center">
                            <h6>{{ __('Total Pending Job') }}</h6>
                            <h4>{{ $pending_jobs_count ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card component-card_8 w-auto m-2">
                        <div class="card-body text-center">
                            <h6>{{ __('Total Pending Deposits') }}</h6>
                            <h4>{{ $pending_deposits_count ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card component-card_8 w-auto m-2">
                        <div class="card-body text-center">
                            <h6>{{ __('Total Pending Withdraws') }}</h6>
                            <h4>{{ $pending_withdraws_count ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-3 col-md-6">
                    <div class="card component-card_8 w-auto m-2">
                        <div class="card-body text-center">
                            <h6>{{ __('Total Jobs') }}</h6>
                            <h4>{{ $total_jobs_count ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card component-card_8 w-auto m-2">
                        <div class="card-body text-center">
                            <h6>{{ __('Total Deposits') }}</h6>
                            <h4>{{ $total_deposits_amount ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card component-card_8 w-auto m-2">
                        <div class="card-body text-center">
                            <h6>{{ __('Total Withdraws') }}</h6>
                            <h4>{{ $total_withdraws_amount ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card component-card_8 w-auto m-2">
                        <div class="card-body text-center">
                            <h6>{{ __('Total Users') }}</h6>
                            <h4>{{ $total_users_count ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
