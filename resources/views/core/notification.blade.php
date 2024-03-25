@extends('layouts.app')
@section('title')
    {{ __('Notifications') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components/custom-list-group.css') }}">
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card w-auto">
                <div class="card-body">
                    <ul class="list-group list-group-icons-meta">
                        @foreach($notifications as $notification)
                            <li class="list-group-item list-group-item-action">
                                <div class="media" style="max-width: 500px">
                                    <div class="d-flex mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-bell">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg>
                                    </div>
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="tx-inverse">{{ $notification->title ?? '' }}</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <span
                                                    class="text-muted">
                                                    &bigodot;
                                                    {{ $notification->created_at ? $notification->created_at->format('Y-m-d h:i:s') : '' }}</span>
                                            </div>
                                        </div>
                                        <p class="mg-b-0 font-">{{ $notification->details ?? '' }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
