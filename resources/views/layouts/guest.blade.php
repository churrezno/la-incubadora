<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

        <!-- Scripts -->
            <x-assets />


        <!-- Styles -->
        @livewireStyles
    </head>


    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-vh-100">
            <x-ecam.header />

            <!-- Page Content -->
            <main class="container">
                {{ $slot }}
            </main>
        </div>
    </body>

</html>
