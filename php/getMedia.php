<?php
require_once('Application.class.php');
$q = $_GET["q"];
if ((strlen($q) == 0) || ($q == Null)) {
	$q = Null;
}

if ($q != Null) {

	$sql="SELECT medias.reference as reference, medias.titre as titre, medias.annee_publication as annee_publication, medias.notes as notes, medias.image as image, maisons_edition.nom as menom, categories.nom as cnom FROM medias 
		INNER JOIN maisons_edition ON medias.maison_editionID = maisons_edition.ID 
		INNER JOIN categories ON medias.categorieID = categories.ID 
		WHERE reference = '".$q."'";
	
		$query = $application->database->prepare($sql);
		$query->execute();

	foreach($query as $row)
	{
		echo "<div id='outerDiv' class='autosize'>";
		echo "<div id='" . $row['reference'] . "'>";
		echo "<script src='http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js'></script>";
		echo "<script>$('#" . $row['reference'] . "aazz').tooltip({effect: 'slide'});</script>";
		echo "<p id='" . $row['reference'] . "aazz'>" . $row['reference'] . " | " . $row['titre'] . "</p>";
		echo "<div class='tooltip'><img src='" . $row['image'] . "' style='float:left;margin:0 15px 20px 0' height='75' weight='75' /><table style='margin:0'><tr><td>Titre : </td><td>" . $row['titre'] . "</td></tr><tr><td>Annee de publication : </td><td>" . $row['annee_publication'] . "</td></tr><tr><td>Maison d'edition : </td><td>" . $row['menom'] . "</td></tr><tr><td>Collection : </td><td>" . $row['cnom'] . "</td></tr>		</table></div>";
		echo "</div>";
		echo "</div>";
	}
}
?>

