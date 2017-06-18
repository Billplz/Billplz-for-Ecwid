<?php

/*
 * Reference:
 * 1.https://www.ecwid.com/forums/showthread.php?t=35539
 */

namespace Helpers\Ecwid;

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Ecwid {

    public function sendToEcwid($relayURL, $array) {

        $client = new Client();

        $reqType = 'POST';

        $preparedHeader = [
            'verify' => false,
            'form_params' => $array
        ];

        try {
            $response = $client->request($reqType, $relayURL, $preparedHeader);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        } finally {
            $contents = $response->getBody()->getContents();
        }
        error_log(var_export($contents));
    }

}
