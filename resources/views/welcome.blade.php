<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Themba Holidays</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
        <!-- include app stylesheet -->
        <link rel="stylesheet" href="{{ asset('css/app.css')}} ">
        <style>
            *{
                margin: 0px;
                padding: 0px;
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div id="app">
           <Home />
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
