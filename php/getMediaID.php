<?php
require_once('Application.class.php');
$q = $_GET["q"];
if ((strlen($q) == 0) || ($q == Null)) {
	$q = Null;
}

if ($q != Null) {
	
	$query = $application->database->prepare('
		SELECT
			medias.reference, 
			medias.titre, 
			medias.annee_publication, 
			medias.notes, 
			medias.image, 
			maisons_edition.nom as menom, 
			supports.nom as cnom 
		FROM medias 
			INNER JOIN exemplaires_medias ON exemplaires_medias.mediaID = medias.ID 
			INNER JOIN maisons_edition ON medias.maison_editionID = maisons_edition.ID 
			INNER JOIN supports ON medias.supportID = supports.ID 
		WHERE medias.ID = ?');
	
	$query->execute(array($q));

	foreach($query as $row)
	{
		echo "<div id='outerDiv' class='autosize'>";
		echo "<div id='" . $row['reference'] . "'>";
		echo "<script src='http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js'></script>";
		echo "<script>$('#" . $row['reference'] . "aazz').tooltip({effect: 'slide'});</script>";
		echo "<p id='" . $row['reference'] . "aazz'>" . $row['reference'] . " | " . $row['titre'] . "</p>";
		echo "<div class='tooltip'><img src='images/medias/" . $row['image'] . "' style='float:left;margin:0 15px 20px 0' height='75' weight='75' /><table style='margin:0'><tr><td>Titre : </td><td>" . $row['titre'] . "</td></tr><tr><td>Annee de publication : </td><td>" . $row['annee_publication'] . "</td></tr><tr><td>Maison d'edition : </td><td>" . $row['menom'] . "</td></tr><tr><td>Support : </td><td>" . $row['cnom'] . "</td></tr>		</table></div>";
		echo "</div>";
		echo "</div>";
	}
}
?>

