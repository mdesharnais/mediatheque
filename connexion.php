<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title>Médiatech du département de musique du cégep de Trois-Rivières</title>

		<?php require('sharedFiles/style.inc.php'); ?>
		<?php require('sharedFiles/javascript.inc.php'); ?>

		<script src="javascript/vertical-breadcrumb.js"></script>

	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<form method="post" action="php/userLogIn.php">
				<h2>Connexion</h2>
				<p>
				<label for="matricule">Matricule</label>
				<input type="text" id="matricule" name="matricule">
				</p>
				<p>
				<label for="mot_de_passe">Mot de passe</label>
				<input type="password" id="mot_de_passe" name="mot_de_passe">
				</p>
				<input type="hidden" id="page_precedente" name="page_precedente" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
				<input type="submit">
			</form>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

