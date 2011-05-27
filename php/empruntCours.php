<?php
require_once('Application.class.php');
$r = $application->currentUser->getID();
if (is_null($r)) {
	echo "Vous devez être connecté.";
}
if ($r != Null) {
	
	$sql="SELECT medias.ID as ID, medias.reference as reference, medias.titre as titre, medias.annee_publication as annee_publication, medias.notes as notes, medias.image as image, maisons_edition.nom as menom, categories.nom as cnom, emprunts.date_retour as date_retour, emprunts.date_emprunt as date_emprunt FROM medias 
		INNER JOIN maisons_edition ON medias.maison_editionID = maisons_edition.ID 
		INNER JOIN categories ON medias.categorieID = categories.ID 
		INNER JOIN emprunts ON medias.ID = emprunts.mediaID
		INNER JOIN utilisateurs ON emprunts.utilisateurID = utilisateurs.ID
		WHERE utilisateurs.ID = '".$r."' AND emprunts.date_retour = '0000-00-00' AND emprunts.date_emprunt != '0000-00-00'";
	
	$query = $application->database->prepare($sql);
	$query->execute();

	foreach($query as $row)
	{
		echo "<div id='outerDiv' class='autosize'>";
		echo "<div id='" . $row['reference'] . "'>";
		echo "<a href='media.php?ID=" . $row['ID'] . "'><p id='" . $row['reference'] . "aazz'>" . $row['reference'] . " | " . $row['titre'] . " le " . $row['date_emprunt'] . "</p></a>";
		echo "<div class='tooltip'><img src='" . $row['image'] . "' style='float:left;margin:0 15px 20px 0' height='75' weight='75' /><table style='margin:0'><tr><td>Titre : </td><td>" . $row['titre'] . "</td></tr><tr><td>Annee de publication : </td><td>" . $row['annee_publication'] . "</td></tr><tr><td>Maison d'edition : </td><td>" . $row['menom'] . "</td></tr><tr><td>Collection : </td><td>" . $row['cnom'] . "</td></tr>		</table></div>";
		echo "<script>$('#" . $row['reference'] . "aazz').tooltip({effect: 'slide'});</script>";
		echo "</div>";
		echo "</div>";
	}
}
?>

