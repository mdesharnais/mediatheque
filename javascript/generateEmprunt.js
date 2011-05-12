$(document).ready(function() {
	$('form#emprunt input#utilisateurID').after('<input type="button" value="Afficher" class="foo">');
	$('form#emprunt input[type="button"].foo').click(queryUserInfo());
});

function queryUserInfo()
{
	$.ajax({
		type: "GET",
		url: "utilisateurs.xml",
		dataType: "xml",
		success: function(xml) {
			$(xml).find('utilisateur').each(function() {
				var $userInfo = $('<div id="userInfo"></div>');
				$userInfo.append($(this).attr('matricule') + '<br/>' + $(this).attr('prenom') + ' ' + $(this).attr('nom') + '<br/>' + $(this).attr('telephone') + '<br/>' + $(this).attr('email'));
				$('form#emprunt input[type="button"].foo').after($userInfo);
			});
		}
	});
}
