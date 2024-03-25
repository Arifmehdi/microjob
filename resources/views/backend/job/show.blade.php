@extends('backend.layouts.app')
@section('title')
    {{ $job->title ?? '' }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/forms/switches.css') }}">
@endpush
@section('content')
    <div>
        <form action="{{ route('admin.jobs.update',$job->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                    <h4>{{ __('Amount of per work: ') }} <span
                                            class="text-primary">{{ balanceFormat($job->per_worker_amount) }}</span>
                                    </h4>
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
                            <h6>{{ __('Is Approved') }}</h6>
                            <hr>
                            <div class="form-group">
                                <div>
                                    <label class="switch s-dark mr-2">
                                        <input type="checkbox" name="is_approved"
                                               id="is_approved" {{ old('is_approved') ? 'checked' : ($job->is_approved ? 'checked' :'') }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                @error('is_approved')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card component-card_9 w-100 mt-4">
                        <div class="card-body">
                            <h6>{{ __('Status') }}</h6>
                            <hr>
                            <div class="form-group">
                                <div>
                                    <label class="switch s-dark mr-2">
                                        <input type="checkbox" name="status"
                                               id="status" {{ old('status') ? 'checked' : ($job->status ? 'checked' :'') }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                @error('status')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right mt-3">
                        <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
@push('scripts')

@endpush
