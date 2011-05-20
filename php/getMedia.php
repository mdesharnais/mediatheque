<?php
require_once('Application.class.php');
$q=$_GET["q"];

$sql="SELECT medias.reference as reference, medias.titre as titre, medias.annee_publication as annee_publication, medias.notes as notes, medias.image as image, maisons_edition.nom as menom, categories.nom as cnom FROM medias 
	INNER JOIN maisons_edition ON medias.maison_editionID = maisons_edition.ID 
	INNER JOIN categories ON medias.categorieID = categories.ID 
	WHERE reference = '".$q."'";
	
foreach($application->database->query($sql) as $row)
{
	//echo "<div id='" . $row['reference'] . "' class='media'>";
	//echo $row['reference'] . "<br>" . $row['titre'] . " (" . $row['annee_publication'] . ")<br>" . $row['menom'] . ", " . $row['cnom'] . "<br>" . $row['notes'] . "<br><img src='" . $row['image'] . "' width='128' height='128' />";
	//echo "</div>";
	
	/*$('#tonus').tooltip({ 
    delay: 0, 
    showURL: false, 
    bodyHandler: function() { 
        return $("<img/>").attr("src", this.src); 
    } 
});*/
	
	echo "<div id='" . $row['reference'] . "'>";
	echo "<script src='http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js'></script>";
	echo "<script>$('#" . $row['reference'] . " p[title]').tooltip({effect: 'slide'});</script>";
	//echo "<script>$('#" . $row['reference'] . " img[title]').tooltip({effect: 'slide'});</script>";
	echo "<p title='" . $row['image'] . $row['titre'] . " (" . $row['annee_publication'] . "), " . $row['menom'] . ", " . $row['cnom'] . "'>" . $row['titre'] . "</p>";
	//echo "<img src='" . $row['image'] . "' width='128' height='128' title='" . $row['titre'] . " (" . $row['annee_publication'] . "), " . $row['menom'] . ", " . $row['cnom'] . "' />";
	//echo "<img src='" . $row['image'] . "' width='128' height='128' /><p>" . $row['reference'] . "<br>" . $row['titre'] . " (" . $row['annee_publication']. ")<br>" . $row['menom'] . ", " . $row['cnom'] . "<br>" . $row['notes'];
	
	echo "<div id='tooltip'><img src='" . $row['image'] . "' style='float:left;margin:0 15px 20px 0' /><table style='margin:0'><tr><td>Titre : </td><td>" . $row['titre'] . "</td></tr><tr><td>Annee de publication : </td><td>" . $row['annee_publication'] . "</td></tr><tr><td>Maison d''edition : </td><td>" . $row['menom'] . "</td></tr><tr><td>Collection : </td><td>" . $row['cnom'] . "</td></tr>		</table></div>";
	
	echo "</div>";
}
?><script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script>

