<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Curso Vue 2</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="{{ asset('favicon.ico') }}">
		<link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <noscript>
            <strong>We're sorry but tasks doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
        </noscript>
        <div id="app">
            <app></app>
        </div>
        <!-- built files will be auto injected -->

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
