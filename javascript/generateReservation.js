$(document).ready(function() {
	var media = getUrlParameter( 'media' );
	showMedia(media);
	$('#datelist').hide();
});

function showMedia(str) {
	$.ajax({
		type: "GET",
		url: "php/getMediaID.php",
		data: "q="+str,
		dataType: "html",
		success: function(html){
			$('form#reservation select#date_reservation').after(html);
		}
	});
}

function getUrlParameter( name )
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

function radioButtonToggle(value)
{
	if ($('input[name=group1]:checked').val() == 'ASAP')
		$('#datelist').hide('fast');
	else
		$('#datelist').show('fast');
}
