<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" href="{{asset('contents/admin')}}/assets/img/icon.ico" type="image/x-icon"/>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .navbar-brand{
                color: #0be881;
                font-weight: 800;
                transition: all 0.4s;
                padding: 10px 30px;
                transition: all 0.3s linear;
                font-size: 2rem;
            }
            .navbar-brand span{
                font-size: 1.3rem;
            }
            .navbar-brand:hover{
                color: #0be881;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            {{-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div> --}}

            {{-- <a href="{{ url('/') }}" class="logo d-flex justify-content-center align-items-center">
                <h3 class="text-uppercase font-weight-bold" style="">
                    JM International 
                </h3>
            </a>
             --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-suitcase-medical"></i>
                JM.<span>INTERNATIONAL</span>
            </a>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
