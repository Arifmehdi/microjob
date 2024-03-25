@extends('backend.layouts.app')
@section('title')
    {{ __('Profile') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/dropify/dropify.min.css') }}">
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <form action="{{ route('admin.profile.update',auth()->id()) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ auth()->user()->name ?? '' }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="text" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ auth()->user()->email ?? '' }}">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">{{ __('Profile Image') }}</label>
                            <input type="file" name="image" id="image"
                                   @if(auth()->user()->image) data-default-file="{{ asset('storage/upload/'.auth()->user()->image) }}" @endif>
                            @error('image')
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
    <script src="{{ asset('backend/plugins/dropify/dropify.min.js') }}"></script>
    <script>
        $('#image').dropify();
    </script>
@endpush
