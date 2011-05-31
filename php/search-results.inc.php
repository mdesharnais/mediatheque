<?php
require_once('Application.class.php');

//variable uniquement pour la présentation de la conception
//cette variable contient le numéro de niveau de détail utilisée lors de la présentation
$presentationID = 0;

function createFromWhereClause($criterias)
{
	//uniquement pour la présentation de la conception
	global $presentationID;
	$presentationID = $criterias;
	
	$basicQuery = '
			SELECT medias.ID, medias.notes, medias.titre, medias.annee_publication, medias.image, medias.quantite, medias.reference, artistes.nom 
			AS nomArtiste, categories_media.nom AS nomCategorie,	categories_media.image AS imageCategorie, supports.nom AS nomSupport, maisons_edition.nom
			AS nomMaisonEdition, genres.nom AS nomGenre';
			
	switch ($criterias)
	{
	case 1:
		$sqlFromWhere = ' FROM medias 
				LEFT JOIN artistes ON artistes.ID = medias.artisteID
				INNER JOIN supports ON medias.supportID = supports.ID
				INNER JOIN categories_media ON supports.categorie_mediaID = categories_media.ID
				LEFT JOIN genres ON genres.ID = medias.genreID
				LEFT JOIN maisons_edition ON maisons_edition.ID = medias.maison_editionID
			WHERE medias.inactif=FALSE ORDER BY medias.titre
			';
	
		break;
	case 2:
		$sqlFromWhere = ' FROM medias 
				LEFT JOIN artistes ON artistes.ID = medias.artisteID
				INNER JOIN supports ON medias.supportID = supports.ID
				INNER JOIN categories_media ON supports.categorie_mediaID = categories_media.ID
				LEFT JOIN genres ON genres.ID = medias.genreID
				LEFT JOIN maisons_edition ON maisons_edition.ID = medias.maison_editionID
			WHERE medias.inactif=FALSE and Upper(categories_media.nom) = \'AUDIO\' ORDER BY medias.titre
			';
		break;
	case 3:
		$sqlFromWhere = ' FROM medias 
				LEFT JOIN artistes ON artistes.ID = medias.artisteID
				INNER JOIN supports ON medias.supportID = supports.ID
				INNER JOIN categories_media ON supports.categorie_mediaID = categories_media.ID
				LEFT JOIN genres ON genres.ID = medias.genreID
				LEFT JOIN maisons_edition ON maisons_edition.ID = medias.maison_editionID
			WHERE medias.inactif=FALSE and Upper(categories_media.nom) = \'AUDIO\' 
			AND Upper(artistes.nom) = \'Les cowboys fringants\'  ORDER BY medias.titre
			';
		break;
	case 4:
		$sqlFromWhere = ' FROM medias 
				LEFT JOIN artistes ON artistes.ID = medias.artisteID
				INNER JOIN supports ON medias.supportID = supports.ID
				INNER JOIN categories_media ON supports.categorie_mediaID = categories_media.ID
				LEFT JOIN genres ON genres.ID = medias.genreID
				LEFT JOIN maisons_edition ON maisons_edition.ID = medias.maison_editionID
			WHERE medias.inactif=FALSE and Upper(categories_media.nom) = \'AUDIO\' 
			AND Upper(artistes.nom) = \'Les cowboys fringants\'  AND medias.annee_publication=2008 ORDER BY medias.titre
			';
		break;
	}
return $basicQuery.$sqlFromWhere;
}

