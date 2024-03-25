@extends('layouts.app')
@section('title')
    {{ __('Balance Details') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components/cards/card.css') }}">
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row mt-5">
                <div class="col-lg-3 col-md-6">
                    <div class="card component-card_8 w-auto m-2">
                        <div class="card-body text-center">
                            <h6>{{ __('Current Balance') }}</h6>
                            <h4>{{ balanceFormat(auth()->user()->balance ?? 0) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card component-card_8 w-auto m-2">
                        <div class="card-body text-center">
                            <h6>{{ __('Total Earning') }}</h6>
                            <h4>{{ balanceFormat($total_earnings_count ?? 0) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card component-card_8 w-auto m-2">
                        <div class="card-body text-center">
                            <h6>{{ __('Total Deposit') }}</h6>
                            <h4>{{ balanceFormat($total_deposits_amount ?? 0) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card component-card_8 w-auto m-2">
                        <div class="card-body text-center">
                            <h6>{{ __('Total Withdraws') }}</h6>
                            <h4>{{ balanceFormat($total_withdraws_amount ?? 0) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
