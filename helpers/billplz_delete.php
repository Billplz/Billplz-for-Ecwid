<?php

namespace Helpers\Billplz;

use Helpers\Billplz\Billplz;
use DateTime;

class Delete {

    private $billplz;
    private $bill_id;

    function __construct() {
        $this->billplz = new Billplz('');
    }

    public function getAllBills() {
        global $db;

        $all_bill = $db->get_all_bill();
        $current_date = date_create(date("Y-m-d"));

        /*
         * Filter out all bills less than 3 days
         */
        $all_bill_filtered = array();
        foreach ($all_bill as $bill) {
            $datetime = new DateTime($bill['timestamp']);
            $diff = date_diff($datetime, $current_date);
            $diff_int = (int) $diff->format("%a");
            if ($diff_int > 3) {
                array_push($all_bill_filtered, $bill['id']);
            }
        }
        return $all_bill_filtered;
    }

    public function setAPIKey($api_key) {
        $this->billplz->setAPIKey($api_key);
        return $this;
    }

    public function setBills($bill_id) {
        $this->bill_id = $bill_id;
        return $this;
    }

    public function deleteBills() {
        
        global $db;
        $delete = $this->billplz->deleteBill($this->bill_id);
        if ($delete) {
            $db->delete_bill($this->bill_id);
        } else {
            $moreData = $this->billplz->check_bill($this->bill_id);
            if (isset($moreData['state'])) {
                if ($moreData['state'] == 'paid') {
                    $db->delete_bill($this->bill_id);
                }
            }
        }
    }

}
