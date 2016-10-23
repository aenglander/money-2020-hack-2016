<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

use App\Http\Requests;

class PerformerController extends Controller
{
    //
    private $paymentService;

    public function __construct(PaymentService $paymentServiceProvider)
    {
        $this->paymentService = $paymentServiceProvider;
    }

    public function show($uuid) {
        return view('performer.show', ['uuid' => $uuid]);
    }

    public function pay(Requests\PerformerFormRequest $performerFormRequest) {

        return view('performer.pay', ['paymentStatus' => null]);
    }
}
