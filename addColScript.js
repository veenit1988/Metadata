(function() {
    var data = $("script[src*='addColScript.js']").attr('src').split('?')[1];
    console.log(data);
    alert(12);
    var metaData = "{{ collection.metafields.collectionlower.lowerdata }}";
    alert(window.location.href);
    console.log(metaData);
    $('.collection-description').after(metaData);
    $('.collection-hero').after('sdvsdvdsvdvdv');
});
