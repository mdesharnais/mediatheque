<?php require('sharedFiles/pageStart.inc.php'); ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Martin Desharnais">

		<title>Médiatech du département de musique du cégep de Trois-Rivières</title>

		<?php include('sharedFiles/style.inc.php'); ?>
		<?php include('sharedFiles/javascript.inc.php'); ?>
		<style>td {border-width: thin;padding: 5px;border-style: solid;border-color: black;background-color: #eee;-moz-border-radius: 0px 0px 0px 0px;}th {border-width: thin;padding: 5px;border-style: solid;border-color: black;background-color: #eee;-moz-border-radius: 0px 0px 0px 0px;} table {border-width: 0px;border-spacing: 2px;border-style: hidden;border-color: black;border-collapse: collapse;background-color: #eee;}</style>
	</head>
	<body>
		<?php require('sharedFiles/header.inc.php'); ?>
		<div id="content">
			<div>
				<h2>Heures d'ouvertures</h2>
				<table border="0">
				<tr>
				  <td>Lundi</td>
				  <td>8:00 - 16:00</td>
				</tr>   
				<tr>
				  <td>Mardi</td>
				  <td>Fermé</td>
				</tr>
				<tr>
				  <td>Mercredi</td>
				  <td>8:00 - 16:00</td>
				</tr>
				<tr>
				  <td>Jeudi</td>
				  <td>Fermé</td>
				</tr>
				<tr>
				  <td>Vendredi</td>
				  <td>Fermé</td>
				</tr>
				<tr>
				  <td>Samedi</td>
				  <td>Fermé</td>
				</tr>
				<tr>
				  <td>Dimanche</td>
				  <td>Fermé</td>
				</tr>
				</table>
			</div>
		</div>
		<?php require('sharedFiles/footer.inc.php'); ?>
	</body>
</html>

