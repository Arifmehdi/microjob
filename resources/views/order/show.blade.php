@extends('backend.layouts.app')
@section('title')
    {{ $job->title ?? '' }}
@endsection
@push('styles')
    <link href="{{ asset('backend/assets/css/apps/mailing-chat.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-8"></div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const ps = new PerfectScrollbar('.chat-conversation-box', {
            suppressScrollX: true
        });

        const getScrollContainer = document.querySelector('.chat-conversation-box');
        getScrollContainer.scrollTop = 0;

        $('.mail-write-box').on('keydown', function (event) {
            if (event.key === 'Enter') {
                var chatInput = $(this);
                var chatMessageValue = chatInput.val();
                if (chatMessageValue === '') {
                    return;
                }
                $messageHtml = '<div class="bubble me">' + chatMessageValue + '</div>';
                var appendMessage = $(this).parents('.chat-system').find('.active-chat').append($messageHtml);
                const getScrollContainer = document.querySelector('.chat-conversation-box');
                getScrollContainer.scrollTop = getScrollContainer.scrollHeight;
                var clearChatInput = chatInput.val('');
            }
        })

    </script>
@endpush
