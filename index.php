<?php
include_once 'constant.php';

$timestamp = time();

$path = '/api/v2/shop/auth_partner';
$redirect_url = BASE_URL . "/callback.php";
$partner_id = PARTNER_ID;
$partner_key = PARTNER_KEY;

$salt = $partner_id . $path . $timestamp;
$sign = hash_hmac('sha256', $salt, $partner_key, false);

$url = HOST_URL . $path . '?partner_id=' . $partner_id . '&timestamp=' . $timestamp . '&sign=' . $sign . '&redirect=' . $redirect_url;

header('location:' . $url);

?>


