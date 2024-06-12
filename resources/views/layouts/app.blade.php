<!doctype html>
<html lang="en">

<head>
    <title>@yield('title', config('app.name'))</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('icon.ico') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sticky-footer-navbar.css') }}">

    @stack('css')
    <style>
        .cardTranasaction {
            height: 27rem;
            border: 0.1px solid #A39B9B;
            border-radius: 10px;
            overflow: hidden;
        }
        .balance-detail {
            background-color: #D1C4E9;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            width: 17rem;
            box-shadow: 0px 5px #A39B9B;
            margin-top: -5px; 
        }
        .balance-detail p {
            color: #ffffff;
            font-size: 1rem;
            margin-left: -4rem;
            
        }
        .trasaction-history-heading {
            text-align: center;
        }
        .trasaction-history-heading p span {
            color: #593196;
            font-weight: bold;
            margin-left: 1.5rem;
        }
        .balance-detail .rp {
            font-size: 1rem; 
            color: #6A1B9A;
            margin-left: -8rem;
        }
        .balance-detail h2 {
            font-size: 2.5rem;
            color: #6A1B9A;
            margin-top: -0.8rem;
        }
        .trasaction-history-heading {  
            padding: 10px;
        }

        .trasaction-history-content {  
            padding: 10px;
        }

        .trasaction-history-content h6 {
            font-weight: bold;
        }

        .trasaction-history-content p{

        }
        .trasaction-history-content .count {
            margin-left: 10rem; 
            margin-top: -5rem; 
        }

        .trasaction-history-content p {
            margin-bottom: 2rem; 
        }
        .trasaction-history-content .name {
            margin-left: 1.5rem; 
        }

        .trasaction-history-heading p{
            color: #343A40; 
            font-size: 3px;
        }
        .card {
            border-radius: 10px;
            margin-top: 20px;
        }
        .nav-link {
            color: white !important;
        }
        .navbar {
            background-color: #6A1B9A;
        }
        .transaction-history {
            margin-top: 20px;
        }
        .transaction-history p {
            font-size: 1rem;
        }
        .transaction-history a {
            color: #6A1B9A;
        }
        .graph-container {
            margin-top: 30px;
        }

        .cardInfo {
            width: 15rem;
            height: 5rem;
            border-radius: 10px;
            background-color: #EDEDED;
            overflow: hidden;
            margin-left: 2rem;
        }

        .Rectangle {
            margin-top: -20px; 
            width: 3rem;
            height: 3rem;
            background-color:#f4f1f1;
            box-shadow: 0px 3px #A39B9B;
            border-radius: 10px
        }

        .number {
            margin-top: -5rem;
            margin-left: 8.5rem;
        }
        .number h4 {
            color: #593196;
            font-size: 2.5rem;
            font-weight: bolder;
        }

        .textInfo {
            margin-top: 0.5rem;
            color: #593196;
        }

        .garis {
            background-color: #A39B9B;
            width: 13.5rem;
            height: 1px;
            margin-left: 1rem;
            margin-top: 1.5rem;
        }


    </style>

</head>

<body class="d-flex flex-column h-100">

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                    aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        @auth
                            @include('layouts.menu')
                            @stack('left-nav')
                        @else
                            @stack('left-nav-guest')
                        @endauth
                    </ul>

                    <ul class="navbar-nav">
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                {{strtoupper(Lang::locale())}}
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="lang/id">ID</a>
                                <a class="dropdown-item" href="lang/en">EN</a>
                            </div>
                        </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('my-profile') }}">Update Profile</a>
                                    <a class="dropdown-item" href="{{ route('my-password') }}">Update Password</a>
                                    <a class="dropdown-item" href="#">Information</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                            @stack('right-nav')
                        @else
                            @stack('right-nav-guest')
                        @endauth
                    </ul>

                    @stack('nav-right')
                </div>
            </div>
        </nav>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            @yield('body')
        </div>
    </main>

    <footer class="footer mt-3 py-3">
        <div class="container text-center">
            <span class="text-muted">{{ config('app.name') }} &copy; 2023</span>
        </div>
    </footer>

    @include('layouts.modal')
    @include('sweetalert::alert')
    <script src="{{ asset('vendor/jquery/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}

    <script>
        $("form").attr('autocomplete', 'off')
        $("input").attr('autocomplete', false)
    </script>
    @yield('script')
    @stack('js')
</body>

</html>
