<!DOCTYPE html>
<html ng-app="pos">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo</title>
    <link rel="icon" href="{{ asset('icon.png') }}" type="image/gif" sizes="17x17">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/footer.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{asset('js/jquery-3.4.1.min.js')}}" type="text/javascript"></script>

@yield('css')

<!-- Latest compiled and minified CSS -->
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">--}}
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->





    <style>
        @import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);
        body {
            font-family: 'Open Sans', 'sans-serif';
            background: #f0f0f0;
        }

        h1,
        .h1 {
            font-size: 36px;
            text-align: center;
            font-size: 5em;
            color: #404041;
        }
        .navbar-nav>li>.dropdown-menu {
            margin-top: 20px;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }

        table {
            /*border: 2px solid #cfd6c7;*/
            border-radius: 3px;
            background-color: #fff;
            /*border-collapse: collapse;*/
        }

        th {
            background-color: #a5b9b8;
            /*border: 2px solid #fff;*/
            border: 1px solid #dddddd;
            color: #fff;
            text-transform: uppercase;
            /*line-height: 1;*/
        }
        td {
            background-color: #f9f9f9;
            /*border: 2px solid #fff;*/
            border: 1px solid #dddddd;
        }

        .navbar-brand{
            color: white;
        }
        .nav > li > a {
            color: #ffffff;
        }
        .nav .open > a, .nav .open > a:hover, .nav .open > a:focus {
            background-color: #615c5c;
        }
    </style>


</head>
<body style="background-image: url({{ asset('/images/login.png') }}); background-repeat: repeat;min-height: 550px;">
<nav class="navbar" style="background-color: #88928d!important;box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12)!important">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">Demo</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">

                    {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu" role="menu">--}}
                    {{--<li><a href="{{ url('/tutapos-settings') }}">{{trans('menu.application_settings')}}</a></li>--}}
                    {{--<li class="divider"></li>--}}
                    {{--<li>--}}
                    {{--<a href="{{ url('/auth/logout') }}">{{trans('menu.logout')}}</a></li>--}}
                    {{--</ul>--}}
                    {{--</li>--}}



            </ul>
        </div>

    </div>
</nav>

<div class="container" >
    @yield('content')
</div>

{{--<script>--}}
{{--$(document).ready(function() {--}}
{{--$('.js-example-basic-single').select2();--}}
{{--});--}}
{{--</script>--}}
<script src="{{asset('js/bootstrap-3.3.1/bootstrap.min.js')}}" type="text/javascript"></script>

@yield('script')
</body>
</html>
