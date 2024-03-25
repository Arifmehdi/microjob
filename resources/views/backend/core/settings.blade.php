@extends('backend.layouts.app')
@section('title')
    Settings
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/dropify/dropify.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Settings</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="site_title">{{ __('Site Title') }}</label>
                            <input type="text" name="site_title" id="site_title"
                                   class="form-control @error('site_title') is-invalid @enderror"
                                   value="{{ get_setting('site_title') }}">
                            @error('site_title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="site_tagline">{{ __('Site Tagline') }}</label>
                            <input type="text" name="site_tagline" id="site_tagline"
                                   class="form-control @error('site_tagline') is-invalid @enderror"
                                   value="{{ get_setting('site_tagline') }}">
                            @error('site_tagline')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="min_deposit">{{ __('Minimum Deposits') }}</label>
                            <input type="number" name="min_deposit" id="min_deposit"
                                   class="form-control @error('min_deposit') is-invalid @enderror"
                                   value="{{ get_setting('min_deposit') }}" step="0.001">
                            @error('min_deposit')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="min_withdraw">{{ __('Minimum Withdraws') }}</label>
                            <input type="number" name="min_withdraw" id="min_withdraw"
                                   class="form-control @error('min_withdraw') is-invalid @enderror"
                                   value="{{ get_setting('min_withdraw') }}" step="0.001">
                            @error('min_withdraw')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="screenshot_amount">{{ __('Per Screenshot') }}</label>
                            <input type="number" name="screenshot_amount" id="screenshot_amount"
                                   class="form-control @error('screenshot_amount') is-invalid @enderror"
                                   value="{{ get_setting('screenshot_amount') }}" step="0.001">
                            @error('screenshot_amount')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-4 col-md-7 col-sm12">
                                <div class="form-group">
                                    <label for="site_logo">{{ __('Site logo') }}</label>
                                    <input type="file" name="site_logo" id="site_logo"
                                           @if(get_setting('site_logo')) data-default-file="{{ asset('storage/upload/'.get_setting('site_logo')) }}" @endif>
                                    @error('site_logo')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-4 col-md-7 col-sm12">
                                <div class="form-group">
                                    <label for="fav_icon">{{ __('Fav Ico') }}</label>
                                    <input type="file" name="fav_icon" id="fav_icon"
                                           @if(get_setting('fav_icon')) data-default-file="{{ asset('storage/upload/'.get_setting('fav_icon')) }}" @endif>
                                    @error('fav_icon')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/dropify/dropify.min.js') }}"></script>
    <script>
        $('#site_logo').dropify();
        $('#fav_icon').dropify();
    </script>
@endpush
