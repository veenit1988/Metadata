<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$collectionid = $_REQUEST['collectionid'];
echo $meta2 = $_REQUEST['meta2'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	

if($meta2 !== '' )
	{
	$metafield2 = array( "metafield" => array('namespace' => 'lowercollectionmeta', 'key' => 'lowercollectiondata', 'value' => $meta2,
	'value_type' => 'string'));
	}	
	else {
	$meta2 = "noData";
	$metafield2 = array( "metafield" => array('namespace' => 'lowercollectionmeta', 'key' => 'lowercollectiondata', 'value' => $meta2,
	'value_type' => 'string'));
	}
	//CustomCollection and SmartCollection
	$response = $shopify('POST /admin/custom_collections/' + $collectionid + '/metafields.json',$metafield2);
	//$smartresponse = $shopify('POST /admin/smart_collections/' + $collectionid + '/metafields.json',$metafield2);
	echo $response['value'];
	//echo $smartresponse['value'];
	
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}

?>
