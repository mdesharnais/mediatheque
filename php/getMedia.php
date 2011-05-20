<?php
require_once('Application.class.php');
$q=$_GET["q"];

$sql="SELECT medias.reference as reference, medias.titre as titre, medias.annee_publication as annee_publication, medias.notes as notes, medias.image as image maisons_edition.nom as menom, categories.nom as cnom FROM medias 
	INNER JOIN maisons_edition ON medias.maison_editionID = maisons_edition.ID 
	INNER JOIN categories ON medias.categorieID = categories.ID 
	WHERE reference = '".$q."'";
	
foreach($application->database->query($sql) as $row)
{
	echo "<div id='" . $row['reference'] . "'>";
	echo $row['reference'] . " | " . $row['titre'] . " (" . $row['annee_publication'] . ")<br>" . $row['menom'] . ", " . $row['cnom'] . "<br>" . $row['notes'] . "<br><img src='" . $row['image'] . "' />";
	echo "</div>";
}
?> 
