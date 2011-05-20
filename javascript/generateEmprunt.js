$(document).ready(function() {
	$('form#emprunt input#utilisateurID').after('<input type="button" value="Afficher" class="foo">');
	$('form#emprunt input[type="button"].foo').click(function() {
		$.ajax({
			type: "GET",
			url: "xml/utilisateurs.xml",
			dataType: "xml",
			success: function(xml) {
				$(xml).find('utilisateur').each(function() {
					var $userInfo = $('<div id="userInfo"></div>');
					if ($('form#emprunt input[type="number"]#utilisateurID').val() == $(this).attr('matricule'))
					{
						$userInfo.append($(this).attr('matricule') + '<br/>' + $(this).attr('prenom') + ' ' + $(this).attr('nom') + '<br/>' + $(this).attr('telephone') + '<br/>' + $(this).attr('email'));
						$('form#emprunt input[type="button"].foo').after($userInfo);
						$('form#emprunt label #lblUtilisateurID').hide();
						$('form#emprunt input#utilisateurID').hide();
						$('form#emprunt input[type="button"].foo').hide();
					}
				});
			}
		});
	});
	
	$('form#emprunt input#mediaID').after('<input type="button" value="+" class="add">');
	$('form#emprunt input[type="button"].add').click(function() {
		$.ajax({
			type: "GET",
			url: "xml/medias.xml",
			dataType: "xml",
			success: function(xml) {
				$(xml).find('media').each(function() {
					if ($('form#emprunt input[type="number"]#mediaID').val() == $(this).attr('reference'))
					{
						var $mediaInfo = $('<div id="' + $(this).attr('reference') + '"></div>');
						$mediaInfo.append($(this).attr('reference') + ' | ' + $(this).attr('titre') + '(' + $(this).attr('annee_publication') + ')');
						$('form#emprunt input[type="button"].add').after($mediaInfo);
						showMedia($('form#emprunt input[type="number"]#mediaID').val());
					}
				});
			}
		});
	});
	
	$('form#emprunt input#mediaID').after('<input type="button" value="-" class="suppress">');
	$('form#emprunt input[type="button"].suppress').click(function() {
		$('div#' + $('form#emprunt input[type="number"]#mediaID').val()).remove();
	});
});

// need to change txtHint
function showMedia(str)
{
if (str=="")
{
	document.getElementById("emprunt").innerHTML="";
	return;
} 
if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
}
else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("emprunt").innerHTML=xmlhttp.responseText;
		}
	}
xmlhttp.open("GET","php/getMedia.php?q="+str,true);
xmlhttp.send();
}
