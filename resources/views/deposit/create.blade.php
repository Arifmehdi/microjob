@extends('layouts.app')
@section('title')
    {{ __('New Deposit') }}
@endsection
@push('styles')
    <link href="{{ asset('backend/assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet"
    <link href="{{ asset('backend/assets/css/forms/custom-clipboard.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('deposits.store') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <div class="form-group">
                            <label>{{ __('Payment Method') }}</label>
                            <div class="n-chk">
                                <label class="new-control new-radio radio-classic-primary">
                                    <input type="radio" class="new-control-input" name="method" value="bkash" checked>
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
                            <div class="deposit_numbers_list">
                                <div id="method-bkash" class="deposit_number_item">
                                    <div class="input-group mb-4">
                                        <input type="text" class="form-control" value="01314306240"
                                               id="bkash-number-copy" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text clipboard-btn cursor-pointer"
                                                  id="basic-addon2" data-clipboard-action="copy"
                                                  data-clipboard-target="#bkash-number-copy">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-copy"><rect x="9" y="9" width="13"
                                                                                       height="13" rx="2" ry="2"></rect><path
                                                        d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg> {{ __('Copy') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="method-rocket" class="deposit_number_item">
                                    <div class="input-group mb-4">
                                        <input type="text" class="form-control" value="01314306240"
                                               id="rocket-number-copy" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text clipboard-btn cursor-pointer"
                                                  id="basic-addon2" data-clipboard-action="copy"
                                                  data-clipboard-target="#rocket-number-copy">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-copy"><rect x="9" y="9" width="13"
                                                                                       height="13" rx="2" ry="2"></rect><path
                                                        d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg> {{ __('Copy') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div id="method-nogod" class="deposit_number_item">
                                    <div class="input-group mb-4">
                                        <input type="text" class="form-control" value="01314306240"
                                               id="nogod-number-copy" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text clipboard-btn cursor-pointer"
                                                  id="basic-addon2" data-clipboard-action="copy"
                                                  data-clipboard-target="#nogod-number-copy">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-copy"><rect x="9" y="9" width="13"
                                                                                       height="13" rx="2" ry="2"></rect><path
                                                        d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg> {{ __('Copy') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('method')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="amount">{{ __('Amount') }} <small>(Minimum Amount Is
                                    : {{ balanceFormat(floatval(get_setting('min_deposit'))) }} BDT) </small></label>
                            <div class="input-group mb-4">
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
                            <label for="transaction_id">{{ __('Transaction ID (TxnId)') }}</label>
                            <input type="text" name="transaction_id" id="transaction_id"
                                   class="form-control @error('transaction_id') is-invalid @enderror"
                                   value="{{ old('transaction_id') }}" step="0.001">
                            @error('transaction_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('Phone Number') }}</label>
                            <input type="tel" name="phone" id="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone') }}">
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __('Deposit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/assets/js/clipboard/clipboard.min.js') }}"></script>
    <script>
        let clipboard = new Clipboard('.clipboard-btn');

        let paymentMethod = $('input[type=radio][name=method]');
        paymentMethod.on('change', function () {
            paymentGatewayNumber($(this));
        });

        function paymentGatewayNumber(paymentMethod) {
            let checkedVal = paymentMethod.val();
            $('.deposit_number_item').hide();
            $('#method-' + checkedVal).show();
        }

        paymentGatewayNumber($('input[type=radio][name=method]:checked'));
    </script>
@endpush
