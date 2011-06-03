<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title><?php echo Application::APPLICATION_NAME; ?> - Réservations en cours</title>
		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
		<script src="javascript/jquery/jquery.tablesorter.min.js"></script>
		<script>
			$(document).ready(function() {
				$('table').tablesorter();
			});
		</script>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<div>
				<?php
				if(!$application->currentUser->haveRights('reservations.php', $application->rights['read']))
				{
					echo '<h1>Erreur</h1>';
					echo '<p>Vous vous n\'avez pas les droits nécessaires pour accéder à cette page.<p>';
				}
				else
				{
					echo '<h1>Réservations en cours</h1>';
					$query = $application->database->prepare('
						SELECT medias.ID, 
							medias.titre, 
							emprunts.date_reservation, 
							emprunts.date_voulue, 
							emprunts.duree, 
							utilisateurs.nom, 
							utilisateurs.prenom 
						FROM medias 
							INNER JOIN emprunts ON medias.ID = emprunts.mediaID 
							INNER JOIN utilisateurs ON emprunts.utilisateurID = utilisateurs.ID
						WHERE emprunts.date_emprunt IS NULL AND emprunts.date_reservation IS NOT NULL');

					$query->execute();

					echo '<table>';
					echo '	<thead>';
					echo '		<tr>';
					echo '			<th>Média</th>';
					echo '			<th>Date de réservation</th>';
					echo '			<th>Date voulue</th>';
					echo '			<th>Durée (jours)</th>';
					echo '			<th>Utilisateur</th>';
					echo '		</tr>';
					echo '	</thead>';
					echo '	<tbody>';
					foreach($query as $row)
					{
						$dateReservation = DateTime::createFromFormat('Y-m-d', $row['date_reservation']);

						echo '	<tr>';
						echo '		<td><a href="media.php?id='.$row['ID'].'">'.$row['titre'].'</a></td>';
						echo '		<td>'.$dateReservation->format('Y-m-d').'</td>';
						echo '		<td>'.$row['date_voulue'].'</td>';
						echo '		<td>'.$row['duree'].'</td>';
						echo '		<td>'.$row['prenom'].' '.$row['nom'].'</td>';
						echo '		<td><a href="#" onclick="return confirm(\'Voulez-vous vraiment supprimer cet enregistrement?\');">Supprimer</a></td>';
						echo '	</tr>';
					}
					echo '	</tbody>';
					echo '</table>';
				}
				?>

			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

