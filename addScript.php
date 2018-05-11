<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{	
	echo $url = "/admin/script_tags.json?src=".APP_SERVER_URL."addColScript.js?access_token=$access_token";
	echo $js_file = APP_SERVER_URL."addColScript.js?access_token=$access_token";
	$data = $shopify("GET $url");
	if(!$data){
		$fields = array( "script_tag" => array('event' => 'onload', 'src' => $js_file));
		$response = $shopify('POST /admin/script_tags.json',$fields);
		print_r($response);
		print_r('Add JS file');
	} else {
		//print_r($data);
		print_r('Already exist JS file');
	}
	echo "<script src='".APP_SERVER_URL."addColScript.js?access_token=$access_token&shop=$shop'></script>";
}
catch (shopify\ApiException $e)
{
	# HTTP status code was >= 400 or response contained the key 'errors'
	echo $e;
	print_r($e->getRequest());
	print_r($e->getResponse());
}
?>
