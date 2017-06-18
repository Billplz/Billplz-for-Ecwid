<?php

use Helpers\xfphash\Verifier;
use Helpers\Billplz\Billplz;
use Helpers\Save\Order;

$verifier = new Verifier;

if (!$verifier->getStatusMatch()) {
    exit('Invalid Request');
}

$data = $verifier->getPostData();
$userData = $verifier->getUserData();

/*
 * Ensure user enable relay response
 */

if ($data['x_relay_response'] !== 'TRUE') {
    exit('Please Set Transaction type to Authorize And Capture!');
}

$callback_url = $config['website_url'].'index.php?controller=callback';
$redirect_url = $config['website_url'].'index.php?controller=redirect';

$billplz = new Billplz($userData['api_key']);
$billplz
        ->setName($data['x_first_name'] . ' ' . $data['x_last_name'])
        ->setAmount($data['x_amount'])
        ->setCollection($userData['collection_id'])
        ->setDeliver('0')
        ->setDescription($data['x_description'])
        ->setEmail($data['x_email'])
        ->setMobile($data['x_phone'])
        ->setPassbackURL($callback_url, $redirect_url)
        ->create_bill(true);

$bill_id = $billplz->getID();
$bill_url = $billplz->getURL();
$order_id = $data['x_invoice_num'];
$x_login = $data['x_login'];
$relayURL = $data['x_relay_url'];

Order::saveOrder($bill_id, $order_id, $x_login, $relayURL);

header('Location: ' . $bill_url);
