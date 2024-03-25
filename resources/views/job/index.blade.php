@extends('layouts.app')
@section('title')
    {{ __('Jobs') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/components/custom-modal.css') }}">
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="jobs-filter mb-4">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#categoryModal">
                                        {{ request()->filled('category') ? $categories->where('slug',request()->query('category'))->first()->name ?? '' : 'Select Category' }}
                                    </button>
                                    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog"
                                         aria-labelledby="categoryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="categoryModalLabel">Select
                                                        Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @foreach($categories as $category)
                                                        <label class="category-filter-btn">
                                                            <input type="radio" name="category"
                                                                   value="{{$category->slug}}" {{ (request()->filled('category') && $category->slug == request()->query('category')) ? 'checked' : '' }}>
                                                            <span class="text">{{ $category->name ?? '' }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{ __('Filter') }}</button>
                                                    <a href="{{ route('jobs') }}"
                                                       class="btn btn-dark">{{ __('Clear') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="jobs-list">
                        @forelse($jobs as $job)
                            @if($job->countable_works_count < $job->num_of_worker )
                                <div class="job-list-item px-2">
                                    <a href="{{ route('jobs.show',$job->id) }}">
                                        <div class="row align-items-center py-2 py-md-4">
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <h5 class="job-title">{{ $job->title ?? '' }}</h5>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-7">
                                                <div class="text-center">
                                                    <span
                                                        class="job-progress-text">{{ $job->countable_works_count ?? 0 }} {{ __('OF') }} {{ $job->num_of_worker ?? 0 }}</span>
                                                </div>
                                                <div class="progress progress-sm br-30 mx-lg-3 mx-0 my-0">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         style="width: {{ $job->completed_percentage ?? 0 }}%"
                                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-5">
                                                <h5 class="text-lg-right text-center job-price my-0">{{ $job->per_worker_amount ? balanceFormat($job->per_worker_amount) : 'Free' }}</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @empty
                            <div class="row justify-content-center">
                                <div class="col-lg-8 col-md-10">
                                    <div class="alert alert-danger text-center">
                                        {{ __('Sorry, No Job found') }}
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')

@endpush
