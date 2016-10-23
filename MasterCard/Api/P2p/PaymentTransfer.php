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

 use MasterCard\Core\Model\BaseObject;
 use MasterCard\Core\Model\RequestMap;
 use MasterCard\Core\Model\OperationMetadata;
 use MasterCard\Core\Model\OperationConfig;


/**
 * 
 */
class PaymentTransfer extends BaseObject {


    protected static function getOperationConfig($operationUUID) {
        switch ($operationUUID) {
            case "ed37fe30-64fd-4dc7-8309-6a4165b0ac83":
                return new OperationConfig("/send/v1/partners/{partnerId}/transfers", "query", array("ref"), array());
            case "beafb5f0-8d07-4aba-be90-caa87ed8c544":
                return new OperationConfig("/send/v1/partners/{partnerId}/transfers/payment", "create", array(), array());
            case "fa81abfa-4988-49d4-a0a1-a1adb31535e8":
                return new OperationConfig("/send/v1/partners/{partnerId}/transfers/{transferId}", "read", array(), array());
            
            default:
                throw new \Exception("Invalid operationUUID supplied: $operationUUID");
        }
    }

    protected static function getOperationMetadata() {
        return new OperationMetadata(SDKConfig::getVersion(), SDKConfig::getHost());
    }







    /**
     * Query objects of type PaymentTransfer by id and optional criteria
     * @param type $criteria
     * @return type
     */
    public static function readByReference($criteria)
    {
        return self::execute("ed37fe30-64fd-4dc7-8309-6a4165b0ac83",new PaymentTransfer($criteria));
    }
   /**
    * Creates object of type PaymentTransfer
    *
    * @param Map map, containing the required parameters to create a new object
    * @return PaymentTransfer of the response of created instance.
    */
    public static function create($map)
    {
        return self::execute("beafb5f0-8d07-4aba-be90-caa87ed8c544", new PaymentTransfer($map));
    }









    /**
     * Returns objects of type PaymentTransfer by id and optional criteria
     * @param type $id
     * @param type $criteria
     * @return type
     */
    public static function readByID($id, $criteria = null)
    {
        $map = new RequestMap();
        if (!empty($id)) {
            $map->set("id", $id);
        }
        if ($criteria != null) {
            $map->setAll($criteria);
        }
        return self::execute("fa81abfa-4988-49d4-a0a1-a1adb31535e8",new PaymentTransfer($map));
    }



}

