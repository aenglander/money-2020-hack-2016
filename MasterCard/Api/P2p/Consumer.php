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
class Consumer extends BaseObject {


    protected static function getOperationConfig($operationUUID) {
        switch ($operationUUID) {
            case "95af690d-9e73-49a4-b132-dca7db4449a6":
                return new OperationConfig("/send/v1/partners/{partnerId}/consumers", "query", array("ref","contact_id_uri"), array());
            case "b9fcb4b5-1f83-40dd-bc8b-98bc49c3eaa1":
                return new OperationConfig("/send/v1/partners/{partnerId}/consumers", "create", array(), array());
            case "b56bf091-12f5-4fdc-b1d8-773a78086695":
                return new OperationConfig("/send/v1/partners/{partnerId}/consumers/search", "create", array(), array());
            case "e0071460-2d7f-4abf-8343-20e020d507a1":
                return new OperationConfig("/send/v1/partners/{partnerId}/consumers/{consumerId}", "read", array(), array());
            case "b32eff97-5b59-45cd-ba7f-860d4c4c48a6":
                return new OperationConfig("/send/v1/partners/{partnerId}/consumers/{consumerId}", "update", array(), array());
            case "8dfad812-49ab-4961-ae2f-7791a2f8867f":
                return new OperationConfig("/send/v1/partners/{partnerId}/consumers/{consumerId}", "delete", array(), array());
            
            default:
                throw new \Exception("Invalid operationUUID supplied: $operationUUID");
        }
    }

    protected static function getOperationMetadata() {
        return new OperationMetadata(SDKConfig::getVersion(), SDKConfig::getHost());
    }







    /**
     * Query objects of type Consumer by id and optional criteria
     * @param type $criteria
     * @return type
     */
    public static function listByReferenceOrContactID($criteria)
    {
        return self::execute("95af690d-9e73-49a4-b132-dca7db4449a6",new Consumer($criteria));
    }
   /**
    * Creates object of type Consumer
    *
    * @param Map map, containing the required parameters to create a new object
    * @return Consumer of the response of created instance.
    */
    public static function create($map)
    {
        return self::execute("b9fcb4b5-1f83-40dd-bc8b-98bc49c3eaa1", new Consumer($map));
    }





   /**
    * Creates object of type Consumer
    *
    * @param Map map, containing the required parameters to create a new object
    * @return Consumer of the response of created instance.
    */
    public static function listByReferenceContactIDOrGovernmentID($map)
    {
        return self::execute("b56bf091-12f5-4fdc-b1d8-773a78086695", new Consumer($map));
    }









    /**
     * Returns objects of type Consumer by id and optional criteria
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
        return self::execute("e0071460-2d7f-4abf-8343-20e020d507a1",new Consumer($map));
    }


   /**
    * Updates an object of type Consumer
    *
    * @return A Consumer object representing the response.
    */
    public function update()  {
        return self::execute("b32eff97-5b59-45cd-ba7f-860d4c4c48a6",$this);
    }







   /**
    * Delete object of type Consumer by id
    *
    * @param String id
    * @return Consumer of the response of the deleted instance.
    */
    public static function deleteById($id, $requestMap = null)
    {
        $map = new RequestMap();
        if (!empty($id)) {
            $map->set("id", $id);
        }
        if (!empty($requestMap)) {
            $map->setAll($requestMap);
        }
        return self::execute("8dfad812-49ab-4961-ae2f-7791a2f8867f", new Consumer($map));
    }

   /**
    * Delete this object of type Consumer
    *
    * @return Consumer of the response of the deleted instance.
    */
    public function delete()
    {
        return self::execute("8dfad812-49ab-4961-ae2f-7791a2f8867f", $this);
    }




}

