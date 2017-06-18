<?php

namespace Helpers\xfphash;

/*
 * Reference:
 * 1.https://www.ecwid.com/forums/showthread.php?t=12884
 * 2.http://www.authorize.net/support/SIM_guide.pdf
 */

class Verifier {

    private $status_match = false;
    private $post_data;

    const POST_ARRAY = ['x_description', 'x_login', 'x_amount', 'x_currency_code', 'x_version', 'x_line_item', 'x_email', 'x_fp_sequence', 'x_fp_timestamp', 'x_fp_hash', 'x_invoice_num', 'x_first_name', 'x_last_name', 'x_address', 'x_city', 'x_state', 'x_zip', 'x_country', 'x_phone', 'x_cust_id', 'x_relay_response', 'x_relay_url', 'x_show_form', 'x_method'];

    function __construct() {

        foreach (self::POST_ARRAY as $value) {

            if (isset($_POST[$value])) {
                $this->post_data[$value] = $_POST[$value];
            } else {
                exit('No ' . $value);
            }
        }
    }
    
    private function getTransactionKey(){
        global $db;
        $transaction_key = $db->get_transaction_key($this->post_data['x_login']);
        return $transaction_key;
    }

    public function getStatusMatch() {
        
        $transaction_key = $this->getTransactionKey();
        $preparedString = $this->post_data['x_login'] . '^' . $this->post_data['x_fp_sequence'] . '^' . $this->post_data['x_fp_timestamp'] . '^' . $this->post_data['x_amount'] . '^' . $this->post_data['x_currency_code'];
        $generatedHash = hash_hmac('md5', $preparedString, $transaction_key); //Nilai Ketiga => Transaction Key

        if ($generatedHash === $this->post_data['x_fp_hash']) {
            return true;
        }
        return false;
    }

    public function getPostData() {
        return $this->post_data;
    }
    
    public function getUserData() {
        global $db;
        $user_info = $db->get_user_info($this->post_data['x_login']);
        return $user_info;
    }

}
