<?php

namespace Helpers\Save;

class Order {

    public static function saveOrder($bill_id, $order_id, $x_login, $relayURL) {
        global $db;
        $db->set_bill($bill_id, $order_id, $x_login, $relayURL);
    }

}
