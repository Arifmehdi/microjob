@extends('layouts.app')
@section('title')
    {{ $job->title ?? '' }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components/cards/card.css') }}">
@endpush
@section('content')
    <div>
        <form action="{{ route('works.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job" value="{{ $job->id }}">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-body">
                                    <p>{{ __('Done') }}</p>
                                    <div class="text-left">
                                        <h5>{{ $job->countable_works_count ?? 0 }} {{ __('OF') }} {{ $job->num_of_worker ?? 0 }}</h5>
                                    </div>
                                    <div class="progress br-30">
                                        <div class="progress-bar bg-success" role="progressbar"
                                             style="width: {{ $job->completed_percentage ?? 0 }}%"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card h-100">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <h3>{{ __('You can earn: ') }} <span
                                            class="text-primary">{{ balanceFormat($job->per_worker_amount) }}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card component-card_9 w-100 mt-3">
                        <div class="card-body">
                            <h2>{{ $job->title ?? '' }}</h2>
                            <hr>
                            <div class="job-thumbnail">
                                <img src="{{ $job->image ? asset('storage/upload/'.$job->image) : '' }}" alt=""
                                     class="img-fluid">
                            </div>
                            <div class="pt-4">
                                <h6>{{ __('What is expected from workers?') }}</h6>
                                <ul class="job-steps bg-light list-unstyled p-2">
                                    @forelse($job->steps as $step)
                                        <li class="my-2"><p><span
                                                    class="font-weight-bold pr-1">{{ $loop->iteration }}.</span>{{ $step->details ?? '' }}
                                            </p></li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card component-card_9 w-100 mt-4">
                        <div class="card-body">
                            <h6>{{ __('Required proof that task was finished?') }}</h6>
                            <hr>
                            <p>{{ $job->proof_details ?? '' }}</p>
                        </div>
                    </div>
                    <div class="card component-card_9 w-100 mt-4">
                        <div class="card-body">
                            <h6>{{ __('See your work link') }}</h6>
                            <hr>
                            <a href="{{ $job->link ?? '#' }}" target="_blank">{{ $job->link ?? '' }}</a>
                        </div>
                    </div>
                    <div class="card component-card_9 w-100 mt-4">
                        <div class="card-body">
                            <h6>{{ __('Submit required work Prove') }}</h6>
                            <hr>
                            <div class="form-group">
                                <textarea name="proof_details" id="proof_details" rows="4"
                                          class="form-control @error('proof_details') is-invalid @enderror">{{ old('proof_details') }}</textarea>
                                @error('proof_details')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @for($i = 1; $i <= $job->num_of_screenshot; $i++)
                        <div class="card component-card_9 w-100 mt-4">
                            <div class="card-body">
                                <h6><span
                                        class="badge badge-dark">{{ '#'.$i }}</span>{{ __('Upload Screenshot Prove') }}
                                </h6>
                                <hr>
                                <div class="form-group">
                                    <input type="file" class="form-control @error('screenshots') is-invalid @enderror"
                                           name="screenshots[]">
                                    @error('screenshots')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    @error('screenshots.*')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endfor

                    <div class="form-group text-right mt-3">
                        @if($job->countable_works_count < $job->num_of_worker )
                            <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')

@endpush
