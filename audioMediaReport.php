<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Marc-Andre Destrempes">

		<title><?php echo Application::APPLICATION_NAME; ?> - Rapport sur les médias audios</title>
		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
		<style>
			form label
			{
				width: 4.5em;
			}
		</style>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<div>
			<?php
				if(!$application->currentUser->haveRights('audioMediaReport.php', $application->rights['read']))
				{
					echo '<h1>Erreur</h1>';
					echo '<p>Vous vous n\'avez pas les droits nécessaires pour accéder à cette page.<p>';
				}
				else
				{
					$query = $application->database->prepare('SELECT ID, nom FROM genres ORDER BY nom');
					$query->execute();

					echo '<form method="GET">';
					echo '<label for="genreID">Genre</label>';
					echo '<select id="genreID" name="genreID">';
					foreach($query as $row)
						echo '<option value='.$row['ID'].(isset($_GET['genreID']) && $_GET['genreID'] == $row['ID'] ? ' selected' : '').'>'.$row['nom'].'</option>';
					echo '</select>';
					echo '<button type="submit">Envoyer</button>';
					echo '</form>';
				
					// if param exist generate report else do nothing
					if (isset($_GET['genreID']))
					{
					//catalogue, no de catalogue, titre, compositeur, interprète, titre de l'album/notes, référence
					//RESTE CATALOGUE, NO CATALOGUE ET INTERPRETE A METTRE
						$sql="SELECT exemplaires_medias.reference as reference, medias.titre as titre, medias.annee_publication as annee_publication, medias.notes as notes, maisons_edition.nom as menom, supports.nom as cnom FROM medias 
							INNER JOIN maisons_edition ON medias.maison_editionID = maisons_edition.ID 
							INNER JOIN supports ON medias.supportID = supports.ID 
							INNER JOIN exemplaires_medias ON medias.ID = exemplaires_medias.exID
							WHERE medias.genreID = '".$_GET['genreID']."' ORDER BY 1,2,3";
						$query = $application->database->prepare($sql);
						$query->execute();
						
						echo '<table>';
						echo '<tr>';
						echo '<th>Référence</th>';
						echo '<th>Titre</th>';
						echo '<th>Année de publication</th>';
						echo '<th>Maison d\'édition</th>';
						echo '<th>Support</th>';
						echo '<th>Notes</th>';
						echo '</tr>';
						foreach($query as $row)
						{
							echo '<tr>';
							echo '<td>'.$row['reference'].'</td>';
							echo '<td>'.$row['titre'].'</td>';
							echo '<td>'.$row['annee_publication'].'</td>';
							echo '<td>'.$row['menom'].'</td>';
							echo '<td>'.$row['cnom'].'</td>';
							echo '<td>'.$row['notes'].'</td>';
							echo '</tr>';
						}
						echo '</table>';
					}
				}
			?>
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>
