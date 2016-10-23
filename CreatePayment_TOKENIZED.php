<?php
//namespace MasterCard\Api\P2p;

//import the php autoloader
require_once './vendor/autoload.php';

use MasterCard\Core\Model\RequestMap;
use MasterCard\Core\ApiConfig;
use MasterCard\Core\Security\OAuth\OAuthAuthentication;
use MasterCard\Api\P2p\PaymentTransfer;


$consumerKey = "4FZDE2qryKsPPqA1NwXbbBku3bNHhHZrpZLowyMP6b729703!f435de5c8fe3425aacf9d3b1912611ca0000000000000000";   // You should copy this from "My Keys" on your project page e.g. UTfbhDCSeNYvJpLL5l028sWL9it739PYh6LU5lZja15xcRpY!fd209e6c579dc9d7be52da93d35ae6b6c167c174690b72fa
$keyAlias = "hackathonalias";   // For production: change this to the key alias you chose when you created your production key
$keyPassword = "hackathon@123";   // For production: change this to the key alias you chose when you created your production key
$privateKey = file_get_contents('/Users/josh/Downloads/'."hackathonalias_sandbox.p12"); // e.g. /Users/yourname/project/sandbox.p12 | C:\Users\yourname\project\sandbox.p12
ApiConfig::setAuthentication(new OAuthAuthentication($consumerKey, $privateKey, $keyAlias, $keyPassword));
ApiConfig::setDebug(true);
ApiConfig::setSandbox(true);   // For production: use ApiConfig::setSandbox(false)

