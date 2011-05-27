<?php

if (strlen($_SERVER['QUERY_STRING']) == 0) {
	$utilisateur = $application->currentUser->getID();
	$media = Null;
}
else {
	$media=$_GET['media'];
	if ($application->currentUser->isVisitor()) {
		$utilisateur = Null;
	}
	else {
		$utilisateur = $application->currentUser->getID();
	}
}

if (is_null($utilisateur)) {
	echo "Vous devez être connecté.";
}
elseif (is_null($media)) {
	echo "Vous devez avoir sélectionné un média.";
}
else {
	echo "<form id='reservation' Action='php/submitReservation.php'>";
	echo "<script src='javascript/generateReservation.js' ></script>";
	include('php/setDateList.php');
	echo "<input type='submit' Value='Enregistrer'>";
	echo "</form>";
}
?>
