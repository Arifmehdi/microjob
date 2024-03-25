@extends('layouts.guest_app')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')
    <div class="form-container outer py-3 px-2 min-h-500px d-flex flex-wrap align-items-center">
        <div class="form-form">
            <div class="form-form-wrap h-auto">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Login</h1>
                        <form class="text-left" action="{{ route('login') }}" method="POST">
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

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                        <a href="{{ route('password.request') }}" class="forgot-pass-link">Forgot
                                            Password?</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Password">
                                    @error('password')
                                    <p class="text-danger mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Log In</button>
                                    </div>
                                </div>

                                <div class="division">
                                    <span>OR</span>
                                </div>

                                <p class="signup-link">Not registered ? <a href="{{ route('register') }}">Create an
                                        account</a></p>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/authentication/form-2.js') }}"></script>
@endpush
