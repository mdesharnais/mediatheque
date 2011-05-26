<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title>Médiatech du département de musique du cégep de Trois-Rivières</title>
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
				<h1>Mes Reservations</h1><br>
					<?php
						include("php/myReservations.php");
					?>
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

