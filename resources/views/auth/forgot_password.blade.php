@extends('layouts.guest_app')

@section('title')
    {{ __('Forgot Password') }}
@endsection

@section('content')
    <div class="form-container outer py-3 px-2 min-h-500px d-flex flex-wrap align-items-center">
        <div class="form-form">
            <div class="form-form-wrap h-auto">
                <div class="form-container">
                    <div class="form-content">
                        @if($errors->any())
                            <ul class="alert alert-danger text-left">
                                @foreach($errors->all() as $error)
                                    <li class="pl-1">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="text-left" action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="email">{{ __('Email') }}</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-at-sign">
                                        <circle cx="12" cy="12" r="4"></circle>
                                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                                    </svg>
                                    <input id="email" name="email" type="text"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Email">
                                    @error('email')
                                    <p class="text-danger mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary"
                                                value="">{{ __('Request Reset Link') }}</button>
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
