<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shop = $_REQUEST['shop'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
	$url = "/admin/script_tags.json?src=".APP_SERVER_URL."addColScript.js.liquid?access_token=$access_token";
	$js_file = APP_SERVER_URL."addColScript.js.liquid?access_token=$access_token";
	$JSdata = $shopify("GET $url");
	if(!$JSdata){
		$fields = array( "script_tag" => array('event' => 'onload', 'src' => $js_file));
		//$response = $shopify('POST /admin/script_tags.json',$fields);
		$jsonfields = json_encode($fields);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://'.$_REQUEST['shop'].'/admin/script_tags.json',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $jsonfields,
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				"content-type: application/json",
				"x-shopify-access-token: $access_token"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		//echo "cURL Error #:" . $err;
		echo 'Try again Later!';
		} else {
		//echo $response;
		echo 'JS file Created!';
		}
	} else {
		//print_r($JSdata);
		print_r('Already exist JS file');
	}
	//echo "<script src='".APP_SERVER_URL."addColScript.js?access_token=$access_token&shop=$shop'></script>";
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
