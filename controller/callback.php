<?php

use Helpers\Billplz\Callback;
use Helpers\Billplz\Billplz;
use Helpers\Ecwid\Ecwid;

if (!isset($_POST['id'])) {
    exit('What are you doing here?!!');
}

$callback = new Callback;
$bill_id = $_POST['id'];

/*
 * Check if callback is still required or not
 */

if ($callback->getNeedCallback($bill_id) === '0') {
    exit('No Need Callback');
}

$x_login = $callback->getXLogin($bill_id);
$x_signature = $callback->getXSignature($x_login);

$data = Billplz::getCallbackData($x_signature);
$rawAmount = $data['amount'] / 100;

$amount = number_format((float) $rawAmount, 2, '.', '');
$order_id = $callback->getOrderID($bill_id);

if ($data['paid']) {
    $responseCode = '1';
} else {
    $responseCode = '2';
}

$md5_hash = $callback->getMD5Hash($x_login);

$preparedString = $md5_hash . $x_login . $bill_id . $amount;
$md5GeneratedString = md5($preparedString);

$datatopost = [
    "x_response_code" => $responseCode,
    "x_response_reason_code" => $responseCode,
    "x_trans_id" => $bill_id,
    "x_invoice_num" => $order_id,
    "x_amount" => $amount,
    "x_MD5_Hash" => $md5GeneratedString
];



$ecwid = new Ecwid();
$relayURL = $callback->getRelayURL($bill_id);
$ecwid->sendToEcwid($relayURL, $datatopost);
$callback->setNoNeedCallback($bill_id);
exit('Success');