<?php

namespace Helpers\Billplz;

class Callback {

    public function getXLogin($bill_id) {
        global $db;
        $x_login = $db->get_x_login($bill_id);
        return $x_login;
    }

    public function getXSignature($x_login) {
        global $db;
        $x_sign = $db->get_x_sign($x_login);
        return $x_sign;
    }

    public function getMD5Hash($x_login) {
        global $db;
        $md5_hash =$db->get_md5_hash($x_login);
        return $md5_hash;
    }
    
    public function getOrderID($bill_id){
        global $db;
        $order_id = $db->get_order_id($bill_id);
        return $order_id;
    }
    
    public function getRelayURL($bill_id){
        global $db;
        $relayURL = $db->get_relay_url($bill_id);
        return $relayURL;
    }
    
    public function getAPIKey($x_login){
        global $db;
        $api_key = $db->get_api_key($x_login);
        return $api_key;
    }
    
    public function setNoNeedCallback($bill_id){
        global $db;
        $db->need_callback_update($bill_id);
    }
    
    public function getNeedCallback($bill_id){
        global $db;
        $need_callback = $db->get_need_callback($bill_id);
        return $need_callback;
    }

}
