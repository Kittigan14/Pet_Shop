<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>

    <title>@yield("title", "PetShop | Selling Pets Online")</title>

</head>

<body>

    <div class="container">

        <nav class="navbar">

            <div class="navbar-header">
                <a class="navbar-brand" href="#"> Pet Shop </a>
            </div>

            <div class="col-8" id="menu">
                <ul class="nav justify-content-left">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ URL::to('pet') }}">Pet Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">Category Pet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="#">About Us</a>
                    </li>
                </ul>
            </div>

        </nav> @yield("content")

        @if(session('msg'))
            @if(session('ok'))
            <script>
                toastr.success("{{ session('msg') }}")
            </script>

            @else
            <script>
                toastr.error("{{ session('msg') }}")
            </script>
            @endif
        @endif

    </div>

    {{-- Script Bootstrap --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

</body>

</html>
