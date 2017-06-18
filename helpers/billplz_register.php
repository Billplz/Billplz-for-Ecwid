<?php

namespace Helpers\Billplz;

class Register {

    private $array;

    function __construct() {
        global $db;
        $maximum_id = $db->get_max_user_id();
        $this->array = [
            'id' => $maximum_id + 1,
            'login_id' => $maximum_id + 1,
            'transaction_key' => $db->generateRandomString(),
            'md5_hash' => $db->generateRandomString(),
        ];
    }

    public function save($api_key = '', $x_signature = '', $collection_id = '') {
        $this->array['api_key'] = $api_key;
        $this->array['x_signature'] = $x_signature;
        $this->array['collection_id'] = $collection_id;
        
        global $db;
        return $db->set_user(
                $this->array['id'], 
                $this->array['api_key'], 
                $this->array['collection_id'], 
                $this->array['x_signature'], 
                $this->array['login_id'], 
                $this->array['transaction_key'], 
                $this->array['md5_hash']
        );
    }
    
    public function getData(){
        return $this->array;
    }

}
