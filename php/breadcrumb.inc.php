<?php
require_once('Application.class.php');

function printBreadCrumb($sqlQuery)
{
	//pour la présentation seulement
	global $presentationID;
	$sqlQuery = $presentationID;
	//fin de pour la présentation seulement
	
	switch ($sqlQuery)
	{
	case 1:
		echo '
				<h4>Catégorie</h4>
				<ul>
					<li><a href="?presentation=2">Médias audios*</a></li>
					<li><a href="#">Médias vidéos</a></li>
					<li><a href="#">Médias imprimés</a></li>
				</ul>
				<h4>Artiste</h4>
				<ul>
					<li><a href="#">Les cowboys fringuants</a></li>
					<li><a href="#">Wolgang Amadeus Mozart</a></li>
				</ul>
				<h4>Genres</h4>
				<ul>
					<li><a href="#">Folk</a></li>
					<li><a href="#">Musique Classique</a></li>
					<li><a href="#">Traditionnel</a></li>
			
				</ul>
				<h4>Éditeur</h4>
				<ul>
					<li><a href="#">Éditions Reprises</a></li>
					<li><a href="#">Lucasfilm</a></li>
					<li><a href="#">La tribune</a></li>
					<li><a href="#">Paris Pocket</a></li>
					<li><a href="#">Deutsche Grammophon</a></li>
				</ul>';
	
		break;
	case 2:
		echo '
				
				<h4>Artiste</h4>
				<ul>
					<li><a href="?presentation=3">Les cowboys fringuants*</a></li>
					<li><a href="#">Wolgang Amadeus Mozart</a></li>
				</ul>
				<h4>Genres</h4>
				<ul>
					<li><a href="#">Country</a></li>
					<li><a href="#">Folk</a></li>
					<li><a href="#">Rock alternatif</a></li>
				</ul>
				<h4>Année de publication</h4>
				<ul>
					<li><a href="#">2008</a></li>
				</ul>';
				
	
		break;
	case 3:
		echo '
			
				<h4>Genres</h4>
				<ul>
					<li><a href="#">Country</a></li>
					<li><a href="#">Folk</a></li>
					<li><a href="#">Rock alternatif</a></li>
				</ul>
				<h4>Année de publication</h4>
				<ul>
					<li><a href="?presentation=4">2008*</a></li>
				</ul>';
				
				
		break;
	case 4:
		echo '<p>Recherche raffinée au maximum</p>';
		break;
	
	
	}
	
	
}
?>
