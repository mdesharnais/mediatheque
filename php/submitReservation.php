<?php
if (strlen($_SERVER['QUERY_STRING']) == 0) {
	$utilisateur = Null;
	$media = Null;
}
else {
	$utilisateur=$_GET['utilisateurID'];
	$media=$_GET['mediaID'];
	echo "<script>alert('La reservation pour le media ".$media." pour le ".$date." a ete effectue avec succes.')</script>";
}
