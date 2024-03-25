@extends('layouts.app')
@section('title')
    {{ __('New Withdraw') }}
@endsection
@push('styles')
    <link href="{{ asset('backend/assets/css/components/tabs-accordian/custom-accordions.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('backend/assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('withdraws.store') }}" method="POST">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>{{ __('Payment Method') }}</label>
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-classic-primary">
                                            <input type="radio" class="new-control-input" name="method" value="bkash">
                                            <span class="new-control-indicator"></span>bKash
                                        </label>
                                        <label class="new-control new-radio radio-classic-primary">
                                            <input type="radio" class="new-control-input" name="method" value="nogod">
                                            <span class="new-control-indicator"></span>Nogod
                                        </label>
                                        <label class="new-control new-radio radio-classic-primary">
                                            <input type="radio" class="new-control-input" name="method" value="rocket">
                                            <span class="new-control-indicator"></span>Rocket
                                        </label>
                                    </div>
                                    @error('method')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="amount">{{ __('Amount') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">৳</span>
                                        </div>
                                        <input type="number" class="form-control" name="amount" id="amount"
                                               value="{{ old('amount') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">BDT</span>
                                        </div>
                                    </div>
                                    @error('amount')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="account_number">{{ __('Account Number') }}</label>
                                    <input type="text" name="account_number" id="account_number"
                                           class="form-control @error('account_number') is-invalid @enderror"
                                           value="{{ old('account_number') }}">
                                    @error('account_number')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Withdraw') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/assets/js/components/ui-accordions.js') }}"></script>
@endpush
