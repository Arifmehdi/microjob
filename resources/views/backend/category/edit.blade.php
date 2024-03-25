@extends('backend.layouts.app')
@section('title')
    {{ __('Edit Staff Member') }}
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
                    <form action="{{ route('admin.categories.update',$category->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') ?? $category->name ?? '' }}">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_cost_per_work">{{ __('Minimum Cost Per Work') }}</label>
                                    <input type="number" name="min_cost_per_work" id="min_cost_per_work"
                                           class="form-control @error('min_cost_per_work') is-invalid @enderror"
                                           value="{{ old('min_cost_per_work') ?? $category->min_cost_per_work ?? 0.00 }}"
                                           step="0.001">
                                    @error('min_cost_per_work')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="parent_id">{{ __('Parent') }}</label>
                                    <select name="parent_id" id="parent_id">
                                        <option></option>
                                        @foreach($categories as $parent)
                                            <option
                                                value="{{ $parent->id }}" {{ $parent->id == $category->parent_id ? 'selected' : '' }}>{{ $parent->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="description">{{ __('Description') }}</label>
                                        <textarea name="description" id="description" rows="4"
                                                  class="form-control @error('description') is-invalid @enderror">{{ old('description') ?? $category->description ?? '' }}</textarea>
                                        @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="image">{{ __('Thumbnail Image') }}</label>
                                    <input type="file" name="image" id="image"
                                           @if($category->image) data-default-file="{{ asset('storage/upload/'.$category->image) }}" @endif>
                                    @error('image')
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
                                                   id="status" {{ old('status') ? 'checked' : ($category->status ? 'checked' :'') }}>
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
                                        {{ __('Update') }}</button>
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
        $('#parent_id').select2({
            placeholder: "Select Parent",
            allowClear: true
        });
        $('#image').dropify();
    </script>
@endpush
