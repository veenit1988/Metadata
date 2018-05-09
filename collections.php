<?php
require __DIR__.'/conf.php'; //Configuration
require __DIR__.'/vendor/autoload.php';
use phpish\shopify;
$access_token = $_REQUEST['access_token'];
$shopify = shopify\client($_REQUEST['shop'], SHOPIFY_APP_API_KEY, $access_token );
try
{     $collections = $shopify('GET /admin/custom_collections.json');
		if($collections){
		echo '<form method="post" name="form" id="getcollection" action="#">';
		echo '<table cellspacing="10" cellpadding="10" border="1">';
		echo '<thead><tr><th></th><th>Collection Name</th><th>Image</th><th>Content</th><th>upeerdata</th><th>lowerdata</th><th>Action</th></tr></thead>';
			echo '<tbody>';
		foreach($collections as $Allcollections)
		
		{
			echo '<tr>';
			echo '<td><input id="collectiondataid" type="checkbox" name="product_ids[id]" value="'.$Allcollections["id"].'" data-pro-handle="'.$Allcollections["handle"].'" /></td>';
			echo '<td>'.$Allcollections['title'].'</td>';
			echo '<td><img src="'.$Allcollections["image"]["src"].'" alt="collectionimage" /></td>';
			echo '<td>'.$Allcollections['body_html'].'</td>';
			echo '<td>'.'<textarea class="form-control" id="col-metafield1" name="sel_options[]"></textarea>'.'</td>';
			echo '<td>'.'<textarea class="form-control" id="col-metafield2" name="sel_options[]"></textarea>'.'</td>';
			echo '<td>'.'<a href="#"   onClick = "openmetafield();"  class="collectionid" data-id="'.$Allcollections["id"].'">Add Metafield</a>'.'</td>';
			echo '</tr>';
			
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
<script>
function openmetafield() {
 $('.collectionid').click(function(e) {
	 var meta1 = $("#col-metafield1").val();
	
	 var meta2 = $("#col-metafield2").val();

	var access_token = '<?php echo $access_token ?>';
	var shop = '<?php echo $_REQUEST['shop'] ?>';
	e.preventDefault();
	var collectionid = $(this).attr("data-id"); 
	 $.ajax({
		type: 'POST',
		 url: '/metafields.php?access_token='+access_token+'&shop='+shop+'&collectionid='+collectionid+'&meta1='+meta1+'&meta2='+meta2,
		dataType: "html",
		success: function(responsecollection) { 
			console.log(responsecollection);
			}
	});
	
	});
}	
	
</script>
