@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h3>Quick Pay QR Code</h3>
                    <div id="qrcode"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="/js/qrcode.js"></script>
    <script language="JavaScript">
        new QRCode(document.getElementById('qrcode'), "{{$url}}");
    </script>
@endsection
