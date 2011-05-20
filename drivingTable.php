<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title>Médiatech du département de musique du cégep de Trois-Rivières</title>

		<link rel="stylesheet" href="css/style1.css">
		<link rel="icon" href="images/logoCegep.svg">

		<?php include('sharedFiles/javascript.inc.php'); ?>
		<script src="javascript/jquery/jquery.tablesorter.min.js"></script>
		<script src="javascript/driving-table.js"></script>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<?php
			if($application->currentUser->haveRights(__FILE__, $application->rights['read'] | $application->rights['write']))
			{
				require('php/drivingTables.inc.php');

				if(isset($_GET['table']))
					printDrivingTable($_GET['table']);
				else
					echo "Aucune table sélectionnée";
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
