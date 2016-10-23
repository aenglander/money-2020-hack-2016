@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Perfromer</h1></div>
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <div class="panel-body">
                        <h3>{!! $paymentMessage !!}</h3>
                        <b>Payment ID:</b> {{ $paymentId }}
                        <b>Payment Status:</b> {{ $paymentStatus }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
