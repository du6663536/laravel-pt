<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Live</title>

       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/live.css') }}"> --}}

    </head>
    <body>
        @include('live::layouts._header')
        @yield('content')
        @include('live::layouts._footer')
        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/live.js') }}"></script> --}}
        @yield('scriptsAfterJs')
    </body>
</html>
