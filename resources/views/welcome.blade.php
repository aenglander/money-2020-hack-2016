@extends('layouts.splash')

@section('content')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
            background:
                    linear-gradient(
                            rgba(255, 255, 255, 0.8),
                            rgba(255, 255, 255, 0.8)
                    ),
                    url({{asset('images/background.jpeg')}}) no-repeat   center center fixed;
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
            text-align: center;

        }

        .title {
            font-size: 4em;
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

    </style>
    <div class="content">
        <div class="title m-b-md">
            Performer Pay
        </div>
        <div class="m-b-md">
            <h3>The easy way to get tipped!</h3>
        </div>
        <a href="{{ url('/how-it-works') }}" class="btn btn-default btn-lg" role="button">How It Works</a>
        <a href="{{ url('/register') }}" class="btn btn-default btn-lg" role="button">Get Paid</a>
        <a href="{{ url('/login') }}" class="btn btn-default btn-lg" role="button">Existing Members</a>
    </div>
@endsection

