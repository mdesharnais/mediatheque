<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Marc-Andre Destrempes">

		<title><?php echo Application::APPLICATION_NAME; ?> - Retours</title>

		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
		<script src="javascript/generateEmprunt.js"></script>
		<style>.tooltip{display:none;background:url(images/black_arrow_big.png);height:163px;padding:40px 30px 10px 30px;width:310px;font-size:11px;color:#fff;}#outerDiv{min-width: 200px;}div.autosize{display:table;height:1px;}div.autosize>div{display:table-cell;}table, tr, th, td{border: 0px solid black;}</style>
		<script src='javascript/jquery/jquery.tools.min.js'></script>

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
				echo '<form id="emprunt" action="php/do_return.php">';
				echo '<input type="hidden" id="ID" name="ID"><br>';
				echo '<label id="lblUtilisateurID" for="utilisateurID">Matricule de l\'utilisateur</label>';
				echo '<input type="number" id="utilisateurID" name="utilisateurID"><br>';
				echo '<label for="mediaID">No. Référence</label>';
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

