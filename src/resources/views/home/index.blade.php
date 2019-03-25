@extends('application.layout')
@section('content')
    <div id="results"></div>
@endsection
@section('postjs')
    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
    <script src="/js/app.js"></script>
    <script type="text/javascript">

        App.key = '{{ env('PUSHER_APP_KEY') }}';
        App.host = '{{ env('PUBLIC_PUSHER_HOST') }}';
        App.port = '{{ env('PUBLIC_PUSHER_PORT') }}';
        App.appId = '{{ env('PUSHER_APP_ID') }}';
        App.channel = 'results';
        @if(env('PUSHER_FORCE_TLS'))
            App.forceTLS = true;
        @endif

        App.init();
    </script>
@endsection
