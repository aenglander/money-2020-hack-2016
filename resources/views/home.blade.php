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
                            rgba(255, 255, 255, 0.8),
                            rgba(255, 255, 255, 0.8)
                    ),
                    url({{asset('images/dashboard-background-sm.jpg')}}) no-repeat   center center fixed;
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
                <div class="panel-heading"><h1>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}'s Dashboard</h1></div>

                <div class="panel-body">
                    <div class="row text-center">
                        <div id="show-qrcode" style="display: none;">
                            <h3>Quick Pay QR Code</h3>
                            <p>Let someone scan this with their phone to receive a tip.</p>
                            <div id="qrcode" style="padding: 10px;"></div>
                        </div>
                        <br />
                        <div class="row text-center">
                            <div class="col-sm-4">
                        <input type="button" value="Toggle QR Code" class="btn btn-info btn-lg" onclick="ShowQRCode()" /></div>
                            <div class="col-sm-4">
                        <a type="button" class="btn btn-info btn-lg" href="{{ $url }}">Show My Tip Page<a/>
                        </div>
                        <div class="col-sm-4">
                        <input type="button" value="Print My QR Code" class="btn btn-info btn-lg" onclick="PrintImage()" />
                        </div>
                            </div>
                    </div>
                    <hr />
                    <div class="row text-center" id="become-an-affiliate">
                        <h3>Become An Affiliate</h3>
                        <p>Would you like to sign other people up and earn cash every time they pay with their card?</p>
                        <input type="button" value="Apply As Affiliate" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal" onclick="hideAffiliate()" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Application Submitted</h4>
            </div>
            <img class="img-responsive center-block" src="{{asset('images/money-icon.png')}}">
            <div class="modal-body">
                Thank you for applying to become an affiliate. You've been placed into queue for our screening process. A customer representative will contact you shortly to determine if you qualify.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Application Submitted</h4>
                </div>
                <img class="img-responsive center-block" src="{{asset('images/money-icon.png')}}">
                <div class="modal-body">
                    Thank you for applying to become an affiliate. You've been placed into queue for our screening process. A customer representative will contact you shortly to determine if you qualify.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/qrcode.js"></script>
    <script type="text/javascript">
        function ShowQRCode() {
            $('#show-qrcode').toggle();
        }
        function hideAffiliate() {
            $('#become-an-affiliate').hide();
        }
        function ImagetoPrint(source) {
            return "<html><head><script>function step1(){\n" +
                    "setTimeout('step2()', 10);}\n" +
                    "function step2(){window.print();window.close()}\n" +
                    "</scri" + "pt></head><body onload='step1()'>\n" +
                    "<br /><br /><br /><br /><center><img src='" + source + "' /></center></body></html>";
        }
        function PrintImage() {
            Pagelink = "about:blank";
            var pwa = window.open(Pagelink, "_new");
            pwa.document.open();
            pwa.document.write(ImagetoPrint($('div#qrcode > img')[0].src));
            pwa.document.close();
        }
        new QRCode(document.getElementById('qrcode'), {
                    text: '{{ $url }}',
            width : 512,
            height : 512,
         });
        $('div#qrcode > img').addClass('center-block');
        $('div#qrcode > img').addClass('img-responsive');
    </script>
@endsection
