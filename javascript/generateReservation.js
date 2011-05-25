$(document).ready(function() {
	var media = gup( 'media' );
	showMedia(media);
});

function showMedia(str) {
	$.ajax({
		type: "GET",
		url: "php/getMedia.php",
		data: "q="+str,
		dataType: "html",
		success: function(html){
			$('form#reservation select#date_reservation').after(html);
		}
	});
}

function gup( name )
{
  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if( results == null )
    return "";
  else
    return results[1];
}
