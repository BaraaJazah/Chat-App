@extends('layouts.app')

@section('css')
    <style>
        .--dark-theme {
            --chat-background: rgba(10, 14, 14, 0.95);
            --chat-panel-background: #131719;
            --chat-bubble-background: #14181a;
            --chat-bubble-active-background: #171a1b;
            --chat-add-button-background: #212324;
            --chat-send-button-background: #8147fc;
            --chat-text-color: #a3a3a3;
            --chat-options-svg: #a3a3a3;
        }

        body {
            background: url(https://images.unsplash.com/photo-1495808985667-ba4ce2ef31b3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80);
            background-size: cover;
        }

        #chat {
            background: var(--chat-background);
            max-width: 600px;
            margin: 25px auto;
            box-sizing: border-box;
            padding: 1em;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        #chat::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url(https://images.unsplash.com/photo-1495808985667-ba4ce2ef31b3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80) fixed;
            z-index: -1;
        }

        #chat .btn-icon {
            position: relative;
            cursor: pointer;
        }

        #chat .btn-icon svg {
            stroke: #FFF;
            fill: #FFF;
            width: 50%;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #chat .chat__conversation-board {
            padding: 1em 0 2em;
            height: calc(100vh - 55px - 2em - 25px * 2 - .5em - 3em);
            overflow: auto;
        }

        #chat .chat__conversation-board__message-container.reversed {
            flex-direction: row-reverse;
        }

        #chat .chat__conversation-board__message-container.reversed .chat__conversation-board__message__bubble {
            position: relative;
        }

        #chat .chat__conversation-board__message-container.reversed .chat__conversation-board__message__bubble span:not(:last-child) {
            margin: 0 0 2em 0;
        }

        #chat .chat__conversation-board__message-container.reversed .chat__conversation-board__message__person {
            margin: 0 0 0 1.2em;
        }

        #chat .chat__conversation-board__message-container.reversed .chat__conversation-board__message__options {
            align-self: center;
            position: absolute;
            left: 0;
            display: none;
        }

        #chat .chat__conversation-board__message-container {
            position: relative;
            display: flex;
            flex-direction: row;
        }

        #chat .chat__conversation-board__message-container:hover .chat__conversation-board__message__options {
            display: flex;
            align-items: center;
        }

        #chat .chat__conversation-board__message-container:hover .option-item:not(:last-child) {
            margin: 0 0.5em 0 0;
        }

        #chat .chat__conversation-board__message-container:not(:last-child) {
            margin: 0 0 2em 0;
        }

        #chat .chat__conversation-board__message__person {
            text-align: center;
            margin: 0 1.2em 0 0;
        }

        #chat .chat__conversation-board__message__person__avatar {
            height: 35px;
            width: 35px;
            overflow: hidden;
            border-radius: 50%;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            ms-user-select: none;
            position: relative;
        }

        #chat .chat__conversation-board__message__person__avatar::before {
            content: "";
            position: absolute;
            height: 100%;
            width: 100%;
        }

        #chat .chat__conversation-board__message__person__avatar img {
            height: 100%;
            width: auto;
        }

        #chat .chat__conversation-board__message__person__nickname {
            font-size: 9px;
            color: #484848;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            display: none;
        }

        #chat .chat__conversation-board__message__context {
            max-width: 55%;
            align-self: flex-end;
        }

        #chat .chat__conversation-board__message__options {
            align-self: center;
            position: absolute;
            right: 0;
            display: none;
        }

        #chat .chat__conversation-board__message__options .option-item {
            border: 0;
            background: 0;
            padding: 0;
            margin: 0;
            height: 16px;
            width: 16px;
            outline: none;
        }

        #chat .chat__conversation-board__message__options .emoji-button svg {
            stroke: var(--chat-options-svg);
            fill: transparent;
            width: 100%;
        }

        #chat .chat__conversation-board__message__options .more-button svg {
            stroke: var(--chat-options-svg);
            fill: transparent;
            width: 100%;
        }

        #chat .chat__conversation-board__message__bubble span {
            width: -webkit-fit-content;
            width: -moz-fit-content;
            width: fit-content;
            display: inline-table;
            word-wrap: break-word;
            background: var(--chat-bubble-background);
            font-size: 13px;
            color: var(--chat-text-color);
            padding: 0.5em 0.8em;
            line-height: 1.5;
            border-radius: 6px;
            font-family: "Lato", sans-serif;
        }

        #chat .chat__conversation-board__message__bubble:not(:last-child) {
            margin: 0 0 0.3em;
        }

        #chat .chat__conversation-board__message__bubble:active {
            background: var(--chat-bubble-active-background);
        }

        #chat .chat__conversation-panel {
            background: var(--chat-panel-background);
            border-radius: 12px;
            padding: 0 1em;
            height: 55px;
            margin: 0.5em 0 0;
        }

        #chat .chat__conversation-panel__container {
            display: flex;
            flex-direction: row;
            align-items: center;
            height: 100%;
        }

        #chat .chat__conversation-panel__container .panel-item:not(:last-child) {
            margin: 0 1em 0 0;
        }

        #chat .chat__conversation-panel__button {
            background: grey;
            height: 20px;
            width: 30px;
            border: 0;
            padding: 0;
            outline: none;
            cursor: pointer;
        }

        #chat .chat__conversation-panel .add-file-button {
            height: 23px;
            min-width: 23px;
            width: 23px;
            background: var(--chat-add-button-background);
            border-radius: 50%;
        }

        #chat .chat__conversation-panel .add-file-button svg {
            width: 70%;
            stroke: #54575c;
        }

        #chat .chat__conversation-panel .emoji-button {
            min-width: 23px;
            width: 23px;
            height: 23px;
            background: transparent;
            border-radius: 50%;
        }

        #chat .chat__conversation-panel .emoji-button svg {
            width: 100%;
            fill: transparent;
            stroke: #54575c;
        }

        #chat .chat__conversation-panel .send-message-button {
            background: var(--chat-send-button-background);
            height: 30px;
            min-width: 30px;
            border-radius: 50%;
            transition: 0.3s ease;
        }

        #chat .chat__conversation-panel .send-message-button:active {
            transform: scale(0.97);
        }

        #chat .chat__conversation-panel .send-message-button svg {
            margin: 1px -1px;
        }

        #chat .chat__conversation-panel__input {
            width: 100%;
            height: 100%;
            outline: none;
            position: relative;
            color: var(--chat-text-color);
            font-size: 13px;
            background: transparent;
            border: 0;
            font-family: "Lato", sans-serif;
            resize: none;
        }

        @media only screen and (max-width: 600px) {
            #chat {
                margin: 0;
                border-radius: 0;
            }

            #chat .chat__conversation-board {
                height: calc(100vh - 55px - 2em - .5em - 3em);
            }

            #chat .chat__conversation-board__message__options {
                display: none !important;
            }
        }
    </style>

@stop

@section('title', 'group-chat')
@section('content')
    <div style="margin-top:72px ">

        <div class="--dark-theme" id="chat">
            <div class="chat__conversation-board" id="messages">

                @foreach ($messages as $message)
                    <div
                        class="chat__conversation-board__message-container {{ $message->user_id == Auth::user()->id ? 'reversed' : '' }}">
                        <div class="chat__conversation-board__message__person">
                            <div class="chat__conversation-board__message__person__avatar">
                                <img src="{{ $message->user->image }}" alt="Dennis Mikle" />
                            </div>
                        </div>
                        <div class="chat__conversation-board__message__context">
                            <div class="chat__conversation-board__message__bubble">
                                <span
                                    style="{{ $message->user_id == Auth::user()->id ? 'text-align: right' : 'text-align: left' }} ">
                                    <span class=""
                                        style=' text-transform: capitalize ;display: inline; color:hsl({{ ($message->user_id * 57) % 360 }}, 70%, 50%) ;  '>
                                        {{ $message->user->name }}
                                    </span>
                                    <br>
                                    <span class="" style="display: inline; color:#999">
                                        {{ $message->msg }}
                                    </span>

                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="chat__conversation-panel">
                <form id="message-form" class="chat__conversation-panel__container" method="POST">
                    @csrf
                    <input name="message" id="message-input" class="chat__conversation-panel__input panel-item"
                        placeholder="Type a message..." />
                    <button class="chat__conversation-panel__button panel-item btn-icon send-message-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true" data-reactid="1036">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        let messageForm = document.getElementById('message-form')
        let messageInput = document.getElementById('message-input')
        let chatBox = document.getElementById('messages');
        // make submit without refresh page

        messageForm.addEventListener('submit', function(e) {
            e.preventDefault()
            const message = messageInput.value;
            if (message) {
                fetch(`/group`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message
                    })
                });
            }
            messageInput.value = '';

        })

        // listen to the event
        window.addEventListener("DOMContentLoaded", function() { // check if page loaded
            window.currentUserId = {{ Auth::id() }}; // get current user id

            window.Echo.channel('public-chat-room') // listen to the room channel
                .listen('MessageSent', (e) => {
                    console.log(e);

                    let message = `
                    <div class="chat__conversation-board__message-container
                    ${e.message.user_id != currentUserId ? '' : 'reversed'}
                    ">
                        <div class="chat__conversation-board__message__person">
                            <div class="chat__conversation-board__message__person__avatar"><img
                                    src="${e.message.user.image}" alt="Monika Figi" /></div>
                            <span class="chat__conversation-board__message__person__nickname">Monika Figi</span>
                        </div>
                         <div class="chat__conversation-board__message__context">
                            <div class="chat__conversation-board__message__bubble">
                               <span
                                    style="${e.message.user_id == currentUserId ? 'text-align: right' : 'text-align: left' } ">
                                    <span class=""
                                        style="text-transform: capitalize ;display: inline; color:hsl(${(e.message.user_id * 57) % 360} , 70%, 50%);">
                                        ${e.message.user.name}
                                    </span>
                                    <br>
                                    <span class="" style="display: inline; color:#999">
                                            ${e.message.msg}
                                    </span>

                                </span>
                        </div>
                        </div>

                    </div>
                `;

                    document.getElementById('messages').innerHTML += message;
                    chatBox.scrollTop = chatBox.scrollHeight;


                });
        });

        messageInput.value = '';
    </script>

@stop
