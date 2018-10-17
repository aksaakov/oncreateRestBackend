<?php

$ch = curl_init('https://api.sandbox.paypal.com/v1/oauth2/token');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
	'Accept: application/json',
	'Accept-Language: en_US'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch,  CURLOPT_USERPWD, $settings->paypal_client_id . ':' . $settings->paypal_client_secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
$x = curl_exec($ch);
curl_close($ch);
$token = json_decode($x)->access_token;

$ch = curl_init('https://api.sandbox.paypal.com/v1/payments/payment/PAY-6AW54485354972338LKSOHAQ');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Authorization: Bearer ' . $token,
	'Content-Type: application/json'
));
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result);
var_dump($result);
var_dump($result->state);
var_dump($result->transactions[0]->amount->total);