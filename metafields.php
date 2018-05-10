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
	$metafield = array( "metafield" => array('namespace' => 'collectionlower', 'key' => 'lowerdata', 'value' => 'dvdfvfdvdf', 'value_type' => 'string'));
	//Collection Metafield
	echo json_encode($metafield);
	$response = $shopify('POST /admin/collections/38781747260/metafields.json',$metafield);
	print_r($response);
	
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}

?>