$map = new RequestMap();
$map->set("payment_transfer.transfer_reference", "789dfgs789dfg89".mt_rand(1,1000000));
$map->set("payment_transfer.payment_type", "P2P");
$map->set("payment_transfer.funding_source[0]", "CREDIT");
$map->set("payment_transfer.funding_source[1]", "DEBIT");
$map->set("payment_transfer.amount", "4");
$map->set("payment_transfer.currency", "USD");
$map->set("payment_transfer.sender_account_uri", "pan:5102589999999939;exp=2017-08");
$map->set("payment_transfer.sender.first_name", "John");
$map->set("payment_transfer.sender.middle_name", "Tyler");
$map->set("payment_transfer.sender.last_name", "Jones");
$map->set("payment_transfer.sender.nationality", "USA");
$map->set("payment_transfer.sender.date_of_birth", "1994-05-21");
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
//$map->set("payment_transfer.reconciliation_data.custom_field[0].name", "ABC");
//$map->set("payment_transfer.reconciliation_data.custom_field[0].value", "123");
//$map->set("payment_transfer.reconciliation_data.custom_field[1].name", "DEF");
//$map->set("payment_transfer.reconciliation_data.custom_field[1].value", "456");
//$map->set("payment_transfer.reconciliation_data.custom_field[2].name", "GHI");
//$map->set("payment_transfer.reconciliation_data.custom_field[2].value", "789");
$map->set("payment_transfer.statement_descriptor", "P2P*PERFPAY");
$map->set("payment_transfer.channel", "KIOSK");
$map->set("payment_transfer.text", "funding_source");
$map->set("partnerId", "ptnr_2370-10D6-ED32-C98E");
$response = PaymentTransfer::create($map);
echo "transfer.id-->{$response->get("transfer.id")}\n"; //transfer.id-->trn_4MMUC7147Vamd1IVt77DV0d-mIZr
echo "transfer.resource_type-->{$response->get("transfer.resource_type")}\n"; //transfer.resource_type-->transfer
echo "transfer.transfer_reference-->{$response->get("transfer.transfer_reference")}\n"; //transfer.transfer_reference-->40023991848254111813006
echo "transfer.payment_type-->{$response->get("transfer.payment_type")}\n"; //transfer.payment_type-->P2P
echo "transfer.sender_account_uri-->{$response->get("transfer.sender_account_uri")}\n"; //transfer.sender_account_uri-->acct-ref:ref_20160407070850915
echo "transfer.sender.first_name-->{$response->get("transfer.sender.first_name")}\n"; //transfer.sender.first_name-->John
echo "transfer.sender.middle_name-->{$response->get("transfer.sender.middle_name")}\n"; //transfer.sender.middle_name-->Tyler
echo "transfer.sender.last_name-->{$response->get("transfer.sender.last_name")}\n"; //transfer.sender.last_name-->Jones
echo "transfer.sender.nationality-->{$response->get("transfer.sender.nationality")}\n"; //transfer.sender.nationality-->USA
echo "transfer.sender.date_of_birth-->{$response->get("transfer.sender.date_of_birth")}\n"; //transfer.sender.date_of_birth-->1994-05-21
echo "transfer.sender.address.line1-->{$response->get("transfer.sender.address.line1")}\n"; //transfer.sender.address.line1-->21 Broadway
echo "transfer.sender.address.line2-->{$response->get("transfer.sender.address.line2")}\n"; //transfer.sender.address.line2-->Apartment A-6
echo "transfer.sender.address.city-->{$response->get("transfer.sender.address.city")}\n"; //transfer.sender.address.city-->OFallon
echo "transfer.sender.address.country_subdivision-->{$response->get("transfer.sender.address.country_subdivision")}\n"; //transfer.sender.address.country_subdivision-->MO
echo "transfer.sender.address.postal_code-->{$response->get("transfer.sender.address.postal_code")}\n"; //transfer.sender.address.postal_code-->63368
echo "transfer.sender.address.country-->{$response->get("transfer.sender.address.country")}\n"; //transfer.sender.address.country-->USA
echo "transfer.sender.phone-->{$response->get("transfer.sender.phone")}\n"; //transfer.sender.phone-->11234565555
echo "transfer.sender.email-->{$response->get("transfer.sender.email")}\n"; //transfer.sender.email-->John.Jones123@abcmail.com
echo "transfer.recipient_account_uri-->{$response->get("transfer.recipient_account_uri")}\n"; //transfer.recipient_account_uri-->pan:************0018
echo "transfer.recipient.first_name-->{$response->get("transfer.recipient.first_name")}\n"; //transfer.recipient.first_name-->Jane
echo "transfer.recipient.middle_name-->{$response->get("transfer.recipient.middle_name")}\n"; //transfer.recipient.middle_name-->Tyler
echo "transfer.recipient.last_name-->{$response->get("transfer.recipient.last_name")}\n"; //transfer.recipient.last_name-->Smith
echo "transfer.recipient.nationality-->{$response->get("transfer.recipient.nationality")}\n"; //transfer.recipient.nationality-->USA
echo "transfer.recipient.date_of_birth-->{$response->get("transfer.recipient.date_of_birth")}\n"; //transfer.recipient.date_of_birth-->1999-12-30
echo "transfer.recipient.address.line1-->{$response->get("transfer.recipient.address.line1")}\n"; //transfer.recipient.address.line1-->1 Main St
echo "transfer.recipient.address.line2-->{$response->get("transfer.recipient.address.line2")}\n"; //transfer.recipient.address.line2-->Apartment 9
echo "transfer.recipient.address.city-->{$response->get("transfer.recipient.address.city")}\n"; //transfer.recipient.address.city-->OFallon
echo "transfer.recipient.address.country_subdivision-->{$response->get("transfer.recipient.address.country_subdivision")}\n"; //transfer.recipient.address.country_subdivision-->MO
echo "transfer.recipient.address.postal_code-->{$response->get("transfer.recipient.address.postal_code")}\n"; //transfer.recipient.address.postal_code-->63368
echo "transfer.recipient.address.country-->{$response->get("transfer.recipient.address.country")}\n"; //transfer.recipient.address.country-->USA
echo "transfer.recipient.phone-->{$response->get("transfer.recipient.phone")}\n"; //transfer.recipient.phone-->11234567890
echo "transfer.recipient.email-->{$response->get("transfer.recipient.email")}\n"; //transfer.recipient.email-->Jane.Smith123@abcmail.com
echo "transfer.transfer_amount.value-->{$response->get("transfer.transfer_amount.value")}\n"; //transfer.transfer_amount.value-->1800
echo "transfer.transfer_amount.currency-->{$response->get("transfer.transfer_amount.currency")}\n"; //transfer.transfer_amount.currency-->USD
echo "transfer.created-->{$response->get("transfer.created")}\n"; //transfer.created-->2016-08-29T01:11:02-05:00
echo "transfer.transaction_history.resource_type-->{$response->get("transfer.transaction_history.resource_type")}\n"; //transfer.transaction_history.resource_type-->list
echo "transfer.transaction_history.item_count-->{$response->get("transfer.transaction_history.item_count")}\n"; //transfer.transaction_history.item_count-->1
echo "transfer.transaction_history.data.transaction.id-->{$response->get("transfer.transaction_history.data.transaction.id")}\n"; //transfer.transaction_history.data.transaction.id-->txn_S7hjCOKzzkSzeCTS7g-Fdq0_drCD
echo "transfer.transaction_history.data.transaction.resource_type-->{$response->get("transfer.transaction_history.data.transaction.resource_type")}\n"; //transfer.transaction_history.data.transaction.resource_type-->transaction
echo "transfer.transaction_history.data.transaction.account_uri-->{$response->get("transfer.transaction_history.data.transaction.account_uri")}\n"; //transfer.transaction_history.data.transaction.account_uri-->pan:************0018
echo "transfer.transaction_history.data.transaction.transaction_amount.value-->{$response->get("transfer.transaction_history.data.transaction.transaction_amount.value")}\n"; //transfer.transaction_history.data.transaction.transaction_amount.value-->1800
echo "transfer.transaction_history.data.transaction.transaction_amount.currency-->{$response->get("transfer.transaction_history.data.transaction.transaction_amount.currency")}\n"; //transfer.transaction_history.data.transaction.transaction_amount.currency-->USD
echo "transfer.transaction_history.data.transaction.network-->{$response->get("transfer.transaction_history.data.transaction.network")}\n"; //transfer.transaction_history.data.transaction.network-->STAR
echo "transfer.transaction_history.data.transaction.funds_availability-->{$response->get("transfer.transaction_history.data.transaction.funds_availability")}\n"; //transfer.transaction_history.data.transaction.funds_availability-->IMMEDIATE
echo "transfer.transaction_history.data.transaction.type-->{$response->get("transfer.transaction_history.data.transaction.type")}\n"; //transfer.transaction_history.data.transaction.type-->PAYMENT
echo "transfer.transaction_history.data.transaction.create_timestamp-->{$response->get("transfer.transaction_history.data.transaction.create_timestamp")}\n"; //transfer.transaction_history.data.transaction.create_timestamp-->2016-08-29T01:11:02-05:00
echo "transfer.transaction_history.data.transaction.status-->{$response->get("transfer.transaction_history.data.transaction.status")}\n"; //transfer.transaction_history.data.transaction.status-->APPROVED
echo "transfer.transaction_history.data.transaction.status_reason-->{$response->get("transfer.transaction_history.data.transaction.status_reason")}\n"; //transfer.transaction_history.data.transaction.status_reason-->APPROVED
echo "transfer.transaction_history.data.transaction.status_timestamp-->{$response->get("transfer.transaction_history.data.transaction.status_timestamp")}\n"; //transfer.transaction_history.data.transaction.status_timestamp-->2016-08-29T01:11:02-05:00
echo "transfer.transaction_history.data.transaction.retrieval_reference-->{$response->get("transfer.transaction_history.data.transaction.retrieval_reference")}\n"; //transfer.transaction_history.data.transaction.retrieval_reference-->624200192616
echo "transfer.transaction_history.data.transaction.system_trace_audit_number-->{$response->get("transfer.transaction_history.data.transaction.system_trace_audit_number")}\n"; //transfer.transaction_history.data.transaction.system_trace_audit_number-->926162
//echo "transfer.reconciliation_data.custom_field[0].name-->{$response->get("transfer.reconciliation_data.custom_field[0].name")}\n"; //transfer.reconciliation_data.custom_field[0].name-->ABC
//echo "transfer.reconciliation_data.custom_field[0].value-->{$response->get("transfer.reconciliation_data.custom_field[0].value")}\n"; //transfer.reconciliation_data.custom_field[0].value-->123
//echo "transfer.reconciliation_data.custom_field[1].name-->{$response->get("transfer.reconciliation_data.custom_field[1].name")}\n"; //transfer.reconciliation_data.custom_field[1].name-->DEF
//echo "transfer.reconciliation_data.custom_field[1].value-->{$response->get("transfer.reconciliation_data.custom_field[1].value")}\n"; //transfer.reconciliation_data.custom_field[1].value-->456
//echo "transfer.reconciliation_data.custom_field[2].name-->{$response->get("transfer.reconciliation_data.custom_field[2].name")}\n"; //transfer.reconciliation_data.custom_field[2].name-->GHI
//echo "transfer.reconciliation_data.custom_field[2].value-->{$response->get("transfer.reconciliation_data.custom_field[2].value")}\n"; //transfer.reconciliation_data.custom_field[2].value-->789
echo "transfer.statement_descriptor-->{$response->get("transfer.statement_descriptor")}\n"; //transfer.statement_descriptor-->TST*THANKYOU
echo "transfer.channel-->{$response->get("transfer.channel")}\n"; //transfer.channel-->KIOSK
echo "transfer.status-->{$response->get("transfer.status")}\n"; //transfer.status-->APPROVED
echo "transfer.status_timestamp-->{$response->get("transfer.status_timestamp")}\n"; //transfer.status_timestamp-->2016-08-29T01:11:02-05:00

// This sample shows looping through transfer.reconciliation_data.custom_field
$list = $response->get("transfer.reconciliation_data.custom_field");
for($i = 0; $i < sizeof($list); $i++) {
    print("index: $i");
    print("name: [ {$list[$i]["name"]} ]");
    print("value: [ {$list[$i]["value"]} ]");
    
}

