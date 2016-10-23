<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;

class PerformerController extends Controller
{
    //
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function show($uuid) {
        return view('performer.show', ['uuid' => $uuid, 'name' => User::where('uuid', '=', $uuid)->firstOrFail()->stage_name]);
    }

    public function pay(Requests\PerformerFormRequest $performerFormRequest) {
        $acctRef = 'ref_acct_01538931851233324970';
        $userFirstName = 'Jane';
        $userLastName = 'Smith';
        $response = $this->paymentService->makePayment(
            $performerFormRequest->get('first_name'),
            $performerFormRequest->get('last_name'),
            $performerFormRequest->get('credit_card_number'),
            $performerFormRequest->get('exp_year'),
            $performerFormRequest->get('exp_month'),
            $performerFormRequest->get('address_1'),
            $performerFormRequest->get('address_2'),
            $performerFormRequest->get('city'),
            $performerFormRequest->get('state'),
            $performerFormRequest->get('postal_code'),
            $acctRef,
            $userFirstName,
            $userLastName,
            $performerFormRequest->get('postal_code'));

        if ($response) {
            $paymentStatus=$response->get("transfer.transaction_history.data.transaction.status");
            $paymentId = $response->get("transfer.transfer_reference");
        } else {
            $paymentStatus = 'ERROR';
            $paymentId = 'N/A';
        }

        if ($paymentStatus === 'APPROVED') {
            $paymentMessage = 'Thank you for your tip and supporting the local artists!';
        } elseif ($paymentStatus === 'ERROR') {
            $paymentMessage = 'There was a problem processing your transaction, please try again.';
        } else {
            $paymentMessage = 'unknown';
        }
        return view('performer.pay', [
            'paymentMessage' => $paymentMessage,
            'paymentId' => $paymentId,
            'paymentStatus' => $paymentStatus,
        ]);
    }
}
