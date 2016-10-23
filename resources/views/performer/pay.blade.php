@extends('layouts.app')

@section('content')
    <style>
        html, body {
            background: url({{asset('images/mind-blown.gif')}})  no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .panel {
            background-color: rgba(255, 255, 255, 0.9);
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Thanks!</h1></div>
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <div class="panel-body">
                        @if($paymentId)
                            <h3 class="text-center">Your generosity has blown me away!</h3>
                            <img class="img-responsive center-block" src="{{asset('images/mind-blown.gif')}}">
                            <div class="text-center"><b>Transaction ID:</b> {{ $paymentId }}</div>
                        @else
                            <h3>{!! $paymentMessage !!}</h3>
                            <div class="text-center"><b>Payment Status:</b> {{ $paymentStatus }}</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
