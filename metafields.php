<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$collectionid = $_REQUEST['collectionid'];
$meta1 = $_REQUEST['meta1'];
echo $meta2 = $_REQUEST['meta2'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	

if( $meta1 !== '' || $meta2 !== '' )
	{
	$metafield1 = array( "metafield" => array('namespace' => 'collectiondescription', 'key' => 'collectiondescription', 'value' => $meta1,
	'value_type' => 'string'));
	print_r($metafield1);

	$metafield2 = array( "metafield" => array('namespace' => 'lowercollectionmeta', 'key' => 'lowercollectiondata', 'value' => $meta2,
	'value_type' => 'string'));
	print_r($metafield2);
	}
	
	else {
	$meta2 = "noData";
	$metafield1 = array( "metafield" => array('namespace' => 'collectiondescription', 'key' => 'collectiondescription', 'value' => $meta1,
	'value_type' => 'string'));
	$metafield2 = array( "metafield" => array('namespace' => 'lowercollectionmeta', 'key' => 'lowercollectiondata', 'value' => $meta2,
	'value_type' => 'string'));
	}
	$response = $shopify('POST /admin/collections/' + $collectionid + '/metafields.json',$metafield);	
	echo $response['value'].'==='.$response_auto_manual['value'];
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
