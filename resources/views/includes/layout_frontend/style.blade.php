<head>
    <meta charset="utf-8">
    <title></title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.svg">

    <!-- Template CSS -->
    {{-- <link rel="stylesheet" href="assets/css/main.css?v=3.4"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('template/frontend/css/main.css?v=3.4') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/frontend/imgs/theme/favicon.svg') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/admin2/assets/css/vendors/sweetalert2.css') }}">
    <style>
        .select2-container {
            max-width: 100%;
        }

        .preloader {
            background-color: rgba(255, 255, 255, 0.9); 
        }

    </style>
</head>
