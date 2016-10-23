@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Tip Me!</h1></div>
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    <div class="panel-body">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                        {!! Form::open(array('route' => 'pay_performer', 'class' => 'form')) !!}
                            {!! Form::hidden('uuid', $uuid) !!}
                        <div class="form-group">
                        </div>

                        <div class="form-group">
                            {!! Form::label('First Name') !!}
                            {!! Form::text('first_name', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'John')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Last Name') !!}
                            {!! Form::text('last_name', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'Smith')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Your E-mail Address') !!}
                            {!! Form::text('email', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'Your e-mail address')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Card Number') !!}
                            {!! Form::text('card_number', '5102589999999939',
                                array('required',
                                'min' => '16',
                                'max' => '16',
                                      'class'=>'form-control',
                                      'placeholder'=>'5102589999999939')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Address Line 1') !!}
                            {!! Form::text('address_1', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder'=>'123 Main St.')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Address Line 2') !!}
                            {!! Form::text('address_2', null,
                                array('class'=>'form-control',
                                      'placeholder'=>'Apt #D-123')) !!}
                        </div>

                        <div class="form-group">
                            @include('shared.state')
                        </div>

                        <div class="form-group">
                            {!! Form::label('Exp Year') !!}
                            {!! Form::selectYear('exp_year', 2016, 2020, 2017, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Exp Month') !!}
                            {!! Form::selectMonth('exp_month', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Card Type') !!}
                            {!! Form::select('card_type', array('CREDIT' => 'Credit', 'DEBIT' => 'Debit', 'PREPAID' => 'Pre-paid'), 'CREDIT', ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Your Message') !!}
                            {!! Form::textarea('message', null,
                                array('required',
                                      'class'=>'form-control',
                                      'placeholder' => 'Dude, your skateboard skills are hella cray brah!')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Send Tip!',
                              array('class'=>'btn btn-primary')) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection