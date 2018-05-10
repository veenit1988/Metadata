<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shop = $_REQUEST['shop'];
$collectionid = $_REQUEST['collectionid'];
$metafieldData = $_REQUEST['metafieldData'];
print_r($_REQUEST); // data
/*$shopify = shopify\client($shop, SHOPIFY_APP_API_KEY, $access_token );
try
{	
	$metafield = array( "metafield" => array('namespace' => 'lowercollectionmeta', 'key' => 'lowercollectiondata', 'value' => $metafieldData,
	'value_type' => 'string'));
	
	//CustomCollection and SmartCollection
	$response = $shopify('POST /admin/collections/'.$collectionid.'/metafields.json',$metafield);
	echo $response['value'];
	
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}*/

?>
