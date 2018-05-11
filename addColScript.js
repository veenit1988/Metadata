<!--Reserv.js-->
(function() {
    var data = $("script[src*='addColScript.js']").attr('src').split('?')[1];
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
