<?php
require_once('Application.class.php');

function printBreadCrumb($sqlQuery)
{
	//pour la présentation seulement
	global $presentationID;
	global $application;
	$sqlQuery = $presentationID;
	//fin de pour la présentation seulement
	

	$vraiRequete = createFromWhereClause($sqlQuery);
		
	$posFrom = strpos($vraiRequete,'FROM');
	$clauseFromWhere = substr($vraiRequete, $posFrom ,strlen($vraiRequete)-$posFrom);

	//supprime la clause order by
	$posOrderBy = strpos($clauseFromWhere,'ORDER BY');
	if ($posOrderBy)
		$clauseFromWhere = substr($clauseFromWhere, 0,$posOrderBy);
		
	switch ($sqlQuery)
	{
	case 1:
	
		echo '<h4>Catégorie</h4>';
		echo '<ul>';
		
		$query = $application->database->prepare("SELECT Distinct categories_media.nom AS nomCategorie ".$clauseFromWhere.' AND categories_media.nom IS NOT NULL ORDER BY categories_media.nom');
		$query->execute();
		foreach($query as $row)
		{
			if ($row['nomCategorie'] == 'Audio')
				echo '<li><a href="?presentation=2">'.$row['nomCategorie'].'*</a></li>';
			else
				echo '<li><a href="#">'.$row['nomCategorie'].'</a></li>';
		
		}
		echo '</ul>';	
		
		echo '<h4>Support</h4>';
		echo '<ul>';
		
		$query = $application->database->prepare("SELECT Distinct supports.nom AS nomSupport ".$clauseFromWhere.' AND supports.nom IS NOT NULL ORDER BY supports.nom');
		$query->execute();
		foreach($query as $row)
		{
			echo '<li><a href="#">'.$row['nomSupport'].'</a></li>';
		
		}
		echo '</ul>';
		
		echo '<h4>Artiste</h4>';
		echo '<ul>';
		
		$query = $application->database->prepare("SELECT Distinct artistes.nom AS nomArtiste ".$clauseFromWhere.' AND artistes.nom IS NOT NULL ORDER BY artistes.nom');
		$query->execute();
		foreach($query as $row)
		{
			echo '<li><a href="#">'.$row['nomArtiste'].'</a></li>';
		
		}
		echo '</ul>';	
		
		echo '<h4>Genre</h4>';
		echo '<ul>';
		$query = $application->database->prepare("SELECT Distinct genres.nom AS nomGenre ".$clauseFromWhere.' AND genres.nom IS NOT NULL ORDER BY genres.nom');
		$query->execute();
		foreach($query as $row)
		{
			echo '<li><a href="#">'.$row['nomGenre'].'</a></li>';
		
		}
		echo '</ul>';	
						
		echo '<h4>Année de publication</h4>';
		echo '<ul>';
		$query = $application->database->prepare("SELECT Distinct medias.annee_publication ".$clauseFromWhere.' AND medias.annee_publication IS NOT NULL ORDER BY medias.annee_publication');
		$query->execute();
		foreach($query as $row)
		{
			echo '<li><a href="#">'.$row['annee_publication'].'</a></li>';
		
		}
		echo '</ul>';
		
		echo '<h4>Éditeur</h4>';
		echo '<ul>';
		$query = $application->database->prepare("SELECT Distinct maisons_edition.nom AS nomMaisonEdition ".$clauseFromWhere.' AND maisons_edition.nom IS NOT NULL ORDER BY maisons_edition.nom');
		$query->execute();
		foreach($query as $row)
		{
			echo '<li><a href="#">'.$row['nomMaisonEdition'].'</a></li>';
		
		}
		echo '</ul>';
		
		break;
	case 2:
			
		echo '<h4>Artiste</h4>';
		echo '<ul>';
		
		$query = $application->database->prepare("SELECT Distinct artistes.nom AS nomArtiste ".$clauseFromWhere.' AND artistes.nom IS NOT NULL ORDER BY artistes.nom');
		$query->execute();
		foreach($query as $row)
		{
			if ($row['nomArtiste'] == 'Les cowboys fringants')
				echo '<li><a href="?presentation=3">'.$row['nomArtiste'].'*</a></li>';
			else
				echo '<li><a href="#">'.$row['nomArtiste'].'</a></li>';
		
		}
		echo '</ul>';	
		
		echo '<h4>Genre</h4>';
		echo '<ul>';
		$query = $application->database->prepare("SELECT Distinct genres.nom AS nomGenre ".$clauseFromWhere.' and genres.nom IS NOT NULL ORDER BY genres.nom');
		$query->execute();
		foreach($query as $row)
		{
			echo '<li><a href="#">'.$row['nomGenre'].'</a></li>';
		
		}
		echo '</ul>';	
						
		echo '<h4>Année de publication</h4>';
		echo '<ul>';
		$query = $application->database->prepare("SELECT Distinct medias.annee_publication ".$clauseFromWhere.' AND medias.annee_publication IS NOT NULL ORDER BY medias.annee_publication');
		$query->execute();
		foreach($query as $row)
		{
			echo '<li><a href="#">'.$row['annee_publication'].'</a></li>';
		
		}
		echo '</ul>';
		
		echo '<h4>Éditeur</h4>';
		echo '<ul>';
		$query = $application->database->prepare("SELECT Distinct maisons_edition.nom AS nomMaisonEdition ".$clauseFromWhere.' AND maisons_edition.nom IS NOT NULL ORDER BY maisons_edition.nom');
		$query->execute();
		foreach($query as $row)
		{
			echo '<li><a href="#">'.$row['nomMaisonEdition'].'</a></li>';
		
		}
		echo '</ul>';
				
	
		break;
	case 3:
			
		echo '<h4>Genre</h4>';
		echo '<ul>';
		$query = $application->database->prepare("SELECT Distinct genres.nom AS nomGenre ".$clauseFromWhere.' AND genres.nom IS NOT NULL ORDER BY genres.nom');
		$query->execute();
		foreach($query as $row)
		{
			echo '<li><a href="#">'.$row['nomGenre'].'</a></li>';
		
		}
		echo '</ul>';	
						
		echo '<h4>Année de publication</h4>';
		echo '<ul>';
		$query = $application->database->prepare("SELECT Distinct medias.annee_publication ".$clauseFromWhere.' AND medias.annee_publication IS NOT NULL ORDER BY medias.annee_publication');
		$query->execute();
		foreach($query as $row)
		{
			if ($row['annee_publication'] == 2008)
				echo '<li><a href="?presentation=4">'.$row['annee_publication'].'*</a></li>';
			else
				echo '<li><a href="#">'.$row['annee_publication'].'</a></li>';
		
		}
		echo '</ul>';
		
		echo '<h4>Éditeur</h4>';
		echo '<ul>';
		$query = $application->database->prepare("SELECT Distinct maisons_edition.nom AS nomMaisonEdition ".$clauseFromWhere.' AND maisons_edition.nom IS NOT NULL  ORDER BY maisons_edition.nom');
		$query->execute();
		foreach($query as $row)
		{
			echo '<li><a href="#">'.$row['nomMaisonEdition'].'</a></li>';
		
		}
		echo '</ul>';
				
		break;
	case 4:
	case 5:
		echo '<p>Recherche raffinée au maximum</p>';
		break;
	case 6:
		echo '<h4>Année de publication</h4>';
		echo '<ul>';
		$query = $application->database->prepare("SELECT Distinct medias.annee_publication ".$clauseFromWhere.' AND medias.annee_publication IS NOT NULL ORDER BY medias.annee_publication');
		$query->execute();
		foreach($query as $row)
		{
			if ($row['annee_publication'] == 2008)
				echo '<li><a href="?presentation=4">'.$row['annee_publication'].'*</a></li>';
			else
				echo '<li><a href="#">'.$row['annee_publication'].'</a></li>';
		
		}
		echo '</ul>';
		
		break;
	
	}
	
	
}
?>
