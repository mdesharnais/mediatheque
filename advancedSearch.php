<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Samuel Milette-Lacombe">

		<title>Médiatech du département de musique du cégep de Trois-Rivières</title>

		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
		<script src="javascript/research.js"></script>
		
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<form id="advanced-search" method="post" action="searchResults.php">
				<h1>Rechercher :</h1>
				<div class="row-search">
					<select name="idx">
						<option value="kw">Mots-clés</option>
						<option class="all" value="medias.titre">Titre du média</option>
						<option class="all" value="medias.annee_publication">Année de publication</option>
						<option class="all" value="medias.reference">Code de référence</option>
						<option class="all" value="medias.notes">Notes</option>
						<option class="all" value="maisons_edition.nom">Maison d'édition</option>
						<option class="all" value="categories.nom">Catégorie</option>      
						<option class="audio video" value="epoques.nom">Époque</option>
						<option class="audio video" value="formes.nom">Forme</option>
						<option class="audio video" value="instrumentations.nom">Instrumentation</option>
						<option class="audio video" value="nationalites.nom">Nationalité</option>
						<option class="imprime" value="collections.nom">Collection</option>
						<option  class="all" value="catalogues.code">Code de catalogue</option>
						<option class="audio video" value="tonalites.nom">Tonalité</option>
						<option class="imprime" value="details_imprimes.genreID">Genre média imprime</option>
						<option class="audio video" value="pieces.genreID">Genre média audio/vidéo</option>
						<option class="all" value="artistes.nom">Nom d'artiste</option>
						<option class="audio video" value="Parolier_pieces.artisteID">Parolier</option>
						<option class="audio video" value="Interpretes_pieces.artisteID">Interprète</option>
						<option class="audio video" value="orchestrateurs_pieces.artisteID">Orchestrateur</option>
						<option class="audio video" value="audios_videos.CUP">CUP</option>
						<option class="audio video" value="audios_videos.realisateurs">Réalisateur</option>
						<option class="audio video" value="pieces.annee_enregistrement">Année d'enregistrement</option>
						<option class="audio video" value="pieces.titre">Titre de pièce</option>
					</select>
					<select name="equalityOp">
						<option value="LIKE" SELECTED>Contient</option>
						<option value="=">(=) Est égale à</option>
						<option value=">">(>) Est plus grand que</option>
						<option value=">=">(>=) Est plus grand ou égal à</option>
						<option value="<">(<) Est plus petit que</option>
						<option value="<=">(<=) Est plus petit ou égal à</option>
					</select>
					<input type="text" size="30" name="qq" id="fd" title="Saisissez les termes de recherche" value="" list="rr">
				</div>
				<div class="row-search">
					<select name="op">
						<option value="and" selected="selected">et</option>
						<option value="or">ou</option>
						<option value="not">sauf</option>
					</select>
					<select name="idx" onchange="">
						<option value="kw">Mots-clés</option>
						<option class="all" value="medias.titre">Titre du média</option>
						<option class="all" value="medias.annee_publication">Année de publication</option>
						<option class="all" value="medias.reference">Code de référence</option>
						<option class="all" value="medias.notes">Notes</option>
						<option class="all" value="maisons_edition.nom">Maison d'édition</option>
						<option class="all" value="categories.nom">Catégorie</option>      
						<option class="audio video" value="epoques.nom">Époque</option>
						<option class="audio video" value="formes.nom">Forme</option>
						<option class="audio video" value="instrumentations.nom">Instrumentation</option>
						<option class="audio video" value="nationalites.nom">Nationalité</option>
						<option class="imprime" value="collections.nom">Collection</option>
						<option  class="all" value="catalogues.code">Code de catalogue</option>
						<option class="audio video" value="tonalites.nom">Tonalité</option>
						<option class="imprime" value="details_imprimes.genreID">Genre média imprime</option>
						<option class="audio video" value="pieces.genreID">Genre média audio/vidéo</option>
						<option class="all" value="artistes.nom">Nom d'artiste</option>
						<option class="audio video" value="Parolier_pieces.artisteID">Parolier</option>
						<option class="audio video" value="Interpretes_pieces.artisteID">Interprète</option>
						<option class="audio video" value="orchestrateurs_pieces.artisteID">Orchestrateur</option>
						<option class="audio video" value="audios_videos.CUP">CUP</option>
						<option class="audio video" value="audios_videos.realisateurs">Réalisateur</option>
						<option class="audio video" value="pieces.annee_enregistrement">Année d'enregistrement</option>
						<option class="audio video" value="pieces.titre">Titre de pièce</option>
					</select>
					<select name="equalityOp">
						<option value="LIKE" SELECTED>Contient</option>
						<option value="=">(=) Est égale à</option>
						<option value=">">(>) Est plus grand que</option>
						<option value=">=">(>=) Est plus grand ou égal à</option>
						<option value="<">(<) Est plus petit que</option>
						<option value="<=">(<=) Est plus petit ou égal à</option>
					</select>
					<input type="text" size="30" name="q" title="Saisissez les termes de recherche">
				</div>
				<div class="row-search">
					<select name="op">
						<option value="and" selected="selected">et</option>
						<option value="or">ou</option>
						<option value="not">sauf</option>
					</select>
					<select name="idx">
						<option value="kw">Mots-clés</option>
						<option class="all" value="medias.titre">Titre du média</option>
						<option class="all" value="medias.annee_publication">Année de publication</option>
					 	<option class="all" value="medias.reference">Code de référence</option>
					 	<option class="all" value="medias.notes">Notes</option>
					 	<option class="all" value="maisons_edition.nom">Maison d'édition</option>
					 	<option class="all" value="categories.nom">Catégorie</option>      
						<option class="audio video" value="epoques.nom">Époque</option>
						<option class="audio video" value="formes.nom">Forme</option>
						<option class="audio video" value="instrumentations.nom">Instrumentation</option>
						<option class="audio video" value="nationalites.nom">Nationalité</option>
						<option class="imprime" value="collections.nom">Collection</option>
						<option  class="all" value="catalogues.code">Code de catalogue</option>
						<option class="audio video" value="tonalites.nom">Tonalité</option>
						<option class="imprime" value="details_imprimes.genreID">Genre média imprime</option>
						<option class="audio video" value="pieces.genreID">Genre média audio/vidéo</option>
						<option class="all" value="artistes.nom">Nom d'artiste</option>
						<option class="audio video" value="Parolier_pieces.artisteID">Parolier</option>
						<option class="audio video" value="Interpretes_pieces.artisteID">Interprète</option>
						<option class="audio video" value="orchestrateurs_pieces.artisteID">Orchestrateur</option>
						<option class="audio video" value="audios_videos.CUP">CUP</option>
						<option class="audio video" value="audios_videos.realisateurs">Réalisateur</option>
						<option class="audio video" value="pieces.annee_enregistrement">Année d'enregistrement</option>
						<option class="audio video" value="pieces.titre">Titre de pièce</option>
					</select>
					<select name="equalityOp">
						<option value="LIKE" SELECTED>Contient</option>
						<option value="=">(=) Est égale à</option>
						<option value=">">(>) Est plus grand que</option>
						<option value=">=">(>=) Est plus grand ou égal à</option>
						<option value="<">(<) Est plus petit que</option>
						<option value="<=">(<=) Est plus petit ou égal à</option>
					</select>
					<input type="text" size="30" name="q" title="Saisissez les termes de recherche" value="">
				</div>
				<br>
				<input type="submit" value="Rechercher"> 
				
				<input type="reset">
				    
						 
			</form>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>
