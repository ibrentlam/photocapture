<?php

require_once 'vendor/autoload.php';

// These code snippets use an open-source library. http://unirest.io/php
$data =  array(
    'debug' => true,
    'url' => 'https://www.textibility.com/assets/img/samples/qr.png'
);

$body = Unirest\Request\Body::form($data);

$apikey = getenv('BARCODE_KEY');

$headers =  array(
    'X-Mashape-Key' => $apikey,
    'Content-Type' => 'application/x-www-form-urlencoded',
    'Accept' => 'application/json'
);

$response = Unirest\Request::post('https://ideasynthesis-textibility.p.mashape.com/barcode/decode/1', $headers, $body);

//print_r($response);

echo $response->body->data;

?>
