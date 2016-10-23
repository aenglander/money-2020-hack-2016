<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PerformerQrCodeController extends Controller
{

    /**
     * PerformerQrCodeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $url = route('performer_profile_get', ['uuid' => Auth::user()->uuid]);
        return view('qrcode', ['url' => $url]);
    }
}
