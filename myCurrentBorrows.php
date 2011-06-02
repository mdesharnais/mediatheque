<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Marc-Andre Destrempes">

		<title>Emprunts en cours - Médiatech du département de musique du cégep de Trois-Rivières</title>
		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<div>
				<?php
				if($application->currentUser->isVisitor())
				{
					echo '<h1>Erreur</h1>';
					echo '<p>Vous devez être connectés pour consulter vos emprunts en cours.<p>';
				}
				else
				{
					echo '<h1>Mes emprunts en cours</h1>';
					$query = $application->database->prepare('
						SELECT medias.ID, 
							medias.titre, 
							emprunts.date_emprunt, 
							emprunts.duree 
						FROM medias 
							INNER JOIN emprunts ON medias.ID = emprunts.mediaID 
						WHERE emprunts.utilisateurID = ? AND emprunts.date_retour IS NULL AND emprunts.date_emprunt IS NOT NULL');

					$query->execute(array($application->currentUser->getID()));

					echo '<table>';
					echo '	<thead>';
					echo '		<tr>';
					echo '			<th>Média</th>';
					echo '			<th>Date d\'emprunt</th>';
					echo '			<th>Date de retour</th>';
					echo '		</tr>';
					echo '	</thead>';
					foreach($query as $row)
					{
						$dateEmprunt = DateTime::createFromFormat('Y-m-d', $row['date_emprunt']);
						$dateRetour = $dateEmprunt->add(new DateInterval('P'.$row['duree'].'D'));

						echo '	<tr>';
						echo '		<td><a href="media.php?id='.$row['ID'].'">'.$row['titre'].'</a></td>';
						echo '		<td>'.$dateEmprunt->format('Y-m-d').'</td>';
						echo '		<td>'.$dateRetour->format('Y-m-d').'</td>';
						echo '		<td><a href="#">Renouveler</a></td>';
						echo '	</tr>';
					}
					echo '</table>';
				}
				?>
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

