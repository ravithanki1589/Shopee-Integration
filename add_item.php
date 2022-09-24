<?php
include_once 'constant.php';

$shopId = $_GET['shop_id'];
$code   = $_GET['code'];

$partnerId = PARTNER_ID;
$partnerKey = PARTNER_KEY;
$path = '/api/v2/product/add_item';

$data = getToken($shopId, $code);

if (isset($data['access_token'])) {
    $accessToken = $data['access_token'];

    $timestamp = time();
    $fromTimestamp = 1611311600;
    $endTimestamp  = 1611311631;

    $salt = $partnerId . $path . $timestamp . $accessToken . $shopId;
    $sign = hash_hmac('sha256', $salt, $partnerKey, false);

    $url = HOST_URL . $path . '?access_token=' . $accessToken;
    $url .= '&shop_id=' . (int)$shopId;
    $url .= '&partner_id=' . PARTNER_ID;
    $url .= '&sign=' . $sign;
    $url .= '&timestamp=' . $timestamp;

    $postData = array(
        "description" => "Testing Product",
        "item_name" => "Testing Product",
        "category_id" => 100020,
        "brand" => array(
            "brand_id" => 0,
            "original_brand_name" => "NoBrand"
        ),
        "logistic_info" => array(
            array(
                "enabled" => true,
                "logistic_id" => 20011,
            )
        ),
		
		"attribute_list"=>array(
				array(
					"attribute_id"=>100002,
					"attribute_value_list"=>[
						array(
							"value_id"=>0,
							"original_value_name"=>"2",
							"value_unit"=>""
						)
					]
				)
		),
        "original_price" => 100.00,
        "item_status" => "NORMAL",
        "normal_stock" => 33,
        "weight" => 1.1,
        "image" => array(
            "image_id_list" => array(
                "a17bb867ecfe900e92e460c57b892590"
            )
        )
    );
	
	echo "<pre>";
	echo json_encode($postData, true);
	echo "<br/>";
	
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
        CURLOPT_POSTFIELDS => json_encode($postData, true),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, true);
    echo "<pre>";
	print_r($data);
	die;
} else {
    echo 'Access token not found.';
}

?>