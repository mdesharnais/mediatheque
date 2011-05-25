<?php
require_once('Application.class.php');

function printSearchResults($sqlQuery)
{
	global $application;
	
	$query = $application->database->prepare($sqlQuery);
	$query->execute();
	
	echo '<table id="resultTable">';
	
	foreach($query as $row)
	{
		echo '<tr class="mediaRowResult">';
		
		echo '<td class="mediaPicture">';
		if (!empty($row['image']))
		{
			echo '<p>';
			echo '<img class="resultPicture" src="images/medias/'.$row['image'].' " alt="Illustration du média: '.$row['titre'].'"/>';
			echo '</p>';
		}
		else
		{
			echo '<p>';
			echo '<img class="mediaTypePicture" src="images/typesMedia/'.$row['imageCategorie'].'" alt="'.$row['nomCategorie'].'"/>';
			echo '</p>';
		}
		echo '</div>';//mediaPicture
		
		echo '<td class="mediaInformations">';
		echo '<h4 class="mediaTitle"><a href="media.php">'.$row['titre'].'</a></h4>';
		echo '<p>';
		echo '<span class="label">Éditeur: </span><span class="value">'.$row['nomMaisonEdition'].', '.$row['annee_publication'].'</span>';
		echo '</p>';
		echo '<p>';
		echo '<span class="label">Catégorie: </span><span class="value">'.$row['nomCategorie'].' - '.$row['nomSupport'].'</span>';
		echo '</p>';
		
		if (!empty($row['nomGenre']))
		{
			echo '<p>';
			echo '<span class="label">Genre: </span><span class="value">'.$row['nomGenre'].'</span>';
			echo '</p>';
		}
		
		if (!empty($row['notes']))
		{
			echo '<p>';
			echo '<span class="label">Notes: </span><span class="value">'.$row['notes'].'</span>';
			echo '</p>';
		}
		
		if (!empty($row['nomArtiste']))
		{
			echo '<p>';
			echo '<span class="label">Artiste principal:</span><span class="value">'.$row['nomArtiste'].'</span>';
			echo '</p>';
		}
		
		echo '<p>';
		echo '<span class="label">Code de référence:</span><span class="value">'.$row['reference'].'</span>';
		echo '</p>';
		
		
		
		
	echo '</td>';//fin de mediaInformations
	echo '</tr>';//
		
	}
	echo '</table>';
	

}

?>
