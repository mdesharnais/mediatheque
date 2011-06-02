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
		<div id="content">
			<div>
				<?php
				if($application->currentUser->isVisitor())
				{
					echo '<h1>Erreur</h1>';
					echo '<p>Vous devez être connectés pour consulter vos réservations.<p>';
				}
				else
				{
					echo '<h1>Mes réservations</h1>';
					$query = $application->database->prepare('
						SELECT medias.ID, 
							medias.titre, 
							emprunts.date_reservation
						FROM medias 
							INNER JOIN emprunts ON medias.ID = emprunts.mediaID 
						WHERE emprunts.utilisateurID = ? AND emprunts.date_emprunt IS NULL AND emprunts.date_reservation IS NOT NULL');

					$query->execute(array($application->currentUser->getID()));

					echo '<table>';
					echo '	<thead>';
					echo '		<tr>';
					echo '			<th>Média</th>';
					echo '			<th>Date de réservation</th>';
					echo '			<th>Position dans la file</th>';
					echo '		</tr>';
					echo '	</thead>';
					foreach($query as $row)
					{
						$query2 = $application->database->prepare('
							SELECT COUNT(ID) + 1 AS position
							FROM emprunts
							WHERE mediaID = :media AND utilisateurID <> :user AND date_emprunt IS NULL AND date_reservation IS NOT NULL AND date_reservation < :date');

						$query2->execute(array(
							':media' => $row['ID'],
							':user'  => $application->currentUser->getID(),
							':date'  => $row['date_reservation']));

						$data = $query2->fetch();

						$dateReservation = DateTime::createFromFormat('Y-m-d', $row['date_reservation']);

						echo '	<tr>';
						echo '		<td><a href="media.php?id='.$row['ID'].'">'.$row['titre'].'</a></td>';
						echo '		<td>'.$dateReservation->format('Y-m-d').'</td>';
						echo '		<td>'.$data['position'].'</td>';
						echo '		<td><a href="#" onclick="return confirm(\'Voulez-vous vraiment supprimer cet enregistrement?\');">Supprimer</a></td>';
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

