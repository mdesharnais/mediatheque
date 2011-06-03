<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title><?php echo Application::APPLICATION_NAME; ?> - Emprunts</title>
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
				if(!$application->currentUser->haveRights('borrows.php', $application->rights['read']))
				{
					echo '<h1>Erreur</h1>';
					echo '<p>Vous vous n\'avez pas les droits nécessaires pour accéder à cette page.<p>';
				}
				else
				{
					echo '<form method="GET" class="right">';
					echo '	<select id="t" name="t">';
					echo '		<option value="1"'.(isset($_GET['t']) && $_GET['t'] == 1 ? 'selected' : '').'>Emprunts en cours</option>';
					echo '		<option value="2"'.(isset($_GET['t']) && $_GET['t'] == 2 ? 'selected' : '').'>Historique des emprunts</option>';
					echo '	</select>';
					echo '	<button type="submit">Envoyer</button>';
					echo '</form>';

					$sql = '
						SELECT medias.ID, 
							medias.titre, 
							emprunts.date_reservation,
							emprunts.date_voulue,
							emprunts.duree,
							emprunts.date_emprunt, 
							emprunts.date_retour, 
							utilisateurs.nom, 
							utilisateurs.prenom 
						FROM medias 
							INNER JOIN emprunts ON medias.ID = emprunts.mediaID 
							INNER JOIN utilisateurs ON emprunts.utilisateurID = utilisateurs.ID';

					if(isset($_GET['t']) && $_GET['t'] == 1)
					{
						echo '<h1>Emprunts en cours</h1>';
						$sql .= ' WHERE emprunts.date_retour IS NOT NULL AND emprunts.date_emprunt IS NOT NULL';
					}
					else
					{
						echo '<h1>Historique des emprunts</h1>';
						$sql .= ' WHERE emprunts.date_retour IS NULL AND emprunts.date_emprunt IS NOT NULL';
					}

					$query = $application->database->prepare($sql);
					$query->execute();

					echo '<table>';
					echo '	<thead>';
					echo '		<tr>';
					echo '			<th>Média</th>';
					echo '			<th>Date de réservation</th>';
					echo '			<th>Date voulue</th>';
					echo '			<th>Durée voulue (jours)</th>';
					echo '			<th>Date d\'emprunt</th>';
					echo '			<th>Date de retour</th>';
					echo '			<th>Utilisateur</th>';
					echo '		</tr>';
					echo '	</thead>';
					echo '	<tbody>';
					foreach($query as $row)
					{
						echo '	<tr>';
						echo '		<td><a href="media.php?id='.$row['ID'].'">'.$row['titre'].'</a></td>';
						echo '		<td>'.$row['date_reservation'].'</td>';
						echo '		<td>'.$row['date_voulue'].'</td>';
						echo '		<td>'.$row['duree'].'</td>';
						echo '		<td>'.$row['date_emprunt'].'</td>';
						echo '		<td>'.$row['date_retour'].'</td>';
						echo '		<td>'.$row['prenom'].' '.$row['nom'].'</td>';
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

