<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{     
$collections = $shopify('GET /admin/custom_collections.json');
$smartcollection=$shopify('GET /admin/smart_collections.json'); 
	if($collections){
	echo '<form method="post" name="form" id="getcollection" action="#">';
	echo '<table cellspacing="10" cellpadding="10" border="1">';
	echo '<thead><tr><th>Collection Name</th><th>Image</th><th>upperData</th><th>lowerData</th><th>Action</th></tr></thead>';
		echo '<tbody>';
	foreach($collections as $Allcollections)
	{
		echo '<tr>';
		echo '<td>'.$Allcollections['title'].'</td>';
		echo '<td><img src="'.$Allcollections["image"]["src"].'" alt="collectionimage" /></td>';
		echo '<td>'.$Allcollections['body_html'].'</td>';
		echo '<td>'.'<textarea class="form-control" id="col-metafield2" name="lowerData[]"></textarea>'.'</td>';
		echo '<td>'.'<input type="button" class="collectionSave" value="Add Collection Data" name="addColData" data-id="'.$Allcollections["id"].'"></td>';
		echo '</tr>';

		}
	foreach($smartcollection as $smartcollections)
	{
		echo '<tr>';
		echo '<td>'.$smartcollections['title'].'</td>';
		echo '<td><img src="'.$smartcollections["image"]["src"].'" alt="collectionimage" /></td>';
		echo '<td>'.$smartcollections['body_html'].'</td>';
		echo '<td>'.'<textarea class="form-control" id="col-metafield2" name="lowerData[]"></textarea>'.'</td>';
		echo '<td>'.'<input type="button" class="collectionSave" value="Add Collection Data" name="addColData" data-id="'.$smartcollections["id"].'"></td>';
		echo '</tr>';

		}	
		
	echo '</tbody>';
	echo '</table>';
 echo '</form>';
}
else {
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
