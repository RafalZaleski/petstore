<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>PetStore</title>
        <meta name="description" content="PetStore">
        <link rel="icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/favicon.ico" sizes="180x180">
        <meta name="theme-color" content="#ffffff">
        
        @vite('resources/js/app.js')

    </head>
    <body style="font-family: 'Roboto', sans-serif;">
        <div id="app"></div>
    </body>
</html>
