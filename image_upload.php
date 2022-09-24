<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);	
include_once 'constant.php';

$shopId = $_GET['shop_id'];
$code   = $_GET['code'];

$partnerId = PARTNER_ID;
$partnerKey = PARTNER_KEY;
$path = '/api/v2/media_space/upload_image';

$data = getToken($shopId, $code);

if (isset($data['access_token'])) {
    $accessToken = $data['access_token'];

    $timestamp = time();
    $fromTimestamp = 1611311600;
    $endTimestamp  = 1611311631;

    $salt = $partnerId . $path . $timestamp;
    $sign = hash_hmac('sha256', $salt, $partnerKey, false);

    $url = HOST_URL . $path . '?partner_id=' . PARTNER_ID;
    //$url .= '&shop_id=' . (int)$shopId;
    //$url .= '&partner_id=' . PARTNER_ID;
    $url .= '&sign=' . $sign;
    $url .= '&timestamp=' . $timestamp;
	
	echo $url;

    $postData = array(
        "image" => new CURLFILE('F:\xampp\htdocs\Payment_gateway/shopee/download.png'),
    );
	
	//echo "<pre>";
	//echo json_encode($postData, true);
	//echo "<br/>";
	
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
    ));
    $response = curl_exec($curl);
	//echo $response;
    curl_close($curl);
    $data = json_decode($response, true);
    echo "<pre>";
	print_r($data);
	die;
} else {
    echo 'Access token not found.';
}

?>