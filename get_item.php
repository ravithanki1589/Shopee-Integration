<?php
include_once 'constant.php';

$shopId = $_GET['shop_id'];
$code = $_GET['code'];

$partnerId = PARTNER_ID;
$partnerKey = PARTNER_KEY;
$path = '/api/v2/product/get_item_list';

$data = getToken($shopId, $code);

if (isset($data['access_token'])) {
    $accessToken = $data['access_token'];

    $timestamp = time();
    $fromTimestamp = 1611311600;
    $endTimestamp = 1611311631;

    $salt = $partnerId . $path . $timestamp . $accessToken . $shopId;
    $sign = hash_hmac('sha256', $salt, $partnerKey, false);

    $url = HOST_URL . $path . '?access_token=' . $accessToken;
    $url .= '&item_status=NORMAL'; /* Item status = NORMAL/BANNED/DELETED/UNLIST */
    $url .= '&offset=1';
    $url .= '&page_size=10';
    $url .= '&partner_id=' . PARTNER_ID;
    $url .= '&shop_id=' . (int)$shopId;
    $url .= '&sign=' . $sign;
    $url .= '&timestamp=' . $timestamp;
    $url .= '&update_time_from=' . $fromTimestamp;
    $url .= '&update_time_to=' . $endTimestamp;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response, true);
    dd($data);
} else {
    echo 'Access token not found.';
}

?>