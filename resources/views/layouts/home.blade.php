<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Website - event</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css'])
    </head>
    <body>
        <div class="flex flex-col w-full px-10 py-5">
            @include('partials.header')
            
            @yield('content')

            @include('partials.footer')
        </div>

        @yield('js')
    </body>
</html>
