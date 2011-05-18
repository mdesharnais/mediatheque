<?php
session_start();
try
{
	if(!isset($_POST['matricule']) || empty($_POST['matricule']))
		throw new Exception('Le numéro de matricule est obligatoire.');

	if(!isset($_POST['mot_de_passe']) || empty($_POST['mot_de_passe']))
		throw new Exception('Le mot de passe est obligatoire.');

	$_SESSION['matricule'] = $_POST['matricule'];
	$_SESSION['mot_de_passe'] = $_POST['mot_de_passe'];

	header('Location: ../index.php');
}
catch(Exception $e)
{
	echo 'Exception reçue : '.$e->getMessage();
}
?>
