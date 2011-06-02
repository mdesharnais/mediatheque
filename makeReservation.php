<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Marc-Andre Destrempes">

		<title>Réservation - Médiatech du département de musique du cégep de Trois-Rivières</title>
		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
		<style>.tooltip{display:none;background:url(http://static.flowplayer.org/tools/img/tooltip/black_arrow_big.png);height:163px;padding:40px 30px 10px 30px;width:310px;font-size:11px;color:#fff;}#outerDiv{min-width: 200px;}div.autosize{display:table;height:1px;}div.autosize>div{display:table-cell;}</style>
		<script src='http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js'></script>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<div>
			<img src="images/reservation.png" />
				<h1>Réservation</h1><br>
					<?php
						try
						{
							if(!isset($_GET['id']) || is_null($_GET['id']))
								throw new Exception('Le parametre ID est obligatoire.');

							if($application->currentUser->isVisitor())
								throw new Exception('Vous devez être connecté.');
		
							if(!$application->currentUser->haveRights('makeReservation', $application->rights['execute']))
								throw new Exception('Vous n\'avez pas les droits nécessaires.');

							echo "<form id='reservation' Action='php/submitReservation.php'>";
							echo "<script src='javascript/generateReservation.js' ></script>";
							include('php/setDateList.php');
							echo "<input type='submit' Value='Enregistrer'>";
							echo "</form>";
						}
						catch(Exception $e)
						{
							echo ''.$e->getMessage();
						}
					?>
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>
