@extends('backend.layouts.app')
@section('title')
    {{ __('Profile') }}
@endsection
@push('styles')

@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <form action="{{ route('admin.password.update',auth()->id()) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="current_password">{{ __('Current Password') }}</label>
                            <input type="password" name="current_password" id="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password">{{ __('New Password') }}</label>
                            <input type="password" name="new_password" id="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">{{ __('Confirm Password') }}</label>
                            <input type="password" name="confirm_password" id="confirm_password"
                                   class="form-control @error('confirm_password') is-invalid @enderror">
                            @error('confirm_password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"> {{ __('Update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
