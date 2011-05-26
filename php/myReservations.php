<?php
require_once('Application.class.php');
$r = $application->currentUser->getID();
if (is_null($r)) {
	echo "Vous devez etre connecte.";
}
if ($r != Null) {
	$sql="SELECT medias.reference as reference, medias.titre as titre, medias.annee_publication as annee_publication, medias.notes as notes, medias.image as image, maisons_edition.nom as menom, categories.nom as cnom, emprunts.date_reservation as date_reservation FROM medias 
		INNER JOIN maisons_edition ON medias.maison_editionID = maisons_edition.ID 
		INNER JOIN categories ON medias.categorieID = categories.ID 
		INNER JOIN emprunts ON medias.ID = emprunts.mediaID
		INNER JOIN utilisateurs ON emprunts.utilisateurID = utilisateurs.ID
		WHERE utilisateurs.ID = '".$r."' AND emprunts.date_retour = '0000-00-00' AND emprunts.date_emprunt = '0000-00-00'";

	$query = $application->database->prepare($sql);
	$query->execute();

	foreach($query as $row)
	{
		echo "<div id='outerDiv' class='autosize'>";
		echo "<div id='" . $row['reference'] . "'>";
		echo "<script src='http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js'></script>";
		echo "<script>$('#" . $row['reference'] . "aazz').tooltip({effect: 'slide'});</script>";
		echo "<p id='" . $row['reference'] . "aazz'>" . $row['reference'] . " | " . $row['titre'] . " reserve pour le " . $row['date_reservation'] . "</p>";
		echo "<div class='tooltip'><img src='" . $row['image'] . "' style='float:left;margin:0 15px 20px 0' height='75' weight='75' /><table style='margin:0'><tr><td>Titre : </td><td>" . $row['titre'] . "</td></tr><tr><td>Annee de publication : </td><td>" . $row['annee_publication'] . "</td></tr><tr><td>Maison d'edition : </td><td>" . $row['menom'] . "</td></tr><tr><td>Collection : </td><td>" . $row['cnom'] . "</td></tr>		</table></div>";
		echo "</div>";
		echo "</div>";
	}
}
?>
