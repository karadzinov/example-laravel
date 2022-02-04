@extends('layouts.dashboard')
@section('content')

    <div class="row">
        <div class="col-12">
            <div id="messages">
                @foreach($messages as $message)
                    <p>{{ $message->name }}: {{ $message->message }}</p>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('chat') }}" method="post">
                @csrf()
                <input type="text" class="form-control" name="message">
                <button type="submit"  class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>

@endsection
@section('scripts')


    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
        var module = {}; /*   <-----THIS LINE */
    </script>

    <script type="module">

        import Echo from '/js/echo.js'

        import {Pusher} from '/js/pusher.js'

        window.Pusher = Pusher

        Pusher.logToConsole = true;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'bb74ba594feee16a52ae',
            authEndpoint: '/broadcasting/auth',
            cluster: 'eu',
            logToConsole: true,
        });

        let userId = {{ auth()->user()->id }}

        /*
    window.Echo.private(`user.${userId}`)
        .notification((notification) => {
            console.log(notification.type);
        });


         */

        window.Echo.channel(`my-channel`).listen('.payment.created', (e) => {
            console.log(e);

            $("#messages").append('<p>' + e.user.name + ' ' + e.message + '</p>');

        });


        console.log("websokets in use")

    </script>
@endsection
