@extends('layouts.app')

@section('css')
    <style>
        body {
            background-color: #F5F5F5;
        }

        .container {
            padding: 0;
            background-color: #FFF;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
            height: 700px;
            margin: 8% 4%;
        }

        /* ===== MENU ===== */
        .menu {
            float: left;
            height: 700px;
            ;
            width: 70px;
            background: #4768b5;
            background: -webkit-linear-gradient(#4768b5, #35488e);
            background: -o-linear-gradient(#4768b5, #35488e);
            background: -moz-linear-gradient(#4768b5, #35488e);
            background: linear-gradient(#4768b5, #35488e);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19);
        }

        .menu .items {
            list-style: none;
            margin: auto;
            padding: 0;
        }

        .menu .items .item {
            height: 70px;
            border-bottom: 1px solid #6780cc;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #9fb5ef;
            font-size: 17pt;
        }

        .menu .items .item-active {
            background-color: #5172c3;
            color: #FFF;
        }

        .menu .items .item:hover {
            cursor: pointer;
            background-color: #4f6ebd;
            color: #cfe5ff;
        }

        /* === CONVERSATIONS === */

        .discussions {
            width: 40%;
            height: 700px;
            box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.20);
            overflow: hidden;
            background-color: #87a3ec;
            display: inline-block;
        }

        .discussions .discussion {
            width: 100%;
            height: 90px;
            background-color: #FAFAFA;
            border-bottom: solid 1px #E0E0E0;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .discussions .search {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #E0E0E0;
        }

        .discussions .search .searchbar {
            height: 40px;
            background-color: #FFF;
            width: 70%;
            padding: 0 20px;
            border-radius: 50px;
            border: 1px solid #EEEEEE;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .discussions .search .searchbar input {
            margin-left: 15px;
            height: 38px;
            width: 100%;
            border: none;
            font-family: 'Montserrat', sans-serif;
            ;
        }

        .discussions .search .searchbar *::-webkit-input-placeholder {
            color: #E0E0E0;
        }

        .discussions .search .searchbar input *:-moz-placeholder {
            color: #E0E0E0;
        }

        .discussions .search .searchbar input *::-moz-placeholder {
            color: #E0E0E0;
        }

        .discussions .search .searchbar input *:-ms-input-placeholder {
            color: #E0E0E0;
        }

        .discussions .message-active {
            width: 98.5%;
            height: 90px;
            background-color: #FFF;
            border-bottom: solid 1px #E0E0E0;
        }

        .discussions .discussion .photo {
            margin-left: 20px;
            display: block;
            width: 45px;
            height: 45px;
            background: #E6E7ED;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .online {
            position: relative;
            top: 30px;
            left: 35px;
            width: 13px;
            height: 13px;
            background-color: #8BC34A;
            border-radius: 13px;
            border: 3px solid #FAFAFA;
        }

        .desc-contact {
            height: 43px;
            width: 50%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .discussions .discussion .name {
            margin: 0 0 0 20px;
            font-family: 'Montserrat', sans-serif;
            font-size: 11pt;
            color: #515151;
        }

        .discussions .discussion .message {
            margin: 6px 0 0 20px;
            font-family: 'Montserrat', sans-serif;
            font-size: 9pt;
            color: #515151;
        }

        .timer {
            margin-left: 15%;
            font-family: 'Open Sans', sans-serif;
            font-size: 11px;
            padding: 3px 8px;
            color: #BBB;
            background-color: #FFF;
            border: 1px solid #E5E5E5;
            border-radius: 15px;
        }

        .chat {
            width: calc(65% - 85px);
        }

        .header-chat {
            background-color: #FFF;
            height: 90px;
            box-shadow: 0px 3px 2px rgba(0, 0, 0, 0.100);
            display: flex;
            align-items: center;
        }

        .chat .header-chat .icon {
            margin-left: 30px;
            color: #515151;
            font-size: 14pt;
        }

        .chat .header-chat .name {
            margin: 0 0 0 20px;
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-size: 13pt;
            color: #515151;
        }

        .chat .header-chat .right {
            position: absolute;
            right: 40px;
        }

        .chat .messages-chat {
            padding: 25px 35px;
        }

        .chat .messages-chat .message {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .chat .messages-chat .message .photo {
            display: block;
            width: 45px;
            height: 45px;
            background: #E6E7ED;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .chat .messages-chat .text {
            margin: 0 35px;
            background-color: #f6f6f6;
            padding: 15px;
            border-radius: 12px;
        }

        .text-only {
            margin-left: 45px;
        }

        .time {
            font-size: 10px;
            color: lightgrey;
            margin-bottom: 10px;
            margin-left: 85px;
        }

        .response-time {
            float: right;
            margin-right: 40px !important;
        }

        .response {
            float: right;
            margin-right: 0px !important;
            margin-left: auto;
            /* flexbox alignment rule */
        }

        .response .text {
            background-color: #e3effd !important;
        }

        .footer-chat {
            width: calc(65% - 66px);
            height: 80px;
            display: flex;
            align-items: center;
            position: absolute;
            bottom: 0;
            background-color: transparent;
            border-top: 2px solid #EEE;

        }

        .chat .footer-chat .icon {
            margin-left: 30px;
            color: #C0C0C0;
            font-size: 14pt;
        }

        .chat .footer-chat .send {
            color: #fff;
            background-color: #4f6ebd;
            position: absolute;
            right: 50px;
            padding: 12px 12px 12px 12px;
            border-radius: 50px;
            font-size: 14pt;
        }

        .chat .footer-chat .name {
            margin: 0 0 0 20px;
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-size: 13pt;
            color: #515151;
        }

        .chat .footer-chat .right {
            position: absolute;
            right: 40px;
        }

        .write-message {
            border: none !important;
            width: 60%;
            height: 50px;
            margin-left: 20px;
            padding: 10px;
        }

        .footer-chat *::-webkit-input-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
        }

        .footer-chat input *:-moz-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
        }

        .footer-chat input *::-moz-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
            margin-left: 5px;
        }

        .footer-chat input *:-ms-input-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
        }

        .clickable {
            cursor: pointer;
        }
    </style>

    <style>
        .write-message {
            border: none;
            outline: none;
            color: #999
        }

        .write-message:: {
            border: 1px solid red
        }

        .message-active {
            background-color: rgba(0, 0, 0, 0.10) !important;
            width: 100% !important;
        }



        /* HTML: <div class="loader"></div> */
        .loader {
            width: 60px;
            aspect-ratio: 4;
            --_g: no-repeat radial-gradient(circle closest-side, #999 90%, #0000);
            background:
                var(--_g) 0% 50%,
                var(--_g) 50% 50%,
                var(--_g) 100% 50%;
            background-size: calc(100%/3) 100%;
            animation: l7 1s infinite linear;
        }

        @keyframes l7 {
            33% {
                background-size: calc(100%/3) 0%, calc(100%/3) 100%, calc(100%/3) 100%
            }

            50% {
                background-size: calc(100%/3) 100%, calc(100%/3) 0%, calc(100%/3) 100%
            }

            66% {
                background-size: calc(100%/3) 100%, calc(100%/3) 100%, calc(100%/3) 0%
            }
        }
    </style>

@stop

@section('title', 'chat')
@section('content')
    <div class="container">
        <div class="row" style=" display: flex ;flex-direction: row">
            <section class="discussions" style="  background-color:#fff">
                <div class="discussion search">

                </div>
                @foreach ($users as $user)
                    <a href="{{ route('chat.show', $user->id) }}"
                        class="discussion message {{ $user->id == $receiver->id ? 'message-active' : '' }}">
                        <div class="photo" style="background-image: url({{ $user->image }})">
                            @if ($user->isOnline())
                                <div class="online"></div>
                            @endif
                        </div>
                        <div class="desc-contact">
                            <p class="name">{{ $user->name }}</p>
                        </div>
                    </a>
                @endforeach


            </section>
            <section class="chat" style="position: relative;width: 100%">
                <div class="header-chat">
                    <i class="icon fa fa-user-o" aria-hidden="true"></i>
                    <p class="name">{{ $receiver->name }}</p>
                    <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
                </div>
                <div id="messages-chat" class="messages-chat" style="overflow-y: auto; max-height: 500px;">
                    @php
                        $senderId = 0;
                        $receiverId = 0;
                    @endphp
                    @foreach ($chats as $chat)
                        @if ($chat->sender_id != Auth::id())
                            <div class="message">
                                <p class="text"> {{ $chat->message }}</p>
                            </div>
                        @else
                            <div class="message text-only">
                                <div class="response">
                                    <p class="text"> {{ $chat->message }}</p>
                                </div>
                            </div>
                        @endif

                        @php
                            $senderId = $chat->sender_id;
                            $receiverId = $chat->receiver_id;
                        @endphp
                    @endforeach

                </div>

                <div id="isWrite" class="message" style="padding-left:75px;display:none ;">
                    <div class="loader"></div>
                </div>

                <div class="footer-chat" style="width: 100%; padding:0 20px;">
                    <img src="{{ asset('build/assets/image/smile.png') }}" style="width:35px;height: 35px;" />
                    <form id="message-form" class="chat__conversation-panel__container" method="POST"
                        style="width:100%;display: flex;flex-direction: row;justify-content: space-between;align-items: center">
                        @csrf
                        <input id='message' name="message" style="margin:0 20px" type="text" class="write-message"
                            placeholder="Type your message here"></input>
                        <button type="submit">
                            <img src="{{ asset('build/assets/image/send.png') }}" style="width:35px;height: 35px;" />
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection


@section('js')

    <script>
        window.addEventListener("DOMContentLoaded", function() { // check if page loaded

            let receiverId = {{ $receiver->id }}
            var receiverImage = "{{ $receiver->image }}";
            let aa = {{ $receiverId }}

            let senderId = {{ Auth::id() }}
            let messageForm = document.getElementById('message-form');
            let messageInput = document.getElementById('message');
            let messageChat = document.getElementById('messages-chat');
            let isWrite = document.getElementById('isWrite');

            // set online

            fetch(`/online`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            });

            messageForm.addEventListener('submit', function(e) {
                e.preventDefault()
                const message = messageInput.value;

                // ارسال البيانات الى القاعدة
                //رح ارسل واطبع فورا لانو مارح يعمل refresh

                if (message) {
                    fetch(`/chat/${receiverId}/send`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            message
                        })
                    });
                    let myMessage = `
                        <div class="message text-only">
                            <div class="response">
                                <p class="text"> ${message}</p>
                            </div>
                        </div>
                    `
                    messageChat.innerHTML += myMessage;
                }
                messageInput.value = '';
                messageChat.scrollTop = messageChat.scrollHeight;

            });

            // حاليا انا عم استمع حتى اذا وصلتني رسالة منو الشخص التاني
            //رح استقبل واطبع فورا لانو مارح يعمل refresh

            // subscribe to PrivateMessageSent channel

            window.Echo.private('chat.' + senderId) // listen to the room channel
                .listen('PrivateMessageSent', (e) => {
                    console.log(e);

                    isWrite.style.display = "none";

                    let comeMessage = `
                            <div class="message">
                                <p class="text"> ${e.message.message} </p>
                            </div>
                    `
                    messageChat.innerHTML += comeMessage;
                    messageChat.scrollTop = messageChat.scrollHeight;

                });

            // حاليا انا عم استمع حتى اذا وصلتني رسالة منو الشخص التاني

            // subscribe to userTyping channel
            let typingTimeout; // متغير لتخزين الـtimeout

            window.Echo.private(receiverId + '.typingTo.' + senderId) // listen to the room channel
                .listen('userTyping', (e) => {
                    console.log(e)

                    // set user typing message for other and delete after 1 seconde

                    isWrite.style.display = "block";
                    messageChat.scrollTop = messageChat.scrollHeight;


                    if (typingTimeout) {
                        clearTimeout(typingTimeout);
                    }

                    typingTimeout = setTimeout(() => {
                        isWrite.style.display = "none";
                    }, 1000);

                });


            // if input has edited make broadcast to new event for all users
            messageInput.addEventListener('input', function(e) {
                fetch(`/chat/typing/${receiverId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                });

            })









        })
    </script>

@endsection
