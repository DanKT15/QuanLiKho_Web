<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">


        <link rel="stylesheet" type="text/css" href={{ asset("/vendor/bootstrap/css/bootstrap.min.css") }}>
        <link rel="stylesheet" type="text/css" href={{ asset("/fonts/font-awesome-4.7.0/css/font-awesome.min.css") }}>
        <link rel="stylesheet" type="text/css" href={{ asset("/vendor/animate/animate.css") }}>
        <link rel="stylesheet" type="text/css" href={{ asset("/vendor/css-hamburgers/hamburgers.min.css") }}>
        <link rel="stylesheet" type="text/css" href={{ asset("/vendor/select2/select2.min.css") }}>
        <link rel="stylesheet" type="text/css" href={{ asset("/css/util.css") }}>
        <link rel="stylesheet" type="text/css" href={{ asset("/css/main.css") }}>

        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    
        <!--Javascript-->
        <script src={{ asset("/js-pl/main.js") }}></script>
    
        <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    
        <script src={{ asset("/vendor/jquery/jquery-3.2.1.min.js") }}></script>
        <script src={{ asset("/vendor/bootstrap/js/popper.js") }}></script>
        <script src={{ asset("/vendor/bootstrap/js/bootstrap.min.js") }}></script>
        <script src={{ asset("/vendor/select2/select2.min.js") }}></script>

    </body>
</html>
