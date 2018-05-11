<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$collectionid = $_REQUEST['collectionid'];
$metafieldData = $_REQUEST['metafieldData'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
	//$metafield = array( "metafield" => array("namespace" => "collectionlower", "key" => "lowerdata", "value" => $metafieldData, "value_type" => "string"));
	//Collection Metafield
	$jsonmetafield = json_encode($metafield);
	//$response = $shopify('POST /admin/collections/'.$collectionid.'/metafields.json',$metafield);
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://'.$_REQUEST['shop'].'/admin/collections/'.$collectionid.'/metafields.json',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => $jsonmetafield,
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
	  echo "cURL Error #:" . $err;
	} else {
	  echo $response;
	}
	
	
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}

?>
