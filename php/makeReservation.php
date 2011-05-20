<?php

if (strlen($_SERVER['QUERY_STRING']) == 0) {
	$utilisateur = Null;
	$media = Null;
}
else {
	$utilisateur=$_GET['utilisateur'];
	$media=$_GET['media'];
}

echo "<form id='reservation'>";
//echo date("D j M Y")."<br>";
echo "<input type='hidden' id='ID' name='ID'><br>";
echo "<label id='lblUtilisateurID' for='utilisateurID'>Utilisateur</label>";
echo "<input type='number' id='utilisateurID' name='utilisateurID' value='".$utilisateur."'><br>";
echo "<?php ";
echo "include('php/setDateList.php');";
echo "?>";
echo "<label for='mediaID'>Media</label>";
echo "<input type='number' id='mediaID' name='mediaID' value='".$media."'><br>";
echo "<input type='submit' Action='php/submitReservation.php'>";
echo "</form>";
?>
