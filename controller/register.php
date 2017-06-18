<?php

use Helpers\Billplz\Verify;
use Helpers\Billplz\Register;

header('Content-Type: application/json; charset=utf-8', true, 200);

if (!isset($_POST['api_key']) || !isset($_POST['x_signature'])) {
    exit('Looking for backend API?');
}

$api_key = preg_replace('/\s+/', '', filter_var($_POST['api_key'], FILTER_SANITIZE_STRING));
$x_signature = preg_replace('/\s+/', '', filter_var($_POST['x_signature'], FILTER_SANITIZE_STRING));
$collection_id = isset($_POST['collection_id']) ? preg_replace('/\s+/', '', filter_var($_POST['collection_id'], FILTER_SANITIZE_STRING)) : '';

$array = [
    'status' => 'true',
    'status_message' => '',
    'api_login_id' => '',
    'transaction_key' => '',
    'md5_hash_value' => ''
];

/*
 * Verify API Key & Collection ID
 */

$verify = new Verify($api_key, $collection_id);
$status = $verify->getResult();

if (!$status['status']) {
    $array['status'] = 'false';
    $array['status_message'] = 'Invalid API Key. ';
    echo json_encode($array, true);
    exit;
} else if ($status['api_key_type'] === 'Staging') {
    $array['status_message'] = 'You are using Staging API Key. ';
}

$register = new Register();
$register_status = $register->save($api_key, $x_signature, $collection_id);
$response_data = $register->getData();

if ($register_status) {
    $array['status_message'] .= 'Successfully register. Note the information below';
}

$array['api_login_id'] = $response_data['login_id'];
$array['transaction_key'] = $response_data['transaction_key'];
$array['md5_hash_value'] = $response_data['md5_hash'];
$array['enpoint_url'] = $config['website_url'] . 'index.php?controller=createbill';

echo json_encode($array, true);