function printSearchResults($sqlQuery)
{
	global $application;
	global $presentationID;
	//$basicQuery : requête de base (select seulement)
	//$sqlFromWhere: deuxième partie de la requête incluant la clause where et from
 
	require('php/Pagination.class.php');
	
	$fromStartPosition = strrpos(strtoupper($sqlQuery), "FROM") + 5;
	$fromEndPosition = strrpos(strtoupper($sqlQuery), "WHERE");
	$fromClause = substr ($sqlQuery, $fromStartPosition, $fromEndPosition-$fromStartPosition);
	$whereStartPosition = $fromEndPosition + 6;
	$whereClause =  substr ($sqlQuery, $whereStartPosition, strlen($sqlQuery)-$whereStartPosition);
	
	/*echo $sqlQuery;
	echo '<br><br>';
	echo $fromClause;
	echo '<br><br>';
	echo $whereClause;
	*/
   	$pagination = new Pagination();
	$pagination->setDataBase($application->database);
	$pagination->setFromClause($fromClause);
	$pagination->setWhereClause($whereClause);
	
	if (isset($_GET['presentation']) || !empty($_GET['presentation']))
		$pagination->setDestinationPage('searchResults.php?presentation='.$_GET['presentation']);
	else
		$pagination->setDestinationPage('searchResults.php?presentation=1');
		
	
	if(isset($_GET['page']))
    	$pagination->setCurrentPage($_GET['page']);
    else
      	$pagination->setCurrentPage(1);
      	
    printSearchRequest($presentationID,$pagination); 	
    $pagination->show();
    
    $sqlQuery = $sqlQuery." limit ".$pagination->currentPageFirstItemNumber().", ".$pagination->itemsPerPage();
    $query = $application->database->prepare($sqlQuery);
	$query->execute();
	
	echo '<table id="resultTable">';
	
	foreach($query as $row)
	{
		echo '<tr class="mediaRowResult">';
		
		echo '<td>';
		if (!empty($row['image']))
		{
			echo '<p>';
			echo '<a href="media.php?id='.$row['ID'].'"><img class="resultPicture" src="images/medias/'.$row['image'].' " alt="Illustration du média: '.$row['titre'].'"/></a>';
			echo '</p>';
		}
		else
		{
			echo '<p>';
			echo '<a href="media.php?id='.$row['ID'].'"><img class="mediaTypePicture" src="images/typesMedia/'.$row['imageCategorie'].'" alt="'.$row['nomCategorie'].'"/></a>';
			echo '</p>';
		}
		echo '</div>';//mediaPicture
		
		echo '<td>';
		echo '<h4 class="mediaTitle"><a href="media.php?id='.$row['ID'].'">'.$row['titre'].'</a></h4>';
		
		if (!empty($row['nomMaisonEdition']))
		{
		echo '<p>';
		echo '<span class="label">Éditeur: </span><span class="value">'.$row['nomMaisonEdition'].'</span>';
		echo '</p>';
		}
		
		if (!empty($row['annee_publication']))
		{
		echo '<p>';
		echo '<span class="label">Année de publication: </span><span class="value">'.$row['annee_publication'].'</span>';
		echo '</p>';		
		}
		
		if (!empty($row['nomSupport']))
		{
		echo '<p>';
		echo '<span class="label">Catégorie: </span><span class="value">'.$row['nomCategorie'].' - '.$row['nomSupport'].'</span>';
		echo '</p>';
		}
		
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
			echo '<span class="label">Artiste:</span><span class="value">'.$row['nomArtiste'].'</span>';
			echo '</p>';
		}
		
		echo '<p>';
		echo '<span class="label">Code de référence:</span><span class="value">'.$row['reference'].'</span>';
		echo '</p>';
		echo '<p>';
		echo '<span class="label">Action:</span><span class="value"><a class="reserveLink" href="makeReservation.php?id='.$row['ID'].'">Réserver</a></span>';
		echo '</p>';
		
		
		
		
	echo '</td>';//fin de mediaInformations
	echo '</tr>';//
		
	}
	echo '</table>';
	
	$pagination->show();
	
}
/*
fonction
*/
function printSearchRequest($sqlQuery,Pagination $pagination)
{

	switch ($sqlQuery) {
		case 1:
		    $requestText= "Tous les médias";
		    break;
		case 2:
		    $requestText= "Tous les médias audio";
		    break;
		case 3:
		    $requestText= "Tous les médias audio de l'artiste cowboys fringuants";
	    case 4:
	    $requestText= "Tous les médias audio de l'artiste cowboys fringuants dont l'année de publication est 2008";
	    	break;
	}

echo '<div id=searchRequest>Recherche demandée: '.$requestText.', '.$pagination->ItemsCount().' média(s) trouvé(s)</div>';


}

?>
