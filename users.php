<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title><?php echo Application::APPLICATION_NAME; ?> - Gestion des utilisateurs</title>
		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
		<style>
			form label
			{
				width: 5em;
			}

			p a:first-child
			{
				margin-right: 1em;
			}
		</style>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<div>
				<?php
				if(!$application->currentUser->haveRights('users.php', $application->rights['read']))
				{
					echo '<h1>Erreur</h1>';
					echo '<p>Vous vous n\'avez pas les droits nécessaires pour accéder à cette page.<p>';
				}
				else
				{
					echo '<form method="GET" class="right">';
					echo '	<label for="groupeID">Groupe</label>';
					echo '	<select id="groupeID" name="groupeID">';
					echo '		<option value="0">Tous</option>';
					foreach($application->database->query('SELECT ID, nom FROM groupes WHERE inactif = FALSE') as $row)
						echo '		<option value="'.$row['ID'].'"'.(isset($_GET['groupeID']) && $_GET['groupeID'] == $row['ID'] ? ' selected' : '').'>'.$row['nom'].'</option>';
					echo '	</select>';
					echo '	<button type="submit">Envoyer</button>';
					echo '</form>';

					echo '<h1>Utilisateurs</h1>';
					$sql = '
						SELECT utilisateurs.ID,
							utilisateurs.matricule,
							utilisateurs.nom,
							utilisateurs.prenom 
						FROM utilisateurs
							LEFT JOIN groupes_utilisateurs ON groupes_utilisateurs.exID = utilisateurs.ID 
							LEFT JOIN groupes ON groupes.ID = groupes_utilisateurs.groupeID';

					if(isset($_GET['groupeID']) && $_GET['groupeID'] != 0)
						$sql .= ' WHERE groupes.ID = ? AND groupes.inactif = FALSE';

					$sql .= ' GROUP BY utilisateurs.ID, utilisateurs.matricule, utilisateurs.nom, utilisateurs.prenom';
					$query = $application->database->prepare($sql);

					if(isset($_GET['groupeID']) && $_GET['groupeID'] != 0)
						$query->execute(array($_GET['groupeID']));
					else
						$query->execute();

					echo '<p>';
					echo '<a href="user.php">Ajouter</a>';
					echo '<a href="#">Importer</a>';
					echo '</p>';

					echo '<table>';
					echo '	<thead>';
					echo '		<tr>';
					echo '			<th>Matricule</th>';
					echo '			<th>Nom</th>';
					echo '			<th>Prenom</th>';
					echo '		</tr>';
					echo '	</thead>';
					echo '	<tbody>';
					foreach($query as $row)
					{
						echo '	<tr>';
						echo '		<td>'.$row['matricule'].'</td>';
						echo '		<td>'.$row['nom'].'</td>';
						echo '		<td>'.$row['prenom'].'</td>';
						if($application->currentUser->haveRights('users.php', $application->rights['write']))
						{
							echo '		<td><a href="user.php?id='.$row['ID'].'">Modifier</a></td>';
							echo '		<td><a href="#" onclick="return confirm(\'Voulez-vous vraiment supprimer cet enregistrement?\');">Supprimer</a></td>';
						}
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

