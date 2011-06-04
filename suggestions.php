<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Samuel Milette-Lacombe">

		<title>Carcajou - Suggestions de médias</title>

		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
		<div>
		<h2>Suggestions</h2>
		<?php
			if($application->currentUser->isVisitor())
				echo "Vous devez être connecté pour émettre des suggestions de médias.";
			else
			{
			echo '
			<form id="suggestion" method="post" action="php/sendSuggestion.php">
			<p><label for="titre">Titre</label>
			<input type="text" id="titre" name="titre" maxlength="75" REQUIRED>
			</p>
			<p><label for="artiste">Artiste</label>
			<input type="text" id="artiste" name="artiste" maxlength="75">
			
			</p>
			<p><label for="typeSupport">Type de support</label>';
			$query = $application->database->prepare('SELECT nom FROM supports WHERE inactif = FALSE ORDER BY nom ASC');
			$query->execute();

			echo '<select id="typeSupport" name="typeSupport">';
			echo '<option value="0"></option>';
			foreach($query as $row)
			{
				echo '<option value="'.$row['nom'].'">';
				echo $row['nom'];
				echo '</option>';
			}
			echo '</select>';
			echo '
			</p>
			
			<p><label for="commentaire">Commentaire</label>
			<input type="text" id="commentaire" name="commentaire" maxlength="75">
			</p>
			<button type="submit">Envoyer</button> 
			</form>
			';
			}
			?>
		</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

