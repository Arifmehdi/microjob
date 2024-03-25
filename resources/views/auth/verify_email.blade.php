@extends('layouts.guest_app')

@section('title')
    {{ __('Verify Email') }}
@endsection

@section('content')
    <div class="form-container outer py-3 px-2 min-h-500px d-flex flex-wrap align-items-center">
        <div class="form-form">
            <div class="form-form-wrap h-auto">
                <div class="form-container">
                    <div class="form-content">
                        <div class="alert alert-info text-left">
                            {{ __('We have sent you a email with verification link. Please check your email and verify your account. Thanks') }}
                            <br>
                            {{ __('If you will not see your email in your mail ') }}<b>{{ __('inbox') }}</b> {{ __(' then please check ') }}<b>{{ __('Spam') }}</b>  {{ __(' or ') }} <b>{{ __('Junk') }}</b>  {{ __(' folder.') }}
                        </div>
                        @if($errors->any())
                            <ul class="alert alert-danger text-left">
                                @foreach($errors->all() as $error)
                                    <li class="pl-1">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success">
                                    A new email verification link has been emailed to you!
                                </div>
                            @endif
                        <form class="text-left" action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <div class="form">
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary"
                                                value="">{{ __('Resend Verification Link') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
