<?php

use Helpers\Billplz\Delete;

$delete = new Delete();
$delete->setAPIKey($api_key);
$all_bill = $delete->getAllBills();

foreach($all_bill as $bill_id){
    $delete->setBills($bill_id)->deleteBills();
}

echo 'Done';