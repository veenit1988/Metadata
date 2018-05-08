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
		echo '<thead><tr><th></th><th>Collection Name</th><th>Image</th><th>Content</th><th>Add Content</th></tr></thead>';
			echo '<tbody>';
		foreach($collections as $Allcollections)
		
		{
			echo '<tr>';
			echo '<td><input id="collectiondataid" type="checkbox" name="product_ids[id]" value="'.$Allcollections["id"].'" data-pro-handle="'.$Allcollections["handle"].'" /></td>';
			echo '<td>'.$Allcollections['title'].'</td>';
			echo '<td><img src="'.$Allcollections["image"]["src"].'" alt="collectionimage" /></td>';
			echo '<td>'.$Allcollections['body_html'].'</td>';
			echo '<td>'.'<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#gridSystemModal"> Add Metafield</button>'.'</td>';
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
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">.col-md-4</div>
          <div class="col-md-4 col-md-offset-4">.col-md-4 .col-md-offset-4</div>
        </div>
        <div class="row">
          <div class="col-md-3 col-md-offset-3">.col-md-3 .col-md-offset-3</div>
          <div class="col-md-2 col-md-offset-4">.col-md-2 .col-md-offset-4</div>
        </div>
        <div class="row">
          <div class="col-md-6 col-md-offset-3">.col-md-6 .col-md-offset-3</div>
        </div>
        <div class="row">
          <div class="col-sm-9">
            Level 1: .col-sm-9
            <div class="row">
              <div class="col-xs-8 col-sm-6">
                Level 2: .col-xs-8 .col-sm-6
              </div>
              <div class="col-xs-4 col-sm-6">
                Level 2: .col-xs-4 .col-sm-6
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
	$('#gridSystemModal').on('show.bs.modal', function (e) {
  if (!data) return e.preventDefault() // stops modal from being shown
})
</script>
