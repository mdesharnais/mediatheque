<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title><?php echo Application::APPLICATION_NAME; ?> - Détails de l'utilisateur</title>

		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
<!--
		<style>
			form label
			{
				width: 5em;
			}
		</style>
-->
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<div>
				<?php
				try
				{
					if(!$application->currentUser->haveRights('user.php', $application->rights['read'] | $application->rights['write']))
					{
						echo '<h1>Erreur</h1>';
						echo '<p>Vous vous n\'avez pas les droits nécessaires pour accéder à cette page.<p>';
					}
					else
					{
						if(isset($_GET['id']))
							$user = User::getInstanceOf($_GET['id']);
						else
							$user = new User();

						echo '<h1>Utilisateurs</h1>';
						?>
						<form>
							<input type="hidden" id="ID" name="ID" value="<?php echo $user->getID(); ?>">
							<p><label for="matricule">Matricule</label><input type="text" id="matricule" name="matricule" value="<?php echo $user->getStudentNumber(); ?>" required></p>
							<p><label for="nom">Nom</label><input type="text" id="nom" name="nom" value="<?php echo $user->getLastName(); ?>" required></p>
							<p><label for="prenom">Prenom</label><input type="text" id="prenom" name="prenom" value="<?php echo $user->getFirstName(); ?>" required></p>
							<p><label for="telephone">Telephone</label><input type="text" id="telephone" name="telephone" value="<?php echo $user->getTelephoneNumber(); ?>" required></p>
							<p><label for="courriel">Courriel</label><input type="text" id="courriel" name="courriel" value="<?php echo $user->getEmailAddress(); ?>"></p>
							<p>
								<label for="groupes">Groupes</label><!--
								--><select id="courriel" name="courriel" multiple>
								<?php
								$query = $application->database->prepare('
									SELECT ID, nom FROM groupes WHERE inactif = FALSE');
								$query->execute();
								foreach($query as $row)
									echo '<option value="'.$row['ID'].'">'.$row['nom'].'</option>';
								?>
								</select>
							</p>
							<button type="sumbit">Enregistrer</button>
							<button type="reset">Annuler</button>
						</form>
						<?php
					}
				}
				catch(Exception $e)
				{
					echo "<h1>Erreur</h1>\n";
					echo '<p>'.$e->getMessage()."<p>\n";
				}
				?>
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

