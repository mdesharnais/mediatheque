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
