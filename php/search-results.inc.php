<?php
require_once('Application.class.php');

function printSearchResults($sqlFromWhere)
{
	global $application;
	//$basicQuery : requête de base (select seulement)
	//$sqlFromWhere: deuxième partie de la requête incluant la clause where et from
	
	$basicQuery = '
			SELECT medias.ID, medias.notes, medias.titre, medias.annee_publication, medias.image, medias.quantite, medias.reference, artistes.nom 
			AS nomArtiste, categoriesMedia.nom AS nomCategorie,	categoriesMedia.image AS imageCategorie, supports.nom AS nomSupport, maisons_edition.nom
			AS nomMaisonEdition, genres.nom AS nomGenre';
			
	switch ($sqlFromWhere) {
    case 1:
        $sqlQuery = $basicQuery.' FROM medias 
				LEFT JOIN artistes ON artistes.ID = medias.artisteID
				INNER JOIN supports ON medias.supportID = supports.ID
				INNER JOIN categoriesMedia ON supports.categorieMediaID = categoriesMedia.ID
				LEFT JOIN genres ON genres.ID = medias.genreID
				LEFT JOIN maisons_edition ON maisons_edition.ID = medias.maison_editionID
			WHERE medias.inactif=FALSE
			';
        break;
    case 2:
        $requestText= "Allo";
        break;
    case 3:
        $requestText= "Allo";
        break;
}
	
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
	$pagination->setDestinationPage('searchResults.php');
	$pagination->setFromClause($fromClause);
	$pagination->setWhereClause($whereClause);
	
	if(isset($_GET['page']))
    	$pagination->setCurrentPage($_GET['page']);
    else
      	$pagination->setCurrentPage(1);
      	
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
		echo '<span class="label">Action:</span><span class="value"><a class="reserveLink" href="php/makeReservation.php?id='.$row['ID'].'">Réserver</a></span>';
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
function printSearchRequest($sqlQuery)
{

switch ($sqlQuery) {
    case 1:
        $requestText= "Tous les médias";
        break;
    case 2:
        $requestText= "Allo";
        break;
    case 3:
        $requestText= "Allo";
        break;
}

echo '<div id=searchRequest>Recherche demandée: '.$requestText.'</div>';


}

?>
