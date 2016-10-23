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
class ConsumerContactID extends BaseObject {


    protected static function getOperationConfig($operationUUID) {
        switch ($operationUUID) {
            case "e9d92d6c-473a-4323-bcd5-9f897a89b849":
                return new OperationConfig("/send/v1/partners/{partnerId}/consumers/{consumerId}/contact_ids", "query", array(), array());
            case "879d9fbd-e244-42a6-87dd-aee38753bfb3":
                return new OperationConfig("/send/v1/partners/{partnerId}/consumers/{consumerId}/contact_ids", "create", array(), array());
            case "48e15417-aaeb-48a0-b3e1-be0e0cdc812c":
                return new OperationConfig("/send/v1/partners/{partnerId}/consumers/{consumerId}/contact_ids/{contactId}", "read", array(), array());
            case "a90a8513-1458-4d9b-840e-799118620cff":
                return new OperationConfig("/send/v1/partners/{partnerId}/consumers/{consumerId}/contact_ids/{contactId}", "update", array(), array());
            case "90b97d6a-2a20-4512-b0aa-5780dd9a8c10":
                return new OperationConfig("/send/v1/partners/{partnerId}/consumers/{consumerId}/contact_ids/{contactId}", "delete", array(), array());
            
            default:
                throw new \Exception("Invalid operationUUID supplied: $operationUUID");
        }
    }

    protected static function getOperationMetadata() {
        return new OperationMetadata(SDKConfig::getVersion(), SDKConfig::getHost());
    }







    /**
     * Query objects of type ConsumerContactID by id and optional criteria
     * @param type $criteria
     * @return type
     */
    public static function listAll($criteria)
    {
        return self::execute("e9d92d6c-473a-4323-bcd5-9f897a89b849",new ConsumerContactID($criteria));
    }
   /**
    * Creates object of type ConsumerContactID
    *
    * @param Map map, containing the required parameters to create a new object
    * @return ConsumerContactID of the response of created instance.
    */
    public static function create($map)
    {
        return self::execute("879d9fbd-e244-42a6-87dd-aee38753bfb3", new ConsumerContactID($map));
    }









    /**
     * Returns objects of type ConsumerContactID by id and optional criteria
     * @param type $id
     * @param type $criteria
     * @return type
     */
    public static function read($id, $criteria = null)
    {
        $map = new RequestMap();
        if (!empty($id)) {
            $map->set("id", $id);
        }
        if ($criteria != null) {
            $map->setAll($criteria);
        }
        return self::execute("48e15417-aaeb-48a0-b3e1-be0e0cdc812c",new ConsumerContactID($map));
    }


   /**
    * Updates an object of type ConsumerContactID
    *
    * @return A ConsumerContactID object representing the response.
    */
    public function update()  {
        return self::execute("a90a8513-1458-4d9b-840e-799118620cff",$this);
    }







   /**
    * Delete object of type ConsumerContactID by id
    *
    * @param String id
    * @return ConsumerContactID of the response of the deleted instance.
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
        return self::execute("90b97d6a-2a20-4512-b0aa-5780dd9a8c10", new ConsumerContactID($map));
    }

   /**
    * Delete this object of type ConsumerContactID
    *
    * @return ConsumerContactID of the response of the deleted instance.
    */
    public function delete()
    {
        return self::execute("90b97d6a-2a20-4512-b0aa-5780dd9a8c10", $this);
    }




}

