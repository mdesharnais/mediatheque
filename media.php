<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title>Médiatech du département de musique du cégep de Trois-Rivières</title>

		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
		<script src="javascript/media.js"></script>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<form id="media">
				<?php
				try
				{
					if(isset($_GET['id']))
					{ // Modifying an existing media
						$sqlQuery = '
							SELECT medias.ID, 
								medias.titre, 
								medias.annee_publication, 
								medias.reference, 
								medias.notes, 
								medias.image, 
								audios_videos.CUP, 
								audios_videos.position_collection, 
								maisons_edition.nom AS maison_edition, 
								supports.nom AS support, 
								categoriesMedia.image AS imageCategorieMedia, 
								nationalites.nom AS nationalite, 
								collections.nom AS collection 
							FROM medias 
								LEFT JOIN audios_videos ON audios_videos.exID = medias.ID 
								LEFT JOIN maisons_edition ON maisons_edition.ID = medias.maison_editionID 
								LEFT JOIN supports ON supports.ID = medias.supportID 
								LEFT JOIN categoriesMedia ON categoriesMedia.ID = supports.categorieMediaID 
								LEFT JOIN nationalites ON nationalites.ID = audios_videos.nationaliteID 
								LEFT JOIN collections ON collections.ID = audios_videos.collectionID 
							WHERE medias.ID = ?';
						$query = $application->database->prepare($sqlQuery);
						$query->execute(array($_GET['id']));
						$row = $query->fetch();

						if($row == false)
							throw new Exception("Le média demandé n'existe pas.");
						elseif($application->currentUser->haveRights(__FILE__, $application->rights['read'] | $application->rights['write']))
							$media = new Media($row, Media::READ_WRITE);
						elseif($application->currentUser->haveRights(__FILE__, $application->rights['read']))
							$media = new Media($row, Media::READ_ONLY);
						else
							throw new Exception('Vous ne disposez pas des droits suffisant pour accéder à cette page.');

						echo '<h1>'.$media->getTitle()."</h1>\n";
					}
					else
					{ // Adding a new media
						if($application->currentUser->haveRights(__FILE__, $application->rights['read'] | $application->rights['write']))
							$media = new Media();
						else
							throw new Exception('Vous ne disposez pas des droits suffisant pour créer de nouveaux médias.');

						echo "<h1>Nouveau média</h1>\n";
					}
				?>
							<aside id="mediaInformations">
							<img src="<?php echo $media->getImage(); ?>">
							</aside>
							<div class="detailsLevel1">
								<p><?php $media->printTitleField(); ?></p>
								<p><?php $media->printPublicationYearField(); ?></p>
								<p><?php $media->printReferenceNumberField(); ?></p>
								<p><?php $media->printPublishingHouseField(); ?></p>
								<p><?php $media->printSupportField(); ?></p>
								<p><?php $media->printCollectionField(); ?></p>
								<p><?php $media->printPositionInCollectionField(); ?></p>
								<p><?php $media->printUniversalProductCodeField(); ?></p>
								<p><?php $media->printNationalityField(); ?></p>
								<p><?php $media->printDescriptionField(); ?></p>
							</div>
							<div class="detailsLevel2">
								<div class="detailsLevel2Row">
									<p><label for="details_titre">Titre</label><input type="text" id="details_titre" name="details_titre" value="Droit devant"></p>
									<p><label for="details_position_media">Position</label><input type="number" id="details_position_media" name="details_position_media" value="1"></p>
									<p><label for="details_annee_enregistrement">Année d'enregistrement</label><input type="number" id="details_annee_enregistrement" name="details_annee_enregistrement"></p>
									<p><label for="details_duree">Durée</label><input type="text" id="details_duree" name="details_duree" value="4:45"></p>
									<p>
										<label for="details_arrangeurs">Arrangeurs</label><!--
										--><span id="details_arrangeurs" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_arrangeurs" name="details_arrangeurs">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
											<span class="rowLevel3">
												<select id="details_arrangeurs" name="details_arrangeurs">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_artistes">Artistes</label><!--
										--><span id="details_artistes" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_arrangeurs" name="details_artistes">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_compositeurs">Compositeurs</label><!--
										--><span id="details_compositeurs" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_compositeurs" name="details_compositeurs">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
									<label for="details_parolier">Parolier</label><!--
										--><span id="details_parolier" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_parolier" name="details_parolier">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_interpretes">Interprètes</label><!--
										--><span id="details_interpretes" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_interpretes" name="details_interpretes">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_catalogueID">Catalogue</label><!--
										--><select id="details_catalogueID" name="details_catalogueID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_epoqueID">Époque</label><!--
										--><select id="details_epoqueID" name="details_epoqueID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_formeID">Forme</label><!--
										--><select id="details_formeID" name="details_formeID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_genreID">Genre</label><!--
										--><select id="details_genreID" name="details_genreID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_instrumentationID">Instrumentation</label><!--
										--><select id="details_instrumentationID" name="details_instrumentationID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_tonaliteID">Tonalité</label><!--
										--><select id="details_tonaliteID" name="details_tonaliteID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
								</div>
								<div class="detailsLevel2Row">
									<p><label for="details_titre">Titre</label><input type="text" id="details_titre" name="details_titre" value="Chêne et roseau"></p>
									<p><label for="details_position_media">Position</label><input type="number" id="details_position_media" name="details_position_media" value="2"></p>
									<p><label for="details_annee_enregistrement">Année d'enregistrement</label><input type="number" id="details_annee_enregistrement" name="details_annee_enregistrement"></p>
									<p><label for="details_duree">Durée</label><input type="text" id="details_duree" name="details_duree" value="2:12"></p>
									<p>
										<label for="details_arrangeurs">Arrangeurs</label><!--
										--><span id="details_arrangeurs" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_arrangeurs" name="details_arrangeurs">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_artistes">Artistes</label><!--
										--><span id="details_artistes" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_arrangeurs" name="details_artistes">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_compositeurs">Compositeurs</label><!--
										--><span id="details_compositeurs" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_compositeurs" name="details_compositeurs">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
									<label for="details_parolier">Parolier</label><!--
										--><span id="details_parolier" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_parolier" name="details_parolier">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_interpretes">Interprètes</label><!--
										--><span id="details_interpretes" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_interpretes" name="details_interpretes">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_catalogueID">Catalogue</label><!--
										--><select id="details_catalogueID" name="details_catalogueID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_epoqueID">Époque</label><!--
										--><select id="details_epoqueID" name="details_epoqueID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_formeID">Forme</label><!--
										--><select id="details_formeID" name="details_formeID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_genreID">Genre</label><!--
										--><select id="details_genreID" name="details_genreID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_instrumentationID">Instrumentation</label><!--
										--><select id="details_instrumentationID" name="details_instrumentationID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_tonaliteID">Tonalité</label><!--
										--><select id="details_tonaliteID" name="details_tonaliteID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
								</div>
								<div class="detailsLevel2Row">
									<p><label for="details_titre">Titre</label><input type="text" id="details_titre" name="details_titre" value="Entre deux taxis"></p>
									<p><label for="details_position_media">Position</label><input type="number" id="details_position_media" name="details_position_media" value="3"></p>
									<p><label for="details_annee_enregistrement">Année d'enregistrement</label><input type="number" id="details_annee_enregistrement" name="details_annee_enregistrement"></p>
									<p><label for="details_duree">Durée</label><input type="text" id="details_duree" name="details_duree" value="3:32"></p>
									<p>
										<label for="details_arrangeurs">Arrangeurs</label><!--
										--><span id="details_arrangeurs" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_arrangeurs" name="details_arrangeurs">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_artistes">Artistes</label><!--
										--><span id="details_artistes" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_arrangeurs" name="details_artistes">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_compositeurs">Compositeurs</label><!--
										--><span id="details_compositeurs" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_compositeurs" name="details_compositeurs">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
									<label for="details_parolier">Parolier</label><!--
										--><span id="details_parolier" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_parolier" name="details_parolier">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_interpretes">Interprètes</label><!--
										--><span id="details_interpretes" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_interpretes" name="details_interpretes">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_catalogueID">Catalogue</label><!--
										--><select id="details_catalogueID" name="details_catalogueID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_epoqueID">Époque</label><!--
										--><select id="details_epoqueID" name="details_epoqueID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_formeID">Forme</label><!--
										--><select id="details_formeID" name="details_formeID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_genreID">Genre</label><!--
										--><select id="details_genreID" name="details_genreID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_instrumentationID">Instrumentation</label><!--
										--><select id="details_instrumentationID" name="details_instrumentationID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_tonaliteID">Tonalité</label><!--
										--><select id="details_tonaliteID" name="details_tonaliteID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
								</div>
								<div class="detailsLevel2Row">
									<p><label for="details_titre">Titre</label><input type="text" id="details_titre" name="details_titre" value="La Catherine"></p>
									<p><label for="details_position_media">Position</label><input type="number" id="details_position_media" name="details_position_media" value="4"></p>
									<p><label for="details_annee_enregistrement">Année d'enregistrement</label><input type="number" id="details_annee_enregistrement" name="details_annee_enregistrement"></p>
									<p><label for="details_duree">Durée</label><input type="text" id="details_duree" name="details_duree" value="3:03"></p>
									<p>
										<label for="details_arrangeurs">Arrangeurs</label><!--
										--><span id="details_arrangeurs" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_arrangeurs" name="details_arrangeurs">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_artistes">Artistes</label><!--
										--><span id="details_artistes" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_arrangeurs" name="details_artistes">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_compositeurs">Compositeurs</label><!--
										--><span id="details_compositeurs" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_compositeurs" name="details_compositeurs">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
									<label for="details_parolier">Parolier</label><!--
										--><span id="details_parolier" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_parolier" name="details_parolier">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_interpretes">Interprètes</label><!--
										--><span id="details_interpretes" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_interpretes" name="details_interpretes">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_catalogueID">Catalogue</label><!--
										--><select id="details_catalogueID" name="details_catalogueID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_epoqueID">Époque</label><!--
										--><select id="details_epoqueID" name="details_epoqueID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_formeID">Forme</label><!--
										--><select id="details_formeID" name="details_formeID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_genreID">Genre</label><!--
										--><select id="details_genreID" name="details_genreID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_instrumentationID">Instrumentation</label><!--
										--><select id="details_instrumentationID" name="details_instrumentationID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_tonaliteID">Tonalité</label><!--
										--><select id="details_tonaliteID" name="details_tonaliteID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
								</div>
								<div class="detailsLevel2Row">
									<p><label for="details_titre">Titre</label><input type="text" id="details_titre" name="details_titre" value="Histoire de pêche"></p>
									<p><label for="details_position_media">Position</label><input type="number" id="details_position_media" name="details_position_media" value="5"></p>
									<p><label for="details_annee_enregistrement">Année d'enregistrement</label><input type="number" id="details_annee_enregistrement" name="details_annee_enregistrement"></p>
									<p><label for="details_duree">Durée</label><input type="text" id="details_duree" name="details_duree" value="3:09"></p>
									<p>
										<label for="details_arrangeurs">Arrangeurs</label><!--
										--><span id="details_arrangeurs" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_arrangeurs" name="details_arrangeurs">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_artistes">Artistes</label><!--
										--><span id="details_artistes" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_arrangeurs" name="details_artistes">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_compositeurs">Compositeurs</label><!--
										--><span id="details_compositeurs" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_compositeurs" name="details_compositeurs">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
									<label for="details_parolier">Parolier</label><!--
										--><span id="details_parolier" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_parolier" name="details_parolier">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_interpretes">Interprètes</label><!--
										--><span id="details_interpretes" class="detailsLevel3">
											<span class="rowLevel3">
												<select id="details_interpretes" name="details_interpretes">
													<option value="0"></option>
													<option value="1" selected>AAAAA</option>
													<option value="2">BBBBB</option>
													<option value="3">CCCCC</option>
													<option value="4">DDDDD</option>
													<option value="5">EEEEE</option>
												</select>
											</span>
										</span>
									</p>
									<p>
										<label for="details_catalogueID">Catalogue</label><!--
										--><select id="details_catalogueID" name="details_catalogueID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_epoqueID">Époque</label><!--
										--><select id="details_epoqueID" name="details_epoqueID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_formeID">Forme</label><!--
										--><select id="details_formeID" name="details_formeID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_genreID">Genre</label><!--
										--><select id="details_genreID" name="details_genreID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_instrumentationID">Instrumentation</label><!--
										--><select id="details_instrumentationID" name="details_instrumentationID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
									<p>
										<label for="details_tonaliteID">Tonalité</label><!--
										--><select id="details_tonaliteID" name="details_tonaliteID">
											<option value="0" selected></option>
											<option value="1">AAAAA</option>
											<option value="2">BBBBB</option>
											<option value="3">CCCCC</option>
											<option value="4">DDDDD</option>
											<option value="5">EEEEE</option>
										</select>
									</p>
								</div>
							</div>
							<button type="submit">Enregistrer</button>
							<button type="reset">Annuler</button>

				<?php
				}
				catch(Exception $e)
				{
					echo "<h1>Erreur</h1>\n";
					echo '<p>'.$e->getMessage()."<p>\n";
				}
				?>
			</form>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

