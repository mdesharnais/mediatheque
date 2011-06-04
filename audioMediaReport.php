<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Marc-Andre Destrempes">

		<title>Rapports Média Audio - Médiatech du département de musique du cégep de Trois-Rivières</title>
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
				$sql="SELECT ID, nom FROM genres ORDER BY 1";
	
				$query = $application->database->prepare($sql);
				$query->execute();

				echo '<form name="input" method="get">';
				echo '<label for="genreID">Genre</label>';
				echo '<select id="genreID" name="genreID">';
				foreach($query as $row)
				{
					echo '<option value='.$row['ID'].'>'.$row['nom'].'</option>';
				}
				echo '</select>';
				echo '<button type="submit">Envoyer</button>';
				echo '</form>';
				
				// if param exist generate report else do nothing
			?>
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>
