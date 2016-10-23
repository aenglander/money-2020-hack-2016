<?php
/**
 * Created by IntelliJ IDEA.
 * User: josh
 * Date: 10/22/16
 * Time: 4:15 PM
 */

namespace App\Services;

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

    /**
     * @var BaseObject
     */
    private $response;

    public function __construct($consumerKey, $keyAlias, $keyPassword, $privateKey)
    {
        ApiConfig::setAuthentication(new OAuthAuthentication($consumerKey, $privateKey, $keyAlias, $keyPassword));
        ApiConfig::setDebug(true);
        ApiConfig::setSandbox(true);   // For production: use ApiConfig::setSandbox(false)
    }


    public function makePayment(
        $firstName,
        $lastName,
        $amount,
        $cardNumber,
        $cardYearExp,
        $cardMonthExp,
        $fundingSource)
    {
        $transferRef = 'PP'.mt_rand(1000000,99999999999);
        $senderPanUri = sprintf('pan:%d;exp=%d-%d', $cardNumber, $cardYearExp, $cardMonthExp);
        $map = new RequestMap();
        $map->set("payment_transfer.transfer_reference", $transferRef);
        $map->set("payment_transfer.payment_type", "P2P");
        $map->set("payment_transfer.funding_source[0]", $fundingSource);
//        $map->set("payment_transfer.funding_source[1]", "DEBIT");
        $map->set("payment_transfer.amount", $amount);
        $map->set("payment_transfer.currency", "USD");
        $map->set("payment_transfer.sender_account_uri", $senderPanUri);
        $map->set("payment_transfer.sender.first_name", "John");
//        $map->set("payment_transfer.sender.middle_name", "Tyler");
        $map->set("payment_transfer.sender.last_name", "Jones");
        $map->set("payment_transfer.sender.nationality", "USA");
//        $map->set("payment_transfer.sender.date_of_birth", "1994-05-21");
        $map->set("payment_transfer.sender.address.line1", "21 Broadway");
        $map->set("payment_transfer.sender.address.line2", "Apartment A-6");
        $map->set("payment_transfer.sender.address.city", "OFallon");
        $map->set("payment_transfer.sender.address.country_subdivision", "MO");
        $map->set("payment_transfer.sender.address.postal_code", "63368");
        $map->set("payment_transfer.sender.address.country", "USA");
        $map->set("payment_transfer.sender.phone", "11234565555");
        $map->set("payment_transfer.sender.email", "John.Jones123@abcmail.com");
        $map->set("payment_transfer.recipient_account_uri", "acct-ref:ref_acct_01538931851233324970");
        $map->set("payment_transfer.recipient.first_name", "Jane");
        $map->set("payment_transfer.recipient.middle_name", "Tyler");
        $map->set("payment_transfer.recipient.last_name", "Smith");
        $map->set("payment_transfer.recipient.nationality", "USA");
        $map->set("payment_transfer.recipient.date_of_birth", "1999-12-30");
        $map->set("payment_transfer.recipient.address.line1", "1 Main St");
        $map->set("payment_transfer.recipient.address.line2", "Apartment 9");
        $map->set("payment_transfer.recipient.address.city", "OFallon");
        $map->set("payment_transfer.recipient.address.country_subdivision", "MO");
        $map->set("payment_transfer.recipient.address.postal_code", "63368");
        $map->set("payment_transfer.recipient.address.country", "USA");
        $map->set("payment_transfer.recipient.phone", "11234567890");
        $map->set("payment_transfer.recipient.email", "Jane.Smith123@abcmail.com");
        $map->set("payment_transfer.payment_origination_country", "USA");
        $map->set("payment_transfer.sanction_screening_override", " false ");
        $map->set("payment_transfer.statement_descriptor", "P2P*PERFPAY");
        $map->set("payment_transfer.channel", "KIOSK");
        $map->set("payment_transfer.text", "funding_source");
        $map->set("partnerId", "ptnr_2370-10D6-ED32-C98E");
        $this->map = $map;
        // Make payment API call
        $this->response = PaymentTransfer::create($map);
    }

    public function getPaymentResponse()
    {
        return $this->response;
    }


}