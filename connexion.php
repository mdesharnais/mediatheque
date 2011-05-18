<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title>Médiatech du département de musique du cégep de Trois-Rivières</title>

		<link rel="stylesheet" href="css/style1.css">
		<link rel="icon" href="images/logoCegep.svg">

		<script src="javascript/jquery/jquery.js"></script>
		<script src="javascript/vertical-breadcrumb.js"></script>

		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<form>
				<h2>Connexion</h2>
				<label for="matricule">Matricule</label>
				<input type="text" id="matricule" name="matricule">
				<br>
				<label for="mot_de_passe">Mot de passe</label>
				<input type="password" id="mot_de_passe" name="mot_de_passe">
				<br>
				<input type="submit">
			</form>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

