@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">How It Works</div>
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
