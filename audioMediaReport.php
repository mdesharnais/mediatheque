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
				}
			?>
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>
