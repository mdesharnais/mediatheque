<?php

if (strlen($_SERVER['QUERY_STRING']) == 0) {
	$utilisateur = Null;
	$media = Null;
}
else {
	$utilisateur=$_GET['utilisateur'];
	$media=$_GET['media'];
}

if (is_null($utilisateur)) {
	echo "Vous devez etre connecte.";
}
elseif (is_null($media)) {
	echo "Vous devez avoir selectionne un media.";
}
else {
	echo "<form id='reservation' Action='php/submitReservation.php'>";
	echo "<script src='javascript/generateReservation.js' ></script>";
	include('php/setDateReservation.php');
	echo "<input type='submit' Value='Enregistrer'>";
	echo "</form>";
}
?>
