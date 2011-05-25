<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title>Médiatech du département de musique du cégep de Trois-Rivières</title>

		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<?php require('php/search-results.inc.php');?>
		<div id="content">
			<div id="vertical-breadcrumb">
				<h3>Affinez votre recherche</h3>
				<h4>Lorem ipsum </h4>
				<ul>
					<li><a href="http://www.google.com" onclick="return confirm('Voulez-vous vraiment supprimer cet enregistrement?');">Lorem</a></li>
					<li><a href="#">Ipsum</a></li>
					<li><a href="#">Amet</a></li>
				</ul>
				<h4>Lorem ipsum </h4>
				<ul>
					<li><a href="#">Lorem</a></li>
					<li><a href="#">Ipsum</a></li>
					<li><a href="#">Sit</a></li>
					<li><a href="#">Amet</a></li>
				</ul>
				<h4>Lorem ipsum </h4>
				<ul>
					<li><a href="#">Lorem</a></li>
					<li><a href="#">Ipsum</a></li>
					<li><a href="#">Dolor</a></li>
					<li><a href="#">Sit</a></li>
					<li><a href="#">Amet</a></li>
				</ul>
				<h4>Lorem ipsum </h4>
				<ul>
					<li><a href="#">Lorem</a></li>
					<li><a href="#">Ipsum</a></li>
					<li><a href="#">Dolor</a></li>
					<li><a href="#">Sit</a></li>
					<li><a href="#">Amet</a></li>
					<li><a href="#">Consectetur</a></li>
					<li><a href="#">Lorem</a></li>
					<li><a href="#">Ipsum</a></li>
					<li><a href="#">Dolor</a></li>
					<li><a href="#">Sit</a></li>
					<li><a href="#">Amet</a></li>
					<li><a href="#">Consectetur</a></li>
				</ul>
			</div>
			<div id="search-results">
		
			<?php
			$sqlQuery = '
			SELECT medias.ID, medias.notes, medias.titre, medias.annee_publication, medias.image, medias.quantite, medias.reference, artistes.nom 
			AS nomArtiste, categoriesMedia.nom AS nomCategorie,	categoriesMedia.image AS imageCategorie, supports.nom AS nomSupport, maisons_edition.nom
			AS nomMaisonEdition, genres.nom AS nomGenre
			FROM medias
				LEFT JOIN artistes ON artistes.ID = medias.artisteID
				INNER JOIN supports ON medias.supportID = supports.ID
				INNER JOIN categoriesMedia ON supports.categorieMediaID = categoriesMedia.ID
				LEFT JOIN genres ON genres.ID = medias.genreID
				LEFT JOIN maisons_edition ON maisons_edition.ID = medias.maison_editionID
			WHERE medias.inactif=FALSE
			';
			
			//art.nom, sup.nom, med.ID, med.titre, med.annee_publication, med.image, gen.nom, med.quantite, med.reference, mai.nom, cat.nom, cat.image 
//			medias med, artistes art, supports sup, maisons_edition mai, genres gen, categoriesMedia cat 
//med.inactif=0 AND med.genreID = gen.ID AND med.maison_editionID=mai.ID AND art.ID = med.artisteID AND cat.ID IN (SELECT categorieMediaID FROM supports WHERE ID=med.supportID)
			printSearchResults($sqlQuery); ?>
			
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

