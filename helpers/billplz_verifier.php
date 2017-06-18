<?php

namespace Helpers\Billplz;

use Helpers\Billplz\Billplz;

class Verify {

    private $result;

    function __construct($api_key, $collection_id) {
        $billplz = new Billplz($api_key);
        $result = $billplz->check_api_key(); //Production or Staging
        $api_key_result = $billplz->get_api_key_status();

        $this->result = [
            'api_key_type' => $result,
            'status' => $api_key_result
        ];
    }
    
    public function getResult(){
        return $this->result;
    }
    
}
