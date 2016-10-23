<?php
/*
 * Copyright 2016 MasterCard International.
 *
 * Redistribution and use in source and binary forms, with or without modification, are 
 * permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list of 
 * conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * Neither the name of the MasterCard International Incorporated nor the names of its 
 * contributors may be used to endorse or promote products derived from this software 
 * without specific prior written permission.
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES 
 * OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT 
 * SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, 
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
 * TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; 
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER 
 * IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING 
 * IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF 
 * SUCH DAMAGE.
 *
 */

namespace MasterCard\Api\P2p;

use MasterCard\Core\Model\RequestMap;
use MasterCard\Core\ApiConfig;
use MasterCard\Core\Security\OAuth\OAuthAuthentication;
use Test\BaseTest;



class AllTest extends BaseTest {

    public static $responses = array();

    protected function setUp() {
        parent::setUp();
        ApiConfig::setDebug(true);
        ApiConfig::setSandbox(true);
        BaseTest::resetAuthentication();
    }

    
    
    
                

        public function test_8001_RetrieveAccountInfoWithEligibleAccountInformation()
        {
            

            

            $map = new RequestMap();
            $map->set ("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set ("fields", "metadata");
            $map->set ("account_info.account_uri", "pan:5102589999999905;exp=2017-08;cvc=123");
            $map->set ("account_info.amount", "1000");
            $map->set ("account_info.currency", "USD");
            $map->set ("account_info.payment_type", "BDB");
            
            
            $request = new AccountInfo($map);
            $response = $request->read();

            $ignoreAssert = array();
            $ignoreAssert[] = "account_info.funds_availability";
            $ignoreAssert[] = "account_info.institution_name";
            
            $this->customAssertEqual($ignoreAssert, $response, "account_info.sending_eligibility.eligible", "true");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.receiving_eligibility.eligible", "true");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.type", "DEBIT");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.brand", "MasterCard");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.funds_availability", "IMMEDIATE");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.product_type", "Consumer");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.institution_name", "ABC Bank ");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.institution_country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.account_statement_currency", "USD");
            

            self::putResponse("RetrieveAccountInfoWithEligibleAccountInformation", $response);
            
        }
        
    
    
    
    
    
    
    
    
                

        public function test_8002_RetrieveAccountInfoWithIneligibleAccountInformation()
        {
            

            

            $map = new RequestMap();
            $map->set ("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set ("fields", "metadata");
            $map->set ("account_info.account_uri", "pan:5432123456789012;exp=2017-02;cvc=123");
            $map->set ("account_info.amount", "1000");
            $map->set ("account_info.currency", "USD");
            $map->set ("account_info.payment_type", "BDB");
            
            
            $request = new AccountInfo($map);
            $response = $request->read();

            $ignoreAssert = array();
            $ignoreAssert[] = "account_info.receiving_eligibility";
            $ignoreAssert[] = "account_info.receiving_eligibility.eligible";
            
            $this->customAssertEqual($ignoreAssert, $response, "account_info.sending_eligibility.eligible", "false");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.sending_eligibility.reason_code", "ACCOUNT_NOT_ELIGIBLE");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.sending_eligibility.reason_description", "Account not eligible");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.receiving_eligibility.eligible", "false");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.receiving_eligibility.reason_code", "ACCOUNT_NOT_ELIGIBLE");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.receiving_eligibility.reason_description", "Account not eligible");
            $this->customAssertEqual($ignoreAssert, $response, "account_info.brand", "MasterCard");
            

            self::putResponse("RetrieveAccountInfoWithIneligibleAccountInformation", $response);
            
        }
        
    
    
    
    
    
    
    
                
        public function test_10001_RetrieveAccountStatusWithNonTokenizedRequest()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("account_verification_input.account_verification_reference", "100016560");
            $map->set("account_verification_input.first_name", "Dicky");
            $map->set("account_verification_input.last_name", "Bird");
            $map->set("account_verification_input.account_uri", "pan:5102589999999798;exp=2095-12;cvc=234");
            $map->set("account_verification_input.address.line1", "1 Main Street");
            $map->set("account_verification_input.address.line2", "Appartment 11");
            $map->set("account_verification_input.address.city", "HAGEN");
            $map->set("account_verification_input.address.country_subdivision", "MT");
            $map->set("account_verification_input.address.postal_code", "63368-3784");
            $map->set("account_verification_input.address.country", "USA");
            
            
            $response = AccountVerification::read($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "account_verification.request_id";
            
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.request_id", "rqst_C6A5-C986-AC0D-1ADB");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.resource_type", "account_verification");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.address_status", "NOT_MATCHED");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.postal_code_status", "MATCHED");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.cvc_status", "MATCHED");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.avs_response_code", "W");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.avs_response_desc", "For U.S. addresses, nine-digit postal code matches, address does not; for address outside the U.S., postal code matches, address does not.");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.cvc_resp_code", "M");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.cvc_resp_desc", "CVC2/CSC match");
            

            self::putResponse("RetrieveAccountStatusWithNonTokenizedRequest", $response);
            
        }
        
    
    
    
    
    
    
    
    
                
        public function test_19001_RegisterConsumer()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumer.consumer_reference", "ref_338666315804127291");
            $map->set("consumer.first_name", "Jane");
            $map->set("consumer.middle_name", "Tyler");
            $map->set("consumer.last_name", "Smith");
            $map->set("consumer.nationality", "USA");
            $map->set("consumer.date_of_birth", "1999-12-30");
            $map->set("consumer.address.line1", "1 Main Street");
            $map->set("consumer.address.line2", "Apartment 9");
            $map->set("consumer.address.city", "OFallon");
            $map->set("consumer.address.country_subdivision", "MO");
            $map->set("consumer.address.postal_code", "63368");
            $map->set("consumer.address.country", "USA");
            $map->set("consumer.primary_phone", "11234567890");
            $map->set("consumer.primary_email", "Jane.Smith123@abcmail.com");
            $map->set("consumer.account.default_sending", "true");
            $map->set("consumer.account.default_receiving", "true");
            $map->set("consumer.account.account_reference", "ref_195680973339507100");
            $map->set("consumer.account.label", "JaneMC");
            $map->set("consumer.account.account_uri", "pan:5432123456789012;exp=2017-02;cvc=123");
            $map->set("consumer.account.name_on_account", "Jane Tyler Smith");
            $map->set("consumer.account.address.line1", "1 Main St");
            $map->set("consumer.account.address.line2", "Apartment 9");
            $map->set("consumer.account.address.city", "OFallon");
            $map->set("consumer.account.address.country_subdivision", "MO");
            $map->set("consumer.account.address.postal_code", "63368");
            $map->set("consumer.account.address.country", "USA");
            
            
            $response = Consumer::create($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "consumer.id";
            $ignoreAssert[] = "consumer.preferences.default_accounts.sending";
            $ignoreAssert[] = "consumer.preferences.default_accounts.receiving";
            
            $this->customAssertEqual($ignoreAssert, $response, "consumer.id", "cns_f21tg68mh89c376h");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.resource_type", "consumer");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.consumer_reference", "ref_338666315804127291");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.line1", "1 Main Street");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.primary_phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.primary_email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.preferences.default_accounts.sending", "acct_mk32k324mg6wn19x");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.preferences.default_accounts.receiving", "acct_mk32k324mg6wn19x");
            

            self::putResponse("RegisterConsumer", $response);
            
        }
        
    
    
    
    
    
    
    
    
    
    
    
    
                

        public function test_20001_RetrieveConsumer()
        {
            

            

            $id = "";

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            

            $response = Consumer::readByID($id,$map);

            $ignoreAssert = array();
            $ignoreAssert[] = "consumer.id";
            $ignoreAssert[] = "consumer.consumer_reference";
            $ignoreAssert[] = "consumer.preferences.default_accounts.sending";
            $ignoreAssert[] = "consumer.preferences.default_accounts.receiving";
            
            $this->customAssertEqual($ignoreAssert, $response, "consumer.id", "cns_f21tg68mh89c376h");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.resource_type", "consumer");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.consumer_reference", "AB123456");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.line1", "1 Main Street");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.primary_phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.primary_email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.preferences.default_accounts.sending", "acct_mk32k324mg6wn19x");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.preferences.default_accounts.receiving", "acct_mk32k324mg6wn19x");
            

            self::putResponse("RetrieveConsumer", $response);
            
        }
        
    
    
    
    
                
        public function test_20040_AddConsumerContactId()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            $map->set("contact_id.contact_id_uri", "tel:79294458731");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            
            $response = ConsumerContactID::create($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "contact_id.id";
            $ignoreAssert[] = "contact_id.contact_id_uri";
            
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.id", "cntc_3747dskr4hrfjjd");
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.resource_type", "contact_id");
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.contact_id_uri", "tel:79294458731");
            

            self::putResponse("AddConsumerContactId", $response);
            
        }
        
    
    
    
    
    
    
    
    
    
    
    
    
    
                

        public function test_21001_SearchConsumer_ConsumerReference()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("ref", "ref_20160823192231787");
            
            $map->set("ref", self::resolveResponseValue("RegisterConsumer.consumer.consumer_reference"));
            
            $response = Consumer::listByReferenceOrContactID($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "consumers.data.consumer.id";
            $ignoreAssert[] = "consumers.data.consumer.consumer_reference";
            $ignoreAssert[] = "consumers.data.consumer.preferences.default_accounts.sending";
            $ignoreAssert[] = "consumers.data.consumer.preferences.default_accounts.receiving";
            
            $this->customAssertEqual($ignoreAssert, $response, "consumers.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.id", "cns_f21tg68mh89c376h");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.resource_type", "consumer");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.consumer_reference", "AB123456");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.line1", "1 Main Street");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.primary_phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.primary_email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.preferences.default_accounts.sending", "acct_mk32k324mg6wn19x");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.preferences.default_accounts.receiving", "acct_mk32k324mg6wn19x");
            

            self::putResponse("SearchConsumer_ConsumerReference", $response);
            
        }
        
    
    
    
    
    
    
    
    
                

        public function test_21002_SearchConsumer_Contact_ID_URI()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("contact_id_uri", "tel:12125556649");
            
            $map->set("contact_id_uri", self::resolveResponseValue("AddConsumerContactId.contact_id.contact_id_uri"));
            
            $response = Consumer::listByReferenceOrContactID($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "consumers.data.consumer.id";
            $ignoreAssert[] = "consumers.data.consumer.consumer_reference";
            $ignoreAssert[] = "consumers.data.consumer.preferences.default_accounts.sending";
            $ignoreAssert[] = "consumers.data.consumer.preferences.default_accounts.receiving";
            $ignoreAssert[] = "consumers.item_count";
            
            $this->customAssertEqual($ignoreAssert, $response, "consumers.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.id", "cns_f21tg68mh89c376h");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.resource_type", "consumer");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.consumer_reference", "AB123456");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.line1", "1 Main Street");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.primary_phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.primary_email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.preferences.default_accounts.sending", "acct_mk32k324mg6wn19x");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.preferences.default_accounts.receiving", "acct_mk32k324mg6wn19x");
            

            self::putResponse("SearchConsumer_Contact_ID_URI", $response);
            
        }
        
    
    
    
                
        public function test_22001_SearchConsumers_ConsumerReference()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumer.search_by", "consumer_reference");
            $map->set("consumer.search_value", "ref_20160823193804233");
            
            $map->set("consumer.search_value", self::resolveResponseValue("RegisterConsumer.consumer.consumer_reference"));
            
            $response = Consumer::listByReferenceContactIDOrGovernmentID($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "consumers.data.consumer.id";
            $ignoreAssert[] = "consumers.data.consumer.consumer_reference";
            $ignoreAssert[] = "consumers.data.consumer.preferences.default_accounts.sending";
            $ignoreAssert[] = "consumers.data.consumer.preferences.default_accounts.receiving";
            
            $this->customAssertEqual($ignoreAssert, $response, "consumers.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.id", "cns_f21tg68mh89c376h");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.resource_type", "consumer");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.consumer_reference", "AB123456");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.line1", "1 Main Street");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.primary_phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.primary_email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.preferences.default_accounts.sending", "acct_mk32k324mg6wn19x");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.preferences.default_accounts.receiving", "acct_mk32k324mg6wn19x");
            

            self::putResponse("SearchConsumers_ConsumerReference", $response);
            
        }
        
    
    
    
    
    
    
    
    
                
        public function test_22002_SearchConsumers_Contact_ID_URI()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumer.search_by", "contact_id_uri");
            $map->set("consumer.search_value", "tel:12125556649");
            
            $map->set("consumer.search_value", self::resolveResponseValue("AddConsumerContactId.contact_id.contact_id_uri"));
            
            $response = Consumer::listByReferenceContactIDOrGovernmentID($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "consumers.data.consumer.id";
            $ignoreAssert[] = "consumers.data.consumer.consumer_reference";
            $ignoreAssert[] = "consumers.data.consumer.preferences.default_accounts.sending";
            $ignoreAssert[] = "consumers.data.consumer.preferences.default_accounts.receiving";
            
            $this->customAssertEqual($ignoreAssert, $response, "consumers.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.id", "cns_f21tg68mh89c376h");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.resource_type", "consumer");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.consumer_reference", "AB123456");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.line1", "1 Main Street");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.primary_phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.primary_email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.preferences.default_accounts.sending", "acct_mk32k324mg6wn19x");
            $this->customAssertEqual($ignoreAssert, $response, "consumers.data.consumer.preferences.default_accounts.receiving", "acct_mk32k324mg6wn19x");
            

            self::putResponse("SearchConsumers_Contact_ID_URI", $response);
            
        }
        
    
    
    
    
    
    
    
    
                
        public function test_25002_AddConsumerAccountForDisb()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            $map->set("account.account_reference", "ref_25279556183591980");
            $map->set("account.label", "JaneMC");
            $map->set("account.account_uri", "pan:5013040000000018;exp=2017-05;cvc=123");
            $map->set("account.name_on_account", "Jane Tyler Smith");
            $map->set("account.address.line1", "1 Main St");
            $map->set("account.address.line2", "Apartment 9");
            $map->set("account.address.city", "OFallon");
            $map->set("account.address.country_subdivision", "MO");
            $map->set("account.address.postal_code", "63368");
            $map->set("account.address.country", "USA");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            
            $response = ConsumerAccount::create($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "account.id";
            $ignoreAssert[] = "account.account_reference";
            $ignoreAssert[] = "account.account_uri";
            
            $this->customAssertEqual($ignoreAssert, $response, "account.id", "acct_mk32k324mg6wn19x");
            $this->customAssertEqual($ignoreAssert, $response, "account.resource_type", "account");
            $this->customAssertEqual($ignoreAssert, $response, "account.account_reference", "ref_25279556183591980");
            $this->customAssertEqual($ignoreAssert, $response, "account.label", "JaneMC");
            $this->customAssertEqual($ignoreAssert, $response, "account.account_uri", "pan:************9012");
            $this->customAssertEqual($ignoreAssert, $response, "account.brand", "MasterCard");
            $this->customAssertEqual($ignoreAssert, $response, "account.name_on_account", "Jane Tyler Smith");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.country", "USA");
            

            self::putResponse("AddConsumerAccountForDisb", $response);
            
        }
        
    
    
    
    
    
    
    
    
                
        public function test_30001_AddConsumerAccount()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            $map->set("account.account_reference", "ref_338666315804127291");
            $map->set("account.label", "JaneMC");
            $map->set("account.account_uri", "pan:5432123456789012;exp=2017-02;cvc=123");
            $map->set("account.name_on_account", "Jane Tyler Smith");
            $map->set("account.address.line1", "1 Main St");
            $map->set("account.address.line2", "Apartment 9");
            $map->set("account.address.city", "OFallon");
            $map->set("account.address.country_subdivision", "MO");
            $map->set("account.address.postal_code", "63368");
            $map->set("account.address.country", "USA");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            
            $response = ConsumerAccount::create($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "account.id";
            $ignoreAssert[] = "account.account_reference";
            $ignoreAssert[] = "account.account_uri";
            
            $this->customAssertEqual($ignoreAssert, $response, "account.id", "acct_mk32k324mg6wn19x");
            $this->customAssertEqual($ignoreAssert, $response, "account.resource_type", "account");
            $this->customAssertEqual($ignoreAssert, $response, "account.account_reference", "ref_338666315804127291");
            $this->customAssertEqual($ignoreAssert, $response, "account.label", "JaneMC");
            $this->customAssertEqual($ignoreAssert, $response, "account.account_uri", "pan:************9012");
            $this->customAssertEqual($ignoreAssert, $response, "account.brand", "MasterCard");
            $this->customAssertEqual($ignoreAssert, $response, "account.name_on_account", "Jane Tyler Smith");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.country", "USA");
            

            self::putResponse("AddConsumerAccount", $response);
            
        }
        
    
    
    
    
    
    
    
    
                
        public function test_30002_RetrieveAccountStatusWithTokenizedRequest()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("account_verification_input.account_verification_reference", "100021119");
            $map->set("account_verification_input.account_uri", "acct-ref:ref_01917852970663931");
            
            $map->set("account_verification_input.account_uri", "acct-ref:".self::resolveResponseValue("AddConsumerAccountForDisb.account.account_reference"));
            
            $response = AccountVerification::read($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "account_verification.request_id";
            
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.request_id", "rqst_7718-84A6-9888-DF87");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.resource_type", "account_verification");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.address_status", "NOT_MATCHED");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.postal_code_status", "MATCHED");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.cvc_status", "NOT_VERIFIED");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.avs_response_code", "Z");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.avs_response_desc", "For U.S. addresses, five-digit postal code matches, address does not.");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.cvc_resp_code", "P");
            $this->customAssertEqual($ignoreAssert, $response, "account_verification.cvc_resp_desc", "Not processed");
            

            self::putResponse("RetrieveAccountStatusWithTokenizedRequest", $response);
            
        }
        
    
    
    
    
    
    
    
    
    
    
    
    
                

        public function test_31001_RetrieveConsumerAccount()
        {
            

            

            $id = "";

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            $map->set("accountId", "acct_mk32k324mg6wn19x");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            $map->set("accountId", self::resolveResponseValue("AddConsumerAccount.account.id"));
            

            $response = ConsumerAccount::readByID($id,$map);

            $ignoreAssert = array();
            $ignoreAssert[] = "account.id";
            $ignoreAssert[] = "account.account_reference";
            $ignoreAssert[] = "account.account_uri";
            
            $this->customAssertEqual($ignoreAssert, $response, "account.id", "acct_mk32k324mg6wn19x");
            $this->customAssertEqual($ignoreAssert, $response, "account.resource_type", "account");
            $this->customAssertEqual($ignoreAssert, $response, "account.account_reference", "AB123456");
            $this->customAssertEqual($ignoreAssert, $response, "account.label", "JaneMC");
            $this->customAssertEqual($ignoreAssert, $response, "account.account_uri", "pan:************9012");
            $this->customAssertEqual($ignoreAssert, $response, "account.brand", "MasterCard");
            $this->customAssertEqual($ignoreAssert, $response, "account.name_on_account", "Jane Tyler Smith");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.country", "USA");
            

            self::putResponse("RetrieveConsumerAccount", $response);
            
        }
        
    
    
    
    
    
    
    
    
    
                

        public function test_32001_RetrieveConsumerAccounts()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            $map->set("ref", "ref_20160823193804233");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            $map->set("ref", self::resolveResponseValue("AddConsumerAccount.account.account_reference"));
            
            $response = ConsumerAccount::listAll($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "accounts.data.account.id";
            $ignoreAssert[] = "accounts.data.account.account_reference";
            $ignoreAssert[] = "accounts.data.account.account_uri";
            
            $this->customAssertEqual($ignoreAssert, $response, "accounts.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.id", "acct_mk32k324mg6wn19x");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.resource_type", "account");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.account_reference", "AB123456");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.label", "JaneMC");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.account_uri", "pan:************9012");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.brand", "MasterCard");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.name_on_account", "Jane Tyler Smith");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "accounts.data.account.address.country", "USA");
            

            self::putResponse("RetrieveConsumerAccounts", $response);
            
        }
        
    
    
    
                
        public function test_32141_CreatePayment_NON_TOKENIZED()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("payment_transfer.transfer_reference", "40016797309979199877285");
            $map->set("payment_transfer.payment_type", "P2P");
            $map->set("payment_transfer.funding_source[0]", "CREDIT");
            $map->set("payment_transfer.funding_source[1]", "DEBIT");
            $map->set("payment_transfer.amount", "1800");
            $map->set("payment_transfer.currency", "USD");
            $map->set("payment_transfer.sender_account_uri", "pan:5013040000000018;exp=2017-08;cvc=123");
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
            $map->set("payment_transfer.sender.government_ids.government_id_uri", "ppn:123456789;expiration-date=2019-05-27;issue-date=2011-07-12;issuing-country=USA;issuing-place=OFallon");
            $map->set("payment_transfer.recipient_account_uri", "pan:5013040000000018;exp=2017-08;cvc=123");
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
            $map->set("payment_transfer.recipient.email", "John.Jones123@abcmail.com");
            $map->set("payment_transfer.recipient.government_ids.government_id_uri", "ppn:123456789;expiration-date=2019-05-27;issue-date=2011-07-12;issuing-country=USA;issuing-place=OFallon");
            $map->set("payment_transfer.payment_origination_country", "USA");
            $map->set("payment_transfer.sanction_screening_override", " false ");
            $map->set("payment_transfer.reconciliation_data.custom_field[0].name", "ABC");
            $map->set("payment_transfer.reconciliation_data.custom_field[0].value", "123");
            $map->set("payment_transfer.reconciliation_data.custom_field[1].name", "DEF");
            $map->set("payment_transfer.reconciliation_data.custom_field[1].value", "456");
            $map->set("payment_transfer.reconciliation_data.custom_field[2].name", "GHI");
            $map->set("payment_transfer.reconciliation_data.custom_field[2].value", "789");
            $map->set("payment_transfer.statement_descriptor", "TST*THANKYOU");
            $map->set("payment_transfer.channel", "KIOSK");
            $map->set("payment_transfer.text", "funding_source");
            
            $map->set("payment_transfer.statement_descriptor", self::resolveResponseValue("val:CLA*THANK YOU"));
            
            $response = PaymentTransfer::create($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "payment_transfer.transfer_reference";
            $ignoreAssert[] = "payment_transfer.amount";
            $ignoreAssert[] = "payment_transfer.currency";
            $ignoreAssert[] = "transfer.statement_descriptor";
            $ignoreAssert[] = "transfer.id";
            $ignoreAssert[] = "payment_transfer.transfer_reference";
            $ignoreAssert[] = "payment_transfer.amount";
            $ignoreAssert[] = "payment_transfer.currency";
            $ignoreAssert[] = "payment_transfer.statement_descriptor";
            $ignoreAssert[] = "transfer.created";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.id";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.create_timestamp";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.status_timestamp";
            $ignoreAssert[] = "transfer.status_timestamp";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.retrieval_reference";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.system_trace_audit_number";
            $ignoreAssert[] = "transfer.sender.email";
            $ignoreAssert[] = "transfer.recipient.email";
            $ignoreAssert[] = "payment_transfer.recipient.government_ids";
            $ignoreAssert[] = "payment_transfer.sender.government_ids";
            $ignoreAssert[] = "payment_transfer.sender.government_ids.government_id_uri";
            
            $this->customAssertEqual($ignoreAssert, $response, "transfer.id", "trn_MQTGry0D_TGe8QTrWj4LtaydUUWM");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.resource_type", "transfer");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_reference", "40016797309979199877285");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.payment_type", "P2P");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender_account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.first_name", "John");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.last_name", "Jones");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.date_of_birth", "1994-05-21");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.line1", "21 Broadway");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.line2", "Apartment A-6");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.phone", "11234565555");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.email", "John.Jones123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient_account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.email", "John.Jones123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.created", "2016-08-29T01:07:37-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.id", "txn_SVDvtQk1mKcJefExHKpvVeLctXvJ");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.resource_type", "transaction");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.transaction_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.transaction_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.network", "STAR");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.funds_availability", "IMMEDIATE");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.type", "PAYMENT");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.create_timestamp", "2016-08-29T01:07:37-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status_reason", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status_timestamp", "2016-08-29T01:07:37-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.retrieval_reference", "624200192616");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.system_trace_audit_number", "926162");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[0].name", "ABC");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[0].value", "123");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[1].name", "DEF");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[1].value", "456");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[2].name", "GHI");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[2].value", "789");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.statement_descriptor", "TST*THANKYOU");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.channel", "KIOSK");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.status_timestamp", "2016-08-29T01:07:37-05:00");
            

            self::putResponse("CreatePayment_NON_TOKENIZED", $response);
            
        }
        
    
    
    
    
    
    
    
    
                
        public function test_32142_CreatePayment_TOKENIZED()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("payment_transfer.transfer_reference", "40026797309979199877285");
            $map->set("payment_transfer.payment_type", "P2P");
            $map->set("payment_transfer.funding_source[0]", "CREDIT");
            $map->set("payment_transfer.funding_source[1]", "DEBIT");
            $map->set("payment_transfer.amount", "1800");
            $map->set("payment_transfer.currency", "USD");
            $map->set("payment_transfer.sender_account_uri", "acct-ref:ref_20160407070850915");
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
            $map->set("payment_transfer.recipient_account_uri", "pan:5013040000000018;exp=2017-08;cvc=123");
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
            $map->set("payment_transfer.reconciliation_data.custom_field[0].name", "ABC");
            $map->set("payment_transfer.reconciliation_data.custom_field[0].value", "123");
            $map->set("payment_transfer.reconciliation_data.custom_field[1].name", "DEF");
            $map->set("payment_transfer.reconciliation_data.custom_field[1].value", "456");
            $map->set("payment_transfer.reconciliation_data.custom_field[2].name", "GHI");
            $map->set("payment_transfer.reconciliation_data.custom_field[2].value", "789");
            $map->set("payment_transfer.statement_descriptor", "TST*THANKYOU");
            $map->set("payment_transfer.channel", "KIOSK");
            $map->set("payment_transfer.text", "funding_source");
            
            $map->set("payment_transfer.sender_account_uri", "acct-ref:".self::resolveResponseValue("AddConsumerAccount.account.account_reference"));
            $map->set("payment_transfer.statement_descriptor", self::resolveResponseValue("val:CLA*THANK YOU"));
            
            $response = PaymentTransfer::create($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "transfer.id";
            $ignoreAssert[] = "transfer.created";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.id";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.create_timestamp";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.status_timestamp";
            $ignoreAssert[] = "transfer.status_timestamp";
            $ignoreAssert[] = "transfer.sender.email";
            $ignoreAssert[] = "transfer.recipient.email";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.retrieval_reference";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.system_trace_audit_number";
            $ignoreAssert[] = "transfer.sender_account_uri";
            $ignoreAssert[] = "payment_transfer.recipient.government_ids";
            $ignoreAssert[] = "payment_transfer.sender.government_ids";
            $ignoreAssert[] = "payment_transfer.sender.government_ids.government_id_uri";
            $ignoreAssert[] = "transfer.statement_descriptor";
            
            $this->customAssertEqual($ignoreAssert, $response, "transfer.id", "trn_4MMUC7147Vamd1IVt77DV0d-mIZr");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.resource_type", "transfer");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_reference", "40026797309979199877285");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.payment_type", "P2P");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender_account_uri", "acct-ref:ref_20160407070850915");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.first_name", "John");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.last_name", "Jones");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.date_of_birth", "1994-05-21");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.line1", "21 Broadway");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.line2", "Apartment A-6");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.phone", "11234565555");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.email", "John.Jones123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient_account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.created", "2016-08-29T01:11:02-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.id", "txn_S7hjCOKzzkSzeCTS7g-Fdq0_drCD");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.resource_type", "transaction");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.transaction_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.transaction_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.network", "STAR");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.funds_availability", "IMMEDIATE");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.type", "PAYMENT");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.create_timestamp", "2016-08-29T01:11:02-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status_reason", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status_timestamp", "2016-08-29T01:11:02-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.retrieval_reference", "624200192616");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.system_trace_audit_number", "926162");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[0].name", "ABC");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[0].value", "123");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[1].name", "DEF");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[1].value", "456");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[2].name", "GHI");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[2].value", "789");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.statement_descriptor", "TST*THANKYOU");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.channel", "KIOSK");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.status_timestamp", "2016-08-29T01:11:02-05:00");
            

            self::putResponse("CreatePayment_TOKENIZED", $response);
            
        }
        
    
    
    
    
    
    
    
    
    
    
    
    
                

        public function test_32151_GetTransferById_NON_TOKENIZED()
        {
            

            

            $id = "";

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("transferId", "trn_MQTGry0D_TGe8QTrWj4LtaydUUWM");
            
            $map->set("transferId", self::resolveResponseValue("CreatePayment_NON_TOKENIZED.transfer.id"));
            

            $response = PaymentTransfer::readByID($id,$map);

            $ignoreAssert = array();
            $ignoreAssert[] = "transfer.transfer_reference";
            $ignoreAssert[] = "transfer.id";
            $ignoreAssert[] = "transfer.created";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.id";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.create_timestamp";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.status_timestamp";
            $ignoreAssert[] = "transfer.status_timestamp";
            $ignoreAssert[] = "transfer.sender.email";
            $ignoreAssert[] = "transfer.recipient.email";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.retrieval_reference";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.system_trace_audit_number";
            $ignoreAssert[] = "transfer.statement_descriptor";
            
            $this->customAssertEqual($ignoreAssert, $response, "transfer.id", "trn_MQTGry0D_TGe8QTrWj4LtaydUUWM");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.resource_type", "transfer");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_reference", "TRNREF_20160829130404970");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.payment_type", "P2P");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender_account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.first_name", "John");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.last_name", "Jones");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.date_of_birth", "1994-05-21");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.line1", "21 Broadway");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.line2", "Apartment A-6");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.phone", "11234565555");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.email", "John.Jones123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.payment_origination_country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient_account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.created", "2016-08-29T08:07:37.282-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.id", "txn_SVDvtQk1mKcJefExHKpvVeLctXvJ");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.resource_type", "transaction");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.transaction_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.transaction_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.network", "STAR");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.network_status_code", "00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.network_status_description", "Approved or completed successfully");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.funds_availability", "IMMEDIATE");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.type", "PAYMENT");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.create_timestamp", "2016-08-29T08:07:37.288-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status_reason", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status_timestamp", "2016-08-29T01:07:37-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.retrieval_reference", "624200192616");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.system_trace_audit_number", "926162");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[0].name", "ABC");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[0].value", "123");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[1].name", "DEF");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[1].value", "456");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[2].name", "GHI");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[2].value", "789");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.statement_descriptor", "TST*THANKYOU");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.channel", "KIOSK");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.status_timestamp", "2016-08-29T08:07:37.374-05:00");
            

            self::putResponse("GetTransferById_NON_TOKENIZED", $response);
            
        }
        
    
    
    
    
    
    
    
    
                

        public function test_32152_GetTransferById_TOKENIZED()
        {
            

            

            $id = "";

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("transferId", "trn_4MMUC7147Vamd1IVt77DV0d-mIZr");
            
            $map->set("transferId", self::resolveResponseValue("CreatePayment_TOKENIZED.transfer.id"));
            

            $response = PaymentTransfer::readByID($id,$map);

            $ignoreAssert = array();
            $ignoreAssert[] = "transfer.transfer_reference";
            $ignoreAssert[] = "transfer.id";
            $ignoreAssert[] = "transfer.created";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.id";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.create_timestamp";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.status_timestamp";
            $ignoreAssert[] = "transfer.status_timestamp";
            $ignoreAssert[] = "transfer.sender.email";
            $ignoreAssert[] = "transfer.recipient.email";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.retrieval_reference";
            $ignoreAssert[] = "transfer.transaction_history.data.transaction.system_trace_audit_number";
            $ignoreAssert[] = "transfer.sender_account_uri";
            $ignoreAssert[] = "transfer.statement_descriptor";
            
            $this->customAssertEqual($ignoreAssert, $response, "transfer.id", "trn_4MMUC7147Vamd1IVt77DV0d-mIZr");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.resource_type", "transfer");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_reference", "TRNREF_20160829130737009");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.payment_type", "P2P");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender_account_uri", "acct-ref:ref_20160407070850915");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.first_name", "John");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.last_name", "Jones");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.date_of_birth", "1994-05-21");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.line1", "21 Broadway");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.line2", "Apartment A-6");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.phone", "11234565555");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.sender.email", "John.Jones123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient_account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.recipient.email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transfer_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.created", "2016-08-29T08:11:02.799-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.id", "txn_S7hjCOKzzkSzeCTS7g-Fdq0_drCD");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.resource_type", "transaction");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.transaction_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.transaction_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.network", "STAR");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.network_status_code", "00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.network_status_description", "Approved or completed successfully");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.funds_availability", "IMMEDIATE");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.type", "PAYMENT");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.create_timestamp", "2016-08-29T08:11:02.805-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status_reason", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.status_timestamp", "2016-08-29T01:11:02-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.retrieval_reference", "624200192616");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.transaction_history.data.transaction.system_trace_audit_number", "926162");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[0].name", "ABC");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[0].value", "123");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[1].name", "DEF");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[1].value", "456");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[2].name", "GHI");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.reconciliation_data.custom_field[2].value", "789");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.statement_descriptor", "TST*THANKYOU");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.channel", "KIOSK");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfer.status_timestamp", "2016-08-29T08:11:02.895-05:00");
            

            self::putResponse("GetTransferById_TOKENIZED", $response);
            
        }
        
    
    
    
    
    
    
    
    
    
                

        public function test_32161_GetTransferByRef_NON_TOKENIZED()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("ref", "TRNREF_20160829130404970");
            
            $map->set("ref", self::resolveResponseValue("CreatePayment_NON_TOKENIZED.transfer.transfer_reference"));
            
            $response = PaymentTransfer::readByReference($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "transfers.data.transfer.transfer_reference";
            $ignoreAssert[] = "transfers.data.transfer.id";
            $ignoreAssert[] = "transfers.data.transfer.created";
            $ignoreAssert[] = "transfers.data.transfer.transaction_history.data.transaction.id";
            $ignoreAssert[] = "transfers.data.transfer.transaction_history.data.transaction.create_timestamp";
            $ignoreAssert[] = "transfers.data.transfer.transaction_history.data.transaction.status_timestamp";
            $ignoreAssert[] = "transfers.data.transfer.status_timestamp";
            $ignoreAssert[] = "transfers.data.transfer.sender.email";
            $ignoreAssert[] = "transfers.data.transfer.recipient.email";
            $ignoreAssert[] = "transfers.data.transfer.transaction_history.data.transaction.retrieval_reference";
            $ignoreAssert[] = "transfers.data.transfer.transaction_history.data.transaction.system_trace_audit_number";
            $ignoreAssert[] = "transfers.data.transfer.statement_descriptor";
            
            $this->customAssertEqual($ignoreAssert, $response, "transfers.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.id", "trn_MQTGry0D_TGe8QTrWj4LtaydUUWM");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.resource_type", "transfer");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transfer_reference", "TRNREF_20160829130404970");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.payment_type", "P2P");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender_account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.first_name", "John");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.last_name", "Jones");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.date_of_birth", "1994-05-21");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.line1", "21 Broadway");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.line2", "Apartment A-6");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.phone", "11234565555");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.email", "John.Jones123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient_account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transfer_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transfer_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.created", "2016-08-29T08:07:37.282-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.id", "txn_SVDvtQk1mKcJefExHKpvVeLctXvJ");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.resource_type", "transaction");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.transaction_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.transaction_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.network", "STAR");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.network_status_code", "00");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.network_status_description", "Approved or completed successfully");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.funds_availability", "IMMEDIATE");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.type", "PAYMENT");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.create_timestamp", "2016-08-29T08:07:37.288-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.status_reason", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.status_timestamp", "2016-08-29T01:07:37-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.retrieval_reference", "624200192616");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.system_trace_audit_number", "926162");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[0].name", "ABC");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[0].value", "123");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[1].name", "DEF");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[1].value", "456");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[2].name", "GHI");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[2].value", "789");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.statement_descriptor", "TST*THANKYOU");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.channel", "KIOSK");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.status_timestamp", "2016-08-29T08:07:37.374-05:00");
            

            self::putResponse("GetTransferByRef_NON_TOKENIZED", $response);
            
        }
        
    
    
    
    
    
    
    
    
                

        public function test_32162_GetTransferByRef_TOKENIZED()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("ref", "TRNREF_20160829130737009");
            
            $map->set("ref", self::resolveResponseValue("CreatePayment_TOKENIZED.transfer.transfer_reference"));
            
            $response = PaymentTransfer::readByReference($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "transfers.data.transfer.transfer_reference";
            $ignoreAssert[] = "transfers.data.transfer.id";
            $ignoreAssert[] = "transfers.data.transfer.created";
            $ignoreAssert[] = "transfers.data.transfer.transaction_history.data.transaction.id";
            $ignoreAssert[] = "transfers.data.transfer.transaction_history.data.transaction.create_timestamp";
            $ignoreAssert[] = "transfers.data.transfer.transaction_history.data.transaction.status_timestamp";
            $ignoreAssert[] = "transfers.data.transfer.status_timestamp";
            $ignoreAssert[] = "transfers.data.transfer.sender.email";
            $ignoreAssert[] = "transfers.data.transfer.recipient.email";
            $ignoreAssert[] = "transfers.data.transfer.transaction_history.data.transaction.retrieval_reference";
            $ignoreAssert[] = "transfers.data.transfer.transaction_history.data.transaction.system_trace_audit_number";
            $ignoreAssert[] = "transfers.data.transfer.sender_account_uri";
            $ignoreAssert[] = "transfers.data.transfer.statement_descriptor";
            
            $this->customAssertEqual($ignoreAssert, $response, "transfers.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.id", "trn_4MMUC7147Vamd1IVt77DV0d-mIZr");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.resource_type", "transfer");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transfer_reference", "TRNREF_20160829130737009");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.payment_type", "P2P");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender_account_uri", "acct-ref:ref_20160407070850915");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.first_name", "John");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.last_name", "Jones");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.date_of_birth", "1994-05-21");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.line1", "21 Broadway");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.line2", "Apartment A-6");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.phone", "11234565555");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.sender.email", "John.Jones123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient_account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.recipient.email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transfer_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transfer_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.created", "2016-08-29T08:11:02.799-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.item_count", "1");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.id", "txn_S7hjCOKzzkSzeCTS7g-Fdq0_drCD");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.resource_type", "transaction");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.account_uri", "pan:************0018");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.transaction_amount.value", "1800");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.transaction_amount.currency", "USD");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.network", "STAR");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.network_status_code", "00");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.network_status_description", "Approved or completed successfully");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.funds_availability", "IMMEDIATE");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.type", "PAYMENT");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.create_timestamp", "2016-08-29T08:11:02.805-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.status_reason", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.status_timestamp", "2016-08-29T01:11:02-05:00");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.retrieval_reference", "624200192616");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.transaction_history.data.transaction.system_trace_audit_number", "926162");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[0].name", "ABC");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[0].value", "123");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[1].name", "DEF");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[1].value", "456");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[2].name", "GHI");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.reconciliation_data.custom_field[2].value", "789");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.statement_descriptor", "TST*THANKYOU");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.channel", "KIOSK");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.status", "APPROVED");
            $this->customAssertEqual($ignoreAssert, $response, "transfers.data.transfer.status_timestamp", "2016-08-29T08:11:02.895-05:00");
            

            self::putResponse("GetTransferByRef_TOKENIZED", $response);
            
        }
        
    
    
    
    
                

        public function test_33003_SanctionScreening_NonTokenized()
        {
            

            

            $map = new RequestMap();
            $map->set ("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set ("sanction_screening_input.screening_reference", "ABC_33003629721840586943");
            $map->set ("sanction_screening_input.consumer.first_name", "John");
            $map->set ("sanction_screening_input.consumer.middle_name", "M");
            $map->set ("sanction_screening_input.consumer.last_name", "Jones");
            $map->set ("sanction_screening_input.consumer.date_of_birth", "1990-01-01");
            $map->set ("sanction_screening_input.consumer.address.line1", "Mastercard Blvd");
            $map->set ("sanction_screening_input.consumer.address.line2", "Suite 240");
            $map->set ("sanction_screening_input.consumer.address.city", "ofallon");
            $map->set ("sanction_screening_input.consumer.address.state", "MO");
            $map->set ("sanction_screening_input.consumer.address.country", "USA");
            
            
            $request = new SanctionScreening($map);
            $response = $request->read();

            $ignoreAssert = array();
            $ignoreAssert[] = "sanction_screening.id";
            $ignoreAssert[] = "sanction_screening.score";
            
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.id", "rqst_8A49-4DCB-8965-780B");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.resource_type", "sanction_screening");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.screening_reference", "ABC_33003629721840586943");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.status", "SUCCESS");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.score", "50");
            

            self::putResponse("SanctionScreening_NonTokenized", $response);
            
        }
        
    
    
    
    
    
    
    
    
                

        public function test_33004_SanctionScreeningBy_Tokenized_ConsumerId()
        {
            

            

            $map = new RequestMap();
            $map->set ("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set ("sanction_screening_input.screening_reference", "ABC_33004629721840586943");
            $map->set ("sanction_screening_input.consumer_id", "cns_kiKj6mgInaCIE4OdVGLOY0eY3eu5");
            
            
            $request = new SanctionScreening($map);
            $response = $request->read();

            $ignoreAssert = array();
            $ignoreAssert[] = "sanction_screening.id";
            $ignoreAssert[] = "sanction_screening.score";
            
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.id", "rqst_8A49-4DCB-8965-780B");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.resource_type", "sanction_screening");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.screening_reference", "ABC_33004629721840586943");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.status", "SUCCESS");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.score", "50");
            

            self::putResponse("SanctionScreeningBy_Tokenized_ConsumerId", $response);
            
        }
        
    
    
    
    
    
    
    
    
                

        public function test_33005_SanctionScreening_Tokenized_ConsumerReference()
        {
            

            

            $map = new RequestMap();
            $map->set ("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set ("sanction_screening_input.screening_reference", "ABC_33005629721840586943");
            $map->set ("sanction_screening_input.consumer_reference", "AB123456");
            
            
            $request = new SanctionScreening($map);
            $response = $request->read();

            $ignoreAssert = array();
            $ignoreAssert[] = "sanction_screening.id";
            $ignoreAssert[] = "sanction_screening.score";
            
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.id", "rqst_8A49-4DCB-8965-780B");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.resource_type", "sanction_screening");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.screening_reference", "ABC_33005629721840586943");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.status", "SUCCESS");
            $this->customAssertEqual($ignoreAssert, $response, "sanction_screening.score", "50");
            

            self::putResponse("SanctionScreening_Tokenized_ConsumerReference", $response);
            
        }
        
    
    
    
    
    
    
    
    
    
    
    
                

        public function test_41001_RetrieveConsumerContactId()
        {
            

            

            $id = "";

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            $map->set("contactId", "cntc_KHfVnuC9WAtO10aiL-DJWt6MTAz");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            $map->set("contactId", self::resolveResponseValue("AddConsumerContactId.contact_id.id"));
            

            $response = ConsumerContactID::read($id,$map);

            $ignoreAssert = array();
            $ignoreAssert[] = "contact_id.id";
            $ignoreAssert[] = "contact_id.contact_id_uri";
            
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.id", "cntc_3747dskr4hrfjjd");
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.resource_type", "contact_id");
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.contact_id_uri", "tel:12125559175");
            

            self::putResponse("RetrieveConsumerContactId", $response);
            
        }
        
    
    
    
    
    
    
    
    
    
                

        public function test_42001_RetrieveConsumerContacts()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            
            $response = ConsumerContactID::listAll($map);

            $ignoreAssert = array();
            $ignoreAssert[] = "contacts.item_count";
            $ignoreAssert[] = "contacts.data.contact_id[0].id";
            $ignoreAssert[] = "contacts.data.contact_id[0].contact_id_uri";
            $ignoreAssert[] = "contacts.data.contact_id[1].id";
            $ignoreAssert[] = "contacts.data.contact_id[1].contact_id_uri";
            $ignoreAssert[] = "contacts.data.contact_id[2].id";
            $ignoreAssert[] = "contacts.data.contact_id[2].contact_id_uri";
            
            $this->customAssertEqual($ignoreAssert, $response, "contacts.resource_type", "list");
            $this->customAssertEqual($ignoreAssert, $response, "contacts.item_count", "3");
            $this->customAssertEqual($ignoreAssert, $response, "contacts.data.contact_id[0].id", "cntc_HeVzmQRSWeaxiLcIH637BsprGLj");
            $this->customAssertEqual($ignoreAssert, $response, "contacts.data.contact_id[0].resource_type", "contact_id");
            $this->customAssertEqual($ignoreAssert, $response, "contacts.data.contact_id[0].contact_id_uri", "email:Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "contacts.data.contact_id[1].id", "cntc_VkVIk_-tb6G1AuVmdcQuX_o61ga");
            $this->customAssertEqual($ignoreAssert, $response, "contacts.data.contact_id[1].resource_type", "contact_id");
            $this->customAssertEqual($ignoreAssert, $response, "contacts.data.contact_id[1].contact_id_uri", "tel:11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "contacts.data.contact_id[2].id", "cntc_Dy-ajJKtCoq2N1l2IqK4jx4WPAR");
            $this->customAssertEqual($ignoreAssert, $response, "contacts.data.contact_id[2].resource_type", "contact_id");
            $this->customAssertEqual($ignoreAssert, $response, "contacts.data.contact_id[2].contact_id_uri", "tel:8491378015");
            

            self::putResponse("RetrieveConsumerContacts", $response);
            
        }
        
    
    
    
    
                

        public function test_50033_UpdateConsumerAccount()
        {
            

            

            $map = new RequestMap();
            $map->set ("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set ("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            $map->set ("accountId", "acct_mk32k324mg6wn19x");
            $map->set ("account.label", "JaneMC");
            $map->set ("account.account_uri", "pan:5432123456789012;exp=2017-02;cvc=123");
            $map->set ("account.name_on_account", "Jane Tyler Smith");
            $map->set ("account.address.line1", "1 Main St");
            $map->set ("account.address.line2", "Apartment 9");
            $map->set ("account.address.city", "OFallon");
            $map->set ("account.address.country_subdivision", "MO");
            $map->set ("account.address.postal_code", "63368");
            $map->set ("account.address.country", "USA");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            $map->set("accountId", self::resolveResponseValue("AddConsumerAccount.account.id"));
            
            $request = new ConsumerAccount($map);
            $response = $request->update();

            $ignoreAssert = array();
            $ignoreAssert[] = "account.id";
            $ignoreAssert[] = "account.account_uri";
            $ignoreAssert[] = "account.account_reference";
            
            $this->customAssertEqual($ignoreAssert, $response, "account.id", "acct_Iqg1s2JGFhul9YRqAdQmY8lTiAG");
            $this->customAssertEqual($ignoreAssert, $response, "account.resource_type", "account");
            $this->customAssertEqual($ignoreAssert, $response, "account.account_reference", "ref_25738849186162645");
            $this->customAssertEqual($ignoreAssert, $response, "account.label", "JaneMC");
            $this->customAssertEqual($ignoreAssert, $response, "account.account_uri", "pan:************9012");
            $this->customAssertEqual($ignoreAssert, $response, "account.brand", "MasterCard");
            $this->customAssertEqual($ignoreAssert, $response, "account.name_on_account", "Jane Tyler Smith");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.country", "USA");
            

            self::putResponse("UpdateConsumerAccount", $response);
            
        }
        
    
    
    
    
    
    
    
    
                

        public function test_50043_UpdateConsumerContactId()
        {
            

            

            $map = new RequestMap();
            $map->set ("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set ("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            $map->set ("contactId", "cntc_KHfVnuC9WAtO10aiL-DJWt6MTAz");
            $map->set ("contact_id.contact_id_uri", "tel:12125559175");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            $map->set("contactId", self::resolveResponseValue("AddConsumerContactId.contact_id.id"));
            
            $request = new ConsumerContactID($map);
            $response = $request->update();

            $ignoreAssert = array();
            $ignoreAssert[] = "contact_id.id";
            $ignoreAssert[] = "contact_id.contact_id_uri";
            
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.id", "cntc_3747dskr4hrfjjd");
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.resource_type", "contact_id");
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.contact_id_uri", "tel:12125559175");
            

            self::putResponse("UpdateConsumerContactId", $response);
            
        }
        
    
    
    
    
    
    
    
    
    
    
                

        public function test_50134_DeleteConsumerAccount()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            $map->set("accountId", "acct_mk32k324mg6wn19x");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            $map->set("accountId", self::resolveResponseValue("AddConsumerAccount.account.id"));
            
            $response = ConsumerAccount::deleteById("", $map);
            $this->assertNotNull($response);

            $ignoreAssert = array();
            $ignoreAssert[] = "account.id";
            $ignoreAssert[] = "account.account_uri";
            $ignoreAssert[] = "account.account_reference";
            
            $this->customAssertEqual($ignoreAssert, $response, "account.id", "acct_mk32k324mg6wn19x");
            $this->customAssertEqual($ignoreAssert, $response, "account.resource_type", "account");
            $this->customAssertEqual($ignoreAssert, $response, "account.account_reference", "AB123456");
            $this->customAssertEqual($ignoreAssert, $response, "account.label", "JaneMC");
            $this->customAssertEqual($ignoreAssert, $response, "account.account_uri", "pan:************9012");
            $this->customAssertEqual($ignoreAssert, $response, "account.brand", "MasterCard");
            $this->customAssertEqual($ignoreAssert, $response, "account.name_on_account", "Jane Tyler Smith");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "account.address.country", "USA");
            

            self::putResponse("DeleteConsumerAccount", $response);
            
        }
        

    
    
    
    
    
    
    
    
                

        public function test_50144_DeleteConsumerContactId()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            $map->set("contactId", "cntc_KHfVnuC9WAtO10aiL-DJWt6MTAz");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            $map->set("contactId", self::resolveResponseValue("AddConsumerContactId.contact_id.id"));
            
            $response = ConsumerContactID::deleteById("", $map);
            $this->assertNotNull($response);

            $ignoreAssert = array();
            $ignoreAssert[] = "contact_id.id";
            $ignoreAssert[] = "contact_id.contact_id_uri";
            
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.id", "cntc_3747dskr4hrfjjd");
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.resource_type", "contact_id");
            $this->customAssertEqual($ignoreAssert, $response, "contact_id.contact_id_uri", "tel:12125559175");
            

            self::putResponse("DeleteConsumerContactId", $response);
            
        }
        

    
    
    
    
    
    
                

        public function test_60023_UpdateConsumer()
        {
            

            

            $map = new RequestMap();
            $map->set ("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set ("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            $map->set ("consumer.first_name", "Jane");
            $map->set ("consumer.middle_name", "Tyler");
            $map->set ("consumer.last_name", "Smith");
            $map->set ("consumer.nationality", "USA");
            $map->set ("consumer.date_of_birth", "1999-12-30");
            $map->set ("consumer.address.line1", "1 Main St");
            $map->set ("consumer.address.line2", "Apartment 9");
            $map->set ("consumer.address.city", "OFallon");
            $map->set ("consumer.address.country_subdivision", "MO");
            $map->set ("consumer.address.postal_code", "63368");
            $map->set ("consumer.address.country", "USA");
            $map->set ("consumer.primary_phone", "11234567890");
            $map->set ("consumer.primary_email", "Jane.Smith123@abcmail.com");
            $map->set ("consumer.preferences.default_accounts.receiving", "acct_mk32k324mg6wn19x");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            $map->set("consumer.preferences.default_accounts.receiving", self::resolveResponseValue("RegisterConsumer.consumer.preferences.default_accounts.receiving"));
            
            $request = new Consumer($map);
            $response = $request->update();

            $ignoreAssert = array();
            $ignoreAssert[] = "consumer.id";
            $ignoreAssert[] = "consumer.preferences.default_accounts.sending";
            $ignoreAssert[] = "consumer.preferences.default_accounts.receiving";
            $ignoreAssert[] = "consumer.consumer_reference";
            
            $this->customAssertEqual($ignoreAssert, $response, "consumer.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.primary_phone", "11234567890");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.primary_email", "Jane.Smith123@abcmail.com");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.preferences.default_accounts.receiving", "acct_H3tGYN9Mif22Wi7wGxBcaVxmwjY");
            

            self::putResponse("UpdateConsumer", $response);
            
        }
        
    
    
    
    
    
    
    
    
    
    
                

        public function test_60024_DeleteConsumer()
        {
            

            

            $map = new RequestMap();
            $map->set("partnerId", "ptnr_BEeCrYJHh2BXTXPy_PEtp-8DBOo");
            $map->set("consumerId", "cns_6psmQAn0Xg0_MovLrEEPg3Kv4QWi");
            
            $map->set("consumerId", self::resolveResponseValue("RegisterConsumer.consumer.id"));
            
            $response = Consumer::deleteById("", $map);
            $this->assertNotNull($response);

            $ignoreAssert = array();
            $ignoreAssert[] = "consumer.id";
            $ignoreAssert[] = "consumer.preferences.default_accounts.sending";
            $ignoreAssert[] = "consumer.preferences.default_accounts.receiving";
            $ignoreAssert[] = "consumer.consumer_reference";
            
            $this->customAssertEqual($ignoreAssert, $response, "consumer.internalRequest", "false");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.id", "cns_0YcrEgG-sK0b6tWzG-1lM4ioMm9O");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.resource_type", "consumer");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.consumer_reference", "ref_257639634904596144");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.first_name", "Jane");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.middle_name", "Tyler");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.last_name", "Smith");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.nationality", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.date_of_birth", "1999-12-30");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.line1", "1 Main St");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.line2", "Apartment 9");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.city", "OFallon");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.country_subdivision", "MO");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.postal_code", "63368");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.address.country", "USA");
            $this->customAssertEqual($ignoreAssert, $response, "consumer.preferences.default_accounts.receiving", "acct_Ef-RjVN3N7c-Qmw6FKaFLPcJFGs");
            

            self::putResponse("DeleteConsumer", $response);
            
        }
        

    
    
    
    
}



