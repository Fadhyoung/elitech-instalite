<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="w-full h-screen flex justify-center items-center" style="background-color: #FAFAFA;">

        <div class="lg:w-1/2 xs:w-full h-1/2 lg:m-auto xs:m-0 flex lg:flex-row xs:flex-col gap-10 justify-center items-center">

            <!-- LEFT SIDE -->
            <div class="w-full h-auto lg:flex xs:hidden items-end justify-end bg-red-50">
                <img src="{{ asset('images/img_mockup_cover.png') }}"
                    alt="Instagram Mobile Mockup"
                    class="h-full w-full object-contain object-right" />
            </div>
            <!-- RIGHT SIDE -->
            <div class="w-full">
                {{ $slot }}
            </div>
        </div>

    </div>
</body>

</html>