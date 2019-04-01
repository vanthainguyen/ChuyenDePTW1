<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flights - Worldskills Travel</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    
</head>
<body>
<div class="wrapper">
    @include('sweetalert::alert')
    <header>
        <nav class="navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{route('home')}}" class="navbar-brand">Worldskills Travel</a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Welcome 
                        @if(Session::has('login') && Session::get('login') == true)
                        {{ Session::get('email') }}  @endif</a></li>
                       
                        <li><a href="{{route('home')}}">Flights</a></li>
                        @if(Session::get('login') == false ) 
                        <li><a href="{{route('getLogin')}}">Log In</a></li>
                        @endif  
                        <li><a href="{{route('regis')}}">Register</a></li>
                        @if(Session::has('login') && Session::get('login') == true)
                        <li><a href="{{route('getLogout')}}">Logout</a></li>
                        @endif                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>
@yield('content')
<footer>
        <div class="container">
            <p class="text-center">
                Copyright &copy; 2017 | All Right Reserved
            </p>
        </div>
    </footer>
</div>
<!--scripts-->

<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('css/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>