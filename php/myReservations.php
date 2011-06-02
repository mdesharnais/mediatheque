<?php
require_once('Application.class.php');
$r = $application->currentUser->getID();
if (is_null($r)) {
	echo "Vous devez être connecté.";
}
if ($r != Null) {
	$sql="SELECT medias.ID as ID, medias.reference as reference, medias.titre as titre, medias.annee_publication as annee_publication, medias.notes as notes, medias.image as image, maisons_edition.nom as menom, supports.nom as cnom, emprunts.date_reservation as date_reservation, date_voulue as date_voulue FROM medias 
		INNER JOIN maisons_edition ON medias.maison_editionID = maisons_edition.ID 
		INNER JOIN supports ON medias.supportID = supports.ID 
		INNER JOIN emprunts ON medias.ID = emprunts.mediaID
		INNER JOIN utilisateurs ON emprunts.utilisateurID = utilisateurs.ID
		WHERE utilisateurs.ID = '".$r."' AND emprunts.date_retour IS NULL AND emprunts.date_emprunt IS NULL";

	$query = $application->database->prepare($sql);
	$query->execute();
	
	foreach($query as $row)
	{
		echo "<div id='outerDiv' class='autosize'>";
		echo "<div id='" . $row['reference'] . "'>";
		echo "<a href='media.php?ID=" . $row['ID'] . "'><p id='" . $row['reference'] . "aazz'>" . $row['reference'] . " | " . $row['titre'] . " réservé pour le " . $row['date_voulue'] . " le " . $row['date_reservation'] . "</p></a>";
		echo "<div class='tooltip'><img src='images/medias/" . $row['image'] . "' style='float:left;margin:0 15px 20px 0' height='75' weight='75' /><table style='margin:0'><tr><td>Titre : </td><td>" . $row['titre'] . "</td></tr><tr><td>Annee de publication : </td><td>" . $row['annee_publication'] . "</td></tr><tr><td>Maison d'edition : </td><td>" . $row['menom'] . "</td></tr><tr><td>Support : </td><td>" . $row['cnom'] . "</td></tr>		</table></div>";
		echo "<script>$('#" . $row['reference'] . "aazz').tooltip({effect: 'slide'});</script>";
		echo "</div>";
		echo "</div>";
	}
}
?>
