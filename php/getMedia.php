<?php
require_once('Application.class.php');
$q = $_GET["q"]; // represente le numero de reference du media
if ((strlen($q) == 0) || ($q == Null)) {
	$q = Null;
}

if ($q != Null) {

	// la requete sql selectionne un sommaire des informations d'un media selon son numero de reference
	$sql="SELECT medias.reference as reference, medias.titre as titre, medias.annee_publication as annee_publication, medias.notes as notes, medias.image as image, maisons_edition.nom as menom, supports.nom as cnom FROM medias 
		INNER JOIN maisons_edition ON medias.maison_editionID = maisons_edition.ID 
		INNER JOIN supports ON medias.supportID = supports.ID 
		WHERE reference = '".$q."'";
	
	$query = $application->database->prepare($sql);
	$query->execute();

	// on met le media dans un div qui s'adapte a son contenu, par la suite on cree un div pour lui associer un tooltip
	// le tooltip contient un sommaire des informations d'un media que nous avons recu par la requete sql
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

