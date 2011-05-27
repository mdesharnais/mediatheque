<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title>Médiatech du département de musique du cégep de Trois-Rivières</title>

		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
		<script src="javascript/generateEmprunt.js"></script>
		<style>.tooltip{display:none;background:url(http://static.flowplayer.org/tools/img/tooltip/black_arrow_big.png);height:163px;padding:40px 30px 10px 30px;width:310px;font-size:11px;color:#fff;}#outerDiv{min-width: 200px;}div.autosize{display:table;height:1px;}div.autosize>div{display:table-cell;}</style>
		<script src='http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js'></script>

	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
		<?php
			if($application->currentUser->haveRights(__FILE__, $application->rights['read'] | $application->rights['write']))
			{
				echo '<div>';
				echo '<img src="images/emprunt.png" />';
				echo '<h1>Retour</h1>';
				echo '<form id="emprunt" action="/php/do_borrow.php">';
				echo '<input type="hidden" id="ID" name="ID"><br>';
				echo '<label id="lblUtilisateurID" for="utilisateurID">Utilisateur</label>';
				echo '<input type="number" id="utilisateurID" name="utilisateurID"><br>';
				echo '<label for="mediaID">Media</label>';
				echo '<input type="number" id="mediaID" name="mediaID"><br>';
				echo '<input type="submit" value="Enregistrer">';
				echo '</form>';
				echo '</div>';
			}
			else
			{
				echo '<div class="error">';
				echo '    <h2>Erreur</h2>';
				echo '    Vous n\'avez pas les droits nécessaires pour accéder à cette page.';
				echo '</div>';
			}
			?>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

