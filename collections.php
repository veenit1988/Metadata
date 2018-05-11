<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{     
$collections = $shopify('GET /admin/custom_collections.json');
$smartcollection= $shopify('GET /admin/smart_collections.json'); 
	if($collections){
	echo '<form method="post" name="form" id="getcollection" action="#">';
	echo '<table cellspacing="10" cellpadding="10" border="1">';
	echo '<thead><tr><th>Collection</th><th>Collection bottom content</th><th>Action</th></tr></thead>';
		echo '<tbody>';
	foreach($collections as $Allcollections)
	{	
		$colId = $Allcollections["id"];
		echo '<tr>';
		echo '<td><img src="'.$Allcollections["image"]["src"].'" alt="collectionimage" />'.$Allcollections['title'].'</td>';
		echo '<td>'.'<textarea class="form-control" id="col-metafield2_'.$colId.'" name="lowerData[]"></textarea>'.'</td>';
		echo '<td>'.'<input type="button" class="collectionSave" value="Save" name="addColData" data-id="'.$colId.'"></td>';
		echo '</tr>';

		}
	foreach($smartcollection as $smartcollections)
	{
		$colId = $smartcollections["id"];
		echo '<tr>';
		echo '<td><img src="'.$smartcollections["image"]["src"].'" alt="collectionimage" />'.$smartcollections['title'].'</td>';
		echo '<td>'.'<textarea class="form-control" id="col-metafield2_'.$colId.'" name="lowerData[]"></textarea>'.'</td>';
		echo '<td>'.'<input type="button" class="collectionSave" value="Save" name="addColData" data-id="'.$colId.'"></td>';
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
