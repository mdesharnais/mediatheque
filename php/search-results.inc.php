<?php
require_once('Application.class.php');

function printSearchResults($sqlQuery)
{
	global $application;
	
	$query = $application->database->prepare($sqlQuery);
	$query->execute();
	
	echo '<table>';
	
	foreach($query as $row)
	{
		echo '<tr class="mediaRowResult">';
		
		echo '<td class="mediaPicture">';
		if ($row['image']<>"")
		{
			echo '<p>';
			echo '<img class="resultPicture" src="images/medias/'.$row['image'].'" alt="Illustration du média: '.$row['titre'].'"/>';
			echo '</p>';
		}
		else
		{
			//echo '<p>';
			//echo '<img src="'.$row['image'].'" alt="Illustration du média: '.$row['titre'].'"/>';
			//echo '</p>';
		}
		echo '</div>';//mediaPicture
		
		echo '<td class="mediaInformations">';
		echo '<h4 class="mediaTitle"><a href="media.php">'.$row['titre'].'</a></h4>';
		echo '<p>';
		echo '<span class="label">Éditeur: </span><span class="value">'.$application->getDrivingTableElementName('maisons_edition',$row['maison_editionID']).
		', '.$row['annee_publication'].'</span>';
		echo '</p>';
		echo '<p>';
		$categorieMediaID = $application->getFurtherRowID('supports','categorieMediaID',$row['supportID']);
		echo '<span class="label">Catégorie: </span><span class="value">'.$application->getDrivingTableElementName('categoriesMedia',$categorieMediaID).' - '.
		$application->getDrivingTableElementName('supports',$row['supportID']).'</span>';
		echo '</p>';
		
		if (!is_null($row['genreID']))
		{
			echo '<p>';
			echo '<span class="label">Genre: </span><span class="value">'.$application->getDrivingTableElementName('genres',$row['genreID']).'</span>';
			echo '</p>';
		}
		
		if ($row['notes']<>"")
		{
			echo '<p>';
			echo '<span class="label">Notes: </span><span class="value">'.$row['notes'].'</span>';
			echo '</p>';
		}
		
		if (!is_null($row['artisteID']))
		{
			echo '<p>';
			echo '<span class="label">Artiste principal:</span><span class="value">'.$application->getDrivingTableElementName('artistes',$row['artisteID']).'</span>';
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
