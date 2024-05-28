<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(Auth::id())
    <meta name="user_id" content="{{ Auth::id() }}">
    @endif
    <title>{{ config('app.name','OCTEE') }}{{ !empty($title) ? ' - '.$title : ''}}</title>
    <link href="{{ asset('user/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('user/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('user/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{ asset('user/css/price-range.css')}}" rel="stylesheet">
    <link href="{{ asset('user/css/animate.css')}}" rel="stylesheet">
    <link href="{{ asset('user/css/main.css')}}" rel="stylesheet">
    <link href="{{ asset('user/css/responsive.css')}}" rel="stylesheet">
    <link href="{{ asset('user/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{ asset('user/css/style.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('vendor/images/icons/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/ico/apple-touch-icon-57-precomposed.png')}}">

    <link href="{{ asset('css/user/custom.css')}}" rel="stylesheet">

    <!-- <div class="zalo-chat-widget" data-oaid="832119572324877926" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height=""></div>
    <script src="https://sp.zalo.me/plugins/sdk.js"></script> -->
    <!-- <div id="chatbox"></div>
    <input type="text" id="userInput" placeholder="Type a message..." />
    <button id="sendButton">Send</button> -->
    <style>
        #container_viewed {
            display: none;
        }

        #container_viewed.active {
            display: block;
        }

        .chat-widget {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1000;
        }

        .chat-widget img {
            width: 40px;
            height: 40px;
        }

        .chat-window {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 300px;
            height: 400px;
            border: 1px solid #ccc;
            background-color: #fff;
            display: none;
            flex-direction: column;
            z-index: 1000;
        }

        .chat-window .chat-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .chat-window .chat-body {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
        }

        .chat-window .chat-footer {
            padding: 10px;
            display: flex;
        }

        .chat-window .chat-footer input {
            flex: 1;
            padding: 5px;
        }

        .chat-window .chat-footer button {
            padding: 5px 10px;
        }
    </style>
    @yield('head')
</head><!--/head-->

<body>
    @include('layouts.user.header')

    @yield('content')
    <div class="chat-widget">
        <img src="{{ asset('images/chat-icon.png') }}" alt="Chat">
    </div>
    <div class="chat-window">
        <div class="chat-header">
            Chatbot
        </div>
        <div class="chat-body" id="chatbox"></div>
        <div class="chat-footer">
            <input type="text" id="userInput" placeholder="Type a message...">
            <button id="sendButton">Send</button>
        </div>
    </div>

    @include('layouts.user.footer')

    <script src="{{ asset('user/js/jquery.js')}}"></script>
    <script src="{{ asset('user/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('user/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{ asset('user/js/price-range.js')}}"></script>
    <script src="{{ asset('user/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{ asset('user/js/main.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{ asset('js/moment.min.js')}}"></script>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js'></script>
    <script src="{{asset('user/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('user/js/custom.js')}}"></script>
    <script type="text/javascript">
        function viewed() {
            if (localStorage.getItem('viewed') != null) {
                var data = JSON.parse(localStorage.getItem('viewed'));
                var row_viewed = $('#row_viewed');
                data.reverse();
                if (row_viewed) {
                    row_viewed.css('overflow', 'scroll');
                    row_viewed.css('height', '500px');

                    for (i = 0; i < data.length; i++) {
                        if (data[i].id != undefined) {
                            $('#container_viewed').addClass('active');
                            var name = data[i].name;
                            var price = data[i].price;
                            var url = data[i].url;
                            var image = data[i].image;
                            row_viewed.append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="' + image + '"></div><div class="col-md-8"><p>' + name + '</p><p style="color:#FE980F">' + price + '&#8363;</p><a href="' + url + '">Xem ngay</a></div>')
                        }
                    }
                }
            }
        }
        viewed();
        product_viewed();

        function product_viewed() {
            var id_pro = $('#product_viewed_id').val();
            if (id_pro != undefined) {
                var id = id_pro;
                var name = document.getElementById('viewed_product_name' + id).value;
                var url = document.getElementById('viewed_product_url' + id).value;
                var price = document.getElementById('viewed_product_price' + id).value;
                var image = document.getElementById('viewed_product_image' + id).value;
            }
            var newItem = {
                'url': url,
                'id': id_pro,
                'name': name,
                'price': price,
                'image': image
            }
            if (localStorage.getItem('viewed') == null) {
                localStorage.setItem('viewed', '[]')
            }

            var old_data = JSON.parse(localStorage.getItem('viewed'));
            var matches = $.grep(old_data, function(obj) {
                return obj.id == id_pro;
            })

            if (matches.length) {

            } else {
                old_data.push(newItem);
                $('#row_viewed').append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="' + newItem.image + '"></div><div class="col-md-8"><p>' + newItem.name + '</p><p style="color:"#FE980F">' + newItem.price + '</p><a href="' + newItem.url + '">Xem ngay</a></div>')
            }
            localStorage.setItem('viewed', JSON.stringify(old_data));
        }
    </script>
    <script type="text/javascript">
        $('#key_word').keyup(function() {
            var key_word = $(this).val();
            let searchInput = $('#search_ajax');

            if (key_word.length > 0) {
                $.ajax({
                    url: "{{url('autocomplete-ajax')}}",
                    method: "GET",
                    data: {
                        key_word: key_word
                    },
                    success: function(res) {
                        if (!res.error) {
                            if (res.data.length > 0) {
                                let html = '<ul class="show">';

                                $.each(res.data, function(key, value) {
                                    let url = location.origin + '/product/' + value.id + '/detail';
                                    html += '<li class="li_cursor_mouse" style="padding: 5px 10px;"><a href="' + url + '" class="a_cursor_mouse">' + value.name + '</a></li>';
                                });

                                html += '</ul>';

                                searchInput.fadeIn();
                                searchInput.html(html);
                            }

                        } else {
                            searchInput.fadeOut();
                            searchInput.html('');
                        }
                    }
                });
            } else {
                searchInput.fadeOut();
                searchInput.html('');
            }
        });
        const chatWidget = document.querySelector('.chat-widget');
        const chatWindow = document.querySelector('.chat-window');
        const sendButton = document.getElementById('sendButton');
        const chatbox = document.getElementById('chatbox');
        const userInput = document.getElementById('userInput');

        chatWidget.addEventListener('click', () => {
            chatWindow.style.display = chatWindow.style.display === 'none' ? 'flex' : 'none';
        });

        sendButton.addEventListener('click', () => {
            const userMessage = userInput.value;
            userInput.value = '';
            chatbox.innerHTML += `<p><strong>You:</strong> ${userMessage}</p>`;

            fetch('/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        message: userMessage
                    })
                })
                .then(response => response.json())
                .then(data => {
                    data.forEach(msg => {
                        chatbox.innerHTML += `<p><strong>Bot:</strong> ${msg.text}</p>`;
                    });
                    chatbox.scrollTop = chatbox.scrollHeight;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
    @yield('script')
    @include('layouts.message.alert-message')
</body>

</html>