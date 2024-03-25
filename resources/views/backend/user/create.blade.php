@extends('backend.layouts.app')
@section('title')
    {{ __('Create User') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/forms/switches.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/dropify/dropify.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <input type="text" name="email" id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}">
                                    @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input type="text" name="password" id="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               value="{{ old('password') }}">
                                        @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="balance">{{ __('Balance') }}</label>
                                        <input type="number" name="balance" id="balance"
                                               class="form-control @error('balance') is-invalid @enderror"
                                               value="{{ old('balance') }}" step="0.001">
                                        @error('balance')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="is_admin">{{ __('Is Admin') }}</label>
                                    <div>
                                        <label class="switch s-dark mr-2">
                                            <input type="checkbox" name="is_admin"
                                                   id="is_admin" {{ old('is_admin') ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    @error('is_admin')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">{{ __('Status') }}</label>
                                    <div>
                                        <label class="switch s-dark mr-2">
                                            <input type="checkbox" name="status"
                                                   id="status" {{ old('status') ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-save">
                                            <path
                                                d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                            <polyline points="7 3 7 8 15 8"></polyline>
                                        </svg>
                                        {{ __('Create') }}</button>
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
    <script src="{{ asset('backend/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/dropify/dropify.min.js') }}"></script>
    <script>
        $('#role').select2({
            minimumResultsForSearch: Infinity
        });
        $('#image').dropify();
    </script>
@endpush
