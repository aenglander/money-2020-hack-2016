<?php
/**
 * Created by IntelliJ IDEA.
 * User: josh
 * Date: 10/22/16
 * Time: 4:15 PM
 */

namespace App\Services;

use Illuminate\Support\Facades\Log;
use MasterCard\Core\Model\BaseObject;
use MasterCard\Core\Model\RequestMap;
use MasterCard\Core\ApiConfig;
use MasterCard\Core\Security\OAuth\OAuthAuthentication;
use MasterCard\Api\P2p\PaymentTransfer;

class PaymentService
{
    /**
     * @var RequestMap
     */
    private $map;

    public function __construct($consumerKey, $keyAlias, $keyPassword, $privateKey)
    {
        ApiConfig::setAuthentication(new OAuthAuthentication($consumerKey, $privateKey, $keyAlias, $keyPassword));
        ApiConfig::setDebug(true);
        ApiConfig::setSandbox(true);   // For production: use ApiConfig::setSandbox(false)
    }


    public function makePayment(
        $firstName,
        $lastName,
        $cardNumber,
        $cardYearExp,
        $cardMonthExp,
        $address1,
        $address2,
        $city,
        $state,
        $zipcode,
        $acctRef,
        $userFirstName,
        $userLastName,
        $amount)
    {
        $transferRef = 'PP'.mt_rand(1000000,99999999999).mt_rand(1000000,99999999999);
        $senderPanUri = sprintf('pan:%d;exp=%d-%02d', $cardNumber, $cardYearExp, $cardMonthExp);
        $map = new RequestMap();
        $map->set("payment_transfer.transfer_reference", $transferRef);
        $map->set("payment_transfer.payment_type", "P2P");
        $map->set("payment_transfer.funding_source[0]", 'CREDIT');
        $map->set("payment_transfer.funding_source[1]", 'DEBIT');
        $map->set("payment_transfer.amount", $amount);
        $map->set("payment_transfer.currency", "USD");
        $map->set("payment_transfer.sender_account_uri", $senderPanUri);
        $map->set("payment_transfer.sender.first_name", $firstName);
        $map->set("payment_transfer.sender.last_name", $lastName);
        $map->set("payment_transfer.sender.nationality", "USA");
        $map->set("payment_transfer.sender.address.line1", $address1);
        if ($address2) {
            $map->set("payment_transfer.sender.address.line2", $address2);
        }
        $map->set("payment_transfer.sender.address.city", $city);
        $map->set("payment_transfer.sender.address.country_subdivision", $state);
        $map->set("payment_transfer.sender.address.postal_code", $zipcode);
        $map->set("payment_transfer.sender.address.country", "USA");
        $map->set("payment_transfer.recipient_account_uri", sprintf('acct-ref:%s', $acctRef));
        $map->set("payment_transfer.recipient.first_name", $userFirstName);
        $map->set("payment_transfer.recipient.last_name", $userLastName);
        $map->set("payment_transfer.payment_origination_country", "USA");
        $map->set("payment_transfer.sanction_screening_override", " false ");
        $map->set("payment_transfer.statement_descriptor", "P2P*PERFPAY");
        $map->set("payment_transfer.channel", "KIOSK");
        $map->set("payment_transfer.text", "funding_source");
        $map->set("partnerId", "ptnr_2370-10D6-ED32-C98E");
        $this->map = $map;
        // Make payment API call
        try {
            return PaymentTransfer::create($map);
        } catch (\Exception $ex) {
            Log::error('Error in payment transfer.', ['e' => $ex]);
        }
    }

}