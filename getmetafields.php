<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$collectionid = $_REQUEST['collectionid'];
$meta2 = $_REQUEST['meta2'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{		
		$response = $shopify('GET /admin/collections' + $collectionid + '/metafields.json');
	
	print_r($response);
		$collectiondescription = ''; $lowercollectionmeta = '';
		foreach($response as $meta2){
			if($meta2['namespace'] == 'lowercollectionmeta'){
				$lowercollectionmeta = $meta2['value'];
			} else if($meta2['namespace'] == 'lowercollectionmeta'){
				$lowercollectionmeta = $meta2['value'];
			}
		}
		echo $lowercollectionmeta.'==='.$lowercollectionmeta;
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
