@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div onclick="populateForm()" class="panel-heading">
                        <h1>Tip {{$name}}!</h1>
                    </div>
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

                        {{ Form::open(array('route' => 'pay_performer', 'class' => 'form')) }}
                            {{ Form::hidden('uuid', $uuid) }}

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::text('credit_card_number', null,
                                            array('required',
                                                'min' => '15',
                                                'max' => '16',
                                                'id' => 'cardNumber',
                                                'class'=>'form-control',
                                                'placeholder'=>'Card Number',
                                                'autocomplete' => 'cc-number')
                                        ) }}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        {{ Form::selectMonth('exp_month', null, ['class' => 'form-control',
                                                  'id' => 'creditCardMonth',
                                                  'placeholder'=>'Exp Month', 'autocomplete' => 'cc-exp-month']) }}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        {{ Form::selectYear('exp_year', 2016, 2020, null, ['class' => 'form-control',
                                                     'id' => 'creditCardYear',
                                                      'placeholder'=>'Exp Year', 'autocomplete' => 'cc-exp-year']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::text('first_name', null,
                                    array('required',
                                          'class'=>'form-control',
                                          'placeholder'=>'First Name',
                                          'autocomplete' => 'cc-given-name')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::text('last_name', null,
                                    array('required',
                                          'class'=>'form-control',
                                          'placeholder'=>'Last Name',
                                          'autocomplete' => 'cc-family-name')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::text('address_1', null,
                                    array('required',
                                          'class'=>'form-control',
                                          'placeholder'=>'Billing Address')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::text('address_2', null,
                                    array('class'=>'form-control',
                                          'placeholder'=>'Billing Address 2')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::text('city', null,
                                    array('class'=>'form-control',
                                          'placeholder'=>'City')) }}
                            </div>
                            <div class="form-group">
                                @include('shared.state')
                            </div>
                            <div class="form-group">
                                {{ Form::text('postal_code', null,
                                    array('class'=>'form-control',
                                          'placeholder'=>'Zipcode')) }}
                            </div>
                            {{ Form::hidden('tip_amount', null, ['id' => 'tip_amount']) }}

                            <div class="form-group">
                                <div class="row">
                                    <div class="text-center">
                                        <button class="btn btn-default btn-lg" onclick="document.getElementById('tip_amount').value = 100; this.form.submit()">$1</button>
                                        <button class="btn btn-default btn-lg" onclick="document.getElementById('tip_amount').value = 200; this.form.submit()">$2</button>
                                        <button class="btn btn-default btn-lg" onclick="document.getElementById('tip_amount').value = 500; this.form.submit()">$5</button>
                                        <button class="btn btn-default btn-lg" onclick="document.getElementById('tip_amount').value = 1000; this.form.submit()">$10</button>
                                        <button class="btn btn-default btn-lg" onclick="document.getElementById('tip_amount').value = 2000; this.form.submit()">$20</button>
                                    </div>
                                </div>
                            </div>

                        {{ Form::close() }}
                        <script>
                            function populateForm() {
                                document.getElementsByName('first_name')[0].value = "Jack";
                                document.getElementsByName('last_name')[0].value = "Smith";
                                document.getElementsByName('credit_card_number')[0].value = "5102589999999939";
                                document.getElementsByName('exp_year')[0].value = "2017";
                                document.getElementsByName('exp_month')[0].value = "8";
                                document.getElementsByName('address_1')[0].value = "123 Test St.";
                                document.getElementsByName('address_2')[0].value = "Apt # 3D";
                                document.getElementsByName('city')[0].value = "Las Vegas";
                                document.getElementsByName('state')[0].value = "NV";
                                document.getElementsByName('postal_code')[0].value = "89123";
                                document.getElementsByName('tip_amount')[0].value = "5.00";
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection