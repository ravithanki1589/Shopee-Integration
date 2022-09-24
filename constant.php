<?php
define('BASE_URL', 'https://waytoweb.info/fomopay/shopee');
define('PARTNER_ID', 1007749);
define('PARTNER_KEY', 'bffaa6d723d8d56621f5aa8a78611709c33a3290922a89940741c1639c97da8d');
define('HOST_URL', 'https://partner.test-stable.shopeemobile.com');

function dd(...$data)
{
    foreach ($data as $value) {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
        echo '<br>';
    }
    exit;
}


function getToken($shopId, $code)
{
    $apiPath = '/api/v2/auth/token/get';
    $url = HOST_URL . $apiPath;

    $timestamp = time();
    $salt = PARTNER_ID . $apiPath . $timestamp;
    $sign = hash_hmac('sha256', $salt, PARTNER_KEY, false);

    $data = array(
        "code" => $code,
        "partner_id" => PARTNER_ID,
        "shop_id" => (int)$shopId,
    );

    $url .= '?partner_id=' . PARTNER_ID . '&timestamp=' . $timestamp . '&sign=' . $sign;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response, true);
}

function getTokenByRefreshToken($refreshToken, $shopId)
{
    $apiPath = '/api/v2/auth/access_token/get';
    $url = HOST_URL . $apiPath;

    $timestamp = time();
    $salt = PARTNER_ID . $apiPath . $timestamp;
    $sign = hash_hmac('sha256', $salt, PARTNER_KEY, false);

    $data = array(
        "refresh_token" => $refreshToken,
        "partner_id" => PARTNER_ID,
        "shop_id" => (int)$shopId,
    );

    $url .= '?partner_id=' . PARTNER_ID . '&timestamp=' . $timestamp . '&sign=' . $sign;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response, true);
}

?>