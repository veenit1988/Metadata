<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{       $collections = $shopify('GET /admin/collects.json');
	$collections = $shopify('GET /admin/collects.json');
	if($collections){
		echo '<form method="post" name="form" id="getproducts" action="#">';
		echo '<table cellspacing="10" cellpadding="10" border="1">';
		echo '<thead><tr><th></th><th>Collection Name</th><th>Content</th><th>Brand</th><th>Image</th></tr></thead>';
			echo '<tbody>';
		foreach($collections as $Allcollections) {
				echo '<tr><td><input type="checkbox" name="product_ids[]" value="'.$Allcollections["id"].'" data-pro-handle="'.$$Allcollections["handle"].'" /></td>';
				echo '<td>'.$Allcollections['title'].'</td>';
				echo '<td>'.$Allcollections['body_html'].'</td>';
				echo '<td><img src="'.$Allcollections["image"]["src"].'" alt="collectionimage" /></td></tr>';
			}
		echo '<tr><td colspan="5"><input type="button" class="saveproducts" value="Show button on Product Page" name="submit" /></td></tr></tbody>';
		echo '</table>';
	 echo '</form>';
	
	}
	else{
	echo "<div class='no-result'>No collections</div>";
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
