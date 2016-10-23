@extends('layouts.app')

@section('content')
    <style>

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
                    url({{asset('images/background-howitworks-sm.jpg')}}) no-repeat   center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .panel {
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>How It Works</h1></div>
                    <div class="panel-body">
                        <h3 class="center-block">Step 1 - Free Sign Up</h3>
                        <p>Fill out our easy to use member registration form.</p>
                        <div class="row">
                            <img class="img-responsive center-block" src="{{asset('images/signup.png')}}">
                        </div>
                        <h3 class="center-block">Step 2 - Get Your Card</h3>
                        <p>Get your free card to start receiving funds and use as a normal card.</p>
                        <div class="row">
                            <img class="img-responsive center-block" src="{{asset('images/performer-pay-cc.png')}}">
                        </div>

                        <h3 class="center-block">Step 3 - Get Paid</h3>
                        <p>Print your QR code and display it when you perform to get paid.</p>
                        <div class="row">
                            <img class="img-responsive center-block" src="{{asset('images/qr-code-scan.png')}}">
                        </div>
                        <a href="{{ url('/register') }}" class="btn btn-primary btn-lg center-block" role="button">Sign Up Now</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
