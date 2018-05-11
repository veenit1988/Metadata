
var data = $("script[src*='addColScript.js']").attr('src').split('?')[1];
if(window.location.href.indexOf('/collections/') > -1 ) {
  console.log(window.location.href);
  console.log(data);
}
