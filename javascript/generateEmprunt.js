$(document).ready(function() {
	$('form#emprunt input#ID').hide();

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
						$mediaInfo.append($(this).attr('reference') + ' | ' + $(this).attr('titre') + '(' + $(this).attr('annee_publication') + ') du ');
						$mediaInfo.append(getDates());
						$mediaInfo.append(' au ');
						$mediaInfo.append(getDates());
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

function getDates()
{
	var $dateSelect = $('<select id=date_emprunt></select>');
	$.ajax({
		type: "GET",
		url: "xml/dates.xml",
		dataType: "xml",
		success: function(xml) {
			var dates=new Array();
			var j = 0;
			$(xml).find('date').each(function() {
				var myDate=new Date();
				myDate.setFullYear($(this).attr('annee'), $(this).attr('mois'), $(this).attr('jour'));
				for (var i=0;i<=15;i=i+1)
				{
					myDate.setDate(myDate.getDate()+7);
					dates[j] = myDate.getFullYear() + "-" + myDate.getMonth() + "-" + myDate.getDate();
					j += 1;
				}
			});
			dates.sort();
			for (var i=0;i<dates.length;i=i+1)
			{
				$dateSelect.append('<option value="' + dates[i] + '">' + dates[i] + '</option>');
			}
		}
	});
	return $dateSelect;
}
