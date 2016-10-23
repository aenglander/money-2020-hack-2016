@extends('layouts.splash')

@section('styles')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <style>
        #app {
            min-height: 100%;
        }

        html, body {
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
            background:
                    linear-gradient(
                            rgba(0, 0, 0, 0.65),
                            rgba(0, 0, 0, 0.65)
                    ),
            url({{asset('images/home-background-sm.jpg')}}) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            font-weight: bolder;
            color: #fff;
            padding-top: 20%;
            text-align: center;
            vertical-align: middle;
            margin: auto;
        }

        .title {
            font-size: 4em;
            text-shadow: 0 0 20px #000;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .tagline {
            font-weight: bolder;
            text-shadow: 0 0 20px #000;
        }

        .tighty-whitey {
            color: #ffffff;
            font-weight: bolder;
            font-size: 2em;
            padding: 1em;
        }
        .jackie-blacky {
            color: #090909;
            font-weight: bold;
            font-size: 2em;
        }
    </style>
@endsection

@section('content')
    <a href="{{ url('/how-it-works') }}" class="tighty-whitey" style="float: left;">How It Works</a>
    <a href="{{ url('/login') }}" class="tighty-whitey" style="float: right;">Existing Members</a>
    <div class="content">
        <div class="title m-b-md">
            <div>{{ config('app.name', 'Laravel') }}</div>
        </div>
        <div class="m-b-md">
            <h2 class="tagline">The easy way to get tipped!</h2>
        </div>
        <a href="{{ url('/register') }}" class="btn btn-success btn-lg jackie-blacky" role="button">Start Getting Paid</a>
    </div>
    <script>
        $("#logo").fadeIn(2000);
    </script>
@endsection

