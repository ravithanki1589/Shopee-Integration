<?php
include_once 'constant.php';

$shopId = $_GET['shop_id'];
$code = $_GET['code'];

$partnerId = PARTNER_ID;
$partnerKey = PARTNER_KEY;
$path = '/api/v2/product/register_brand';

$data = getToken($shopId, $code);

if (isset($data['access_token'])) {
    $accessToken = $data['access_token'];

    $timestamp = time();

    $salt = $partnerId . $path . $timestamp . $accessToken . $shopId;
    $sign = hash_hmac('sha256', $salt, $partnerKey, false);

    $url = HOST_URL . $path . '?access_token=' . $accessToken;
    $url .= '&shop_id=' . (int)$shopId;
    $url .= '&partner_id=' . PARTNER_ID;
    $url .= '&sign=' . $sign;
    $url .= '&timestamp=' . $timestamp;

    $postData = array(
        "original_brand_name" => "Test brand 1",
        "category_list" => array(102064),
        "product_image" => array(
            "image_id_list" => array("6373157f9408b42c8aacda1d63d3a209")
        ),
        "brand_country" => "MY"
    );
    $postData = json_encode($postData);

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
        CURLOPT_POSTFIELDS => $postData,
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