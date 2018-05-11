<!--Reserv.js-->
(function() {
    var data = $("script[src*='addColScript.js']").attr('src').split('?')[1];
    var metaData = '{{ collection.metafields.collectionlower.lowerdata }}';
    console.log(metaData);
    $.ajax({
        crossDomain: true,
        url: 'https://collectionpage-customize.herokuapp.com/getmeta_json.php?' + data,
        dataType: "jsonp",
        header: {
            "Access-Control-Allow-Origin": "*"
        },
        success: function(response) {
	   console.log(response);	
	}
    });
});
