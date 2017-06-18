<?php

use Helpers\Billplz\Callback;
use Helpers\Billplz\Billplz;
use Helpers\Ecwid\Ecwid;

if (!isset($_GET['billplz']['id'])) {
    exit('What are you doing here?!!');
}

$callback = new Callback;
$bill_id = $_GET['billplz']['id'];
$x_login = $callback->getXLogin($bill_id);
$x_signature = $callback->getXSignature($x_login);

$data = Billplz::getRedirectData($x_signature);
$api_key = $callback->getAPIKey($x_login);
$billplz = new Billplz($api_key);
$moreData = $billplz->check_bill($bill_id);
$rawAmount = $moreData['amount'] / 100;

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

$relayURL = $callback->getRelayURL($bill_id);
$callback->setNoNeedCallback($bill_id);
?>
<form name="ecwidpay" action="<?php echo $relayURL; ?>" method="POST" id='ecwidpay'>
    <?php
    foreach ($datatopost as $key => $value) {
        ?>
        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" />
        <?php
    }
    ?><input type="submit" value="Click Here if you are not redirected" />
</form>
<script>document.getElementById('ecwidpay').submit();</script>