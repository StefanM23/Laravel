<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <App></App>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>