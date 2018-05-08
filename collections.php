<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{       $collections = $shopify('GET /admin/custom_collections.json');
		if($collections){
		echo '<form method="post" name="form" id="getproducts" action="#">';
		echo '<table cellspacing="10" cellpadding="10" border="1">';
		echo '<thead><tr><th></th><th>Collection Name</th><th>Image</th><th>Content</th></tr></thead>';
			echo '<tbody>';
		foreach($collections as $Allcollections)
		$i = 0; 
		{?>
				<tr id='<?php echo"$i"; ?>'>
				echo '<td><input type="checkbox" name="product_ids[id]" value="'.$Allcollections["id"].'" data-pro-handle="'.$Allcollections["handle"].'" /></td>';
				echo '<td>'.$Allcollections['title'].'</td>';
				echo '<td><img src="'.$Allcollections["image"]["src"].'" alt="collectionimage" /></td>';
				echo '<td>'.$Allcollections['body_html'].'</td>';
			
			echo '</tr>';
			$i++;
			}
		echo '<tr><td colspan="5"><input type="button" class="saveproducts" value="Button" name="submit" /></td></tr></tbody>';
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
