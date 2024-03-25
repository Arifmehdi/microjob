@extends('layouts.app')
@section('title')
    {{ __('Prove').' #'.$prove->id ?? '' }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components/cards/card.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/magnific-popup/magnific-popup.css') }}">
    <link href="{{ asset('backend/assets/css/apps/mailing-chat.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card component-card_9 w-100 mt-4">
                <div class="card-body">
                    <h6>{{ __('Proof Details.') }}</h6>
                    <hr>
                    <p>{{ $prove->proof_details ?? '' }}</p>
                </div>
            </div>
            <div class="card component-card_9 w-100 mt-4">
                <div class="card-body">
                    <h6>{{ __('Screenshots') }}</h6>
                    <hr>
                    <div class="screenshots-gallery row">
                        @if(is_array($prove->screenshots))
                            @foreach($prove->screenshots as $key => $screenshot)
                                <div class="col-lg-4">
                                    <a class="border m-1 d-block" target="_blank"
                                       href="{{ $screenshot ? asset('storage/upload/proves/'.$screenshot) : '' }}">
                                        <img src="{{ $screenshot ? asset('storage/upload/proves/'.$screenshot) : '' }}"
                                             alt="image-gallery" class="img-fluid">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-bordered mb-4">
                        <tbody>
                        <tr>
                            <th>{{ __('User') }}</th>
                            <td class="text-center" style="width: 15px;"> :</td>
                            <td>{{ $prove->user ? $prove->user->name : '' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Amount') }}</th>
                            <td class="text-center" style="width: 15px;"> :</td>
                            <td>{{ $prove->per_worker_amount ? balanceFormat($prove->per_worker_amount) : balanceFormat() }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Status') }}</th>
                            <td class="text-center" style="width: 15px;"> :</td>
                            <td>
                                @if($prove->report)
                                    <span class="badge badge-danger">{{ __('Reported') }}</span>
                                @elseif($prove->status === 'pending')
                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                @elseif($prove->status === 'rejected')
                                    <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                @elseif( $prove->status === 'completed')
                                    <span class="badge badge-success">{{ __('Approved') }}</span>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    @if($prove->status === 'pending' && !$prove->report)
                        <div class="row">
                            <div class="col-6">
                                <form action="{{ route('my-jobs.proves.update',[$job->id,$prove->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">{{ __('Approve') }}</button>
                                </form>
                            </div>
                            @if($job->is_reportable)
                                <div class="col-6">
                                    <button type="button" data-toggle="modal"
                                            data-target="#report-modal-{{ $prove->id }}"
                                            class="btn btn-danger">{{ __('Report') }}</button>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="chat-system">
                        <div class="chat-box" style="height: calc(600px - 179px)">
                            <div class="chat-box-inner" style="height: 100%">
                                <div class="chat-conversation-box  ps ps--active-y">
                                    <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
                                        <div class="chat active-chat">
                                            @forelse($prove->notes as $note)
                                                <div class="bubble {{ $note->user_id == auth()->id() ? 'me' : 'you' }}">
                                                    {{ $note->text ?? '' }}
                                                </div>
                                            @empty
                                                <div class="conversation-start">
                                                    <span>{{ __('No Chat Founds!') }}</span>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-footer chat-active">
                                    <div class="chat-input">
                                        <form class="chat-form" action="{{ route('proves.notes.store') }}"
                                              method="POST">
                                            @csrf
                                            <input type="hidden" name="prove_id" value="{{ $prove->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-message-square">
                                                <path
                                                    d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                            </svg>
                                            <input type="text" class="mail-write-box form-control"
                                                   placeholder="Message" name="message" id="message" required/>
                                            <button class="btn btn-primary w-100 mt-2 m-1">{{ __('Send') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Report Modal --}}
    @if($job->is_reportable)
        <div class="modal fade" id="report-modal-{{ $prove->id }}" tabindex="-1" role="dialog"
             aria-labelledby="reportModal"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('reports.proves.store',$prove->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="reportModal">{{ __('Report') }}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="details">{{ __('Details') }}</label>
                                <textarea name="details" id="details" rows="4" class="form-control"
                                          placeholder="Describe here..." required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script src="{{ asset('backend/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        const ps = new PerfectScrollbar('.chat-conversation-box', {
            suppressScrollX: true
        });

        const getScrollContainer = document.querySelector('.chat-conversation-box');
        getScrollContainer.scrollTop = getScrollContainer.scrollHeight;

    </script>
    <script>
        // $('.screenshots-gallery').magnificPopup({
        //     delegate: 'a', // child items selector, by clicking on it popup will open
        //     type: 'image',
        //     gallery: {
        //         enabled: true,
        //         navigateByImgClick: true,
        //     },
        // });
    </script>
@endpush
