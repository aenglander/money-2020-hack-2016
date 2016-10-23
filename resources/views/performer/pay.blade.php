@extends('layouts.app')

@section('content')
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
                            <div class="text-center"><b>Payment ID:</b> {{ $paymentId }}</div>
                        @else
                            <h3>{!! $paymentMessage !!}</h3>
                        @endif
                        <div class="text-center"><b>Payment Status:</b> {{ $paymentStatus }}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
