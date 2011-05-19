<?php
require_once('Application.class.php');
$q=$_GET["q"];

$sql="SELECT medias.reference as test1, maisons_edition.nom as test2, categories.nom as test3 FROM medias 
	INNER JOIN maisons_edition ON medias.maison_editionID = maisons_edition.ID 
	INNER JOIN categories ON medias.categorieID = categories.ID 
	WHERE reference = '".$q."'";
	
foreach($application->database->query($sql) as $row)
{
var_dump($row);
	//echo "<div id='" . $row['medias.reference'] . "'>";
	//echo $row['medias.reference'] . " | " . $row['medias.titre'] . " (" . $row['medias.annee_publication'] . ")<br>" . $row['maisons_edition.nom'] . ", " . $row['categories.nom'] . "<br>" . $row['medias.notes'] . "<br><img src='" . $row['medias.image'] . "' />";
	//echo "</div>";
}
?> 
