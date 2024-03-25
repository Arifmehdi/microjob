@extends('layouts.guest_app')

@section('title')
    {{ __('Home') }}
@endsection
@push('styles')
    <link href="{{ asset('backend/assets/css/components/custom-carousel.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active m"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('backend/assets/img/slider/1.jpeg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('backend/assets/img/slider/2.jpeg') }}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('backend/assets/img/slider/3.jpeg') }}" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('backend/assets/img/slider/4.jpeg') }}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="jobs-section py-md-5 py-4 bg-2nd">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <h3 class="text-center">{{ __('Browse Jobs') }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
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
