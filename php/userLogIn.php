<?php
session_start();
try
{
	if(!isset($_POST['matricule']) || empty($_POST['matricule']))
		throw new Exception('Le numéro de matricule est obligatoire.');

	if(!isset($_POST['mot_de_passe']) || empty($_POST['mot_de_passe']))
		throw new Exception('Le mot de passe est obligatoire.');

	require_once('User.class.php');

	$user = new User(1);
	$user->setStudentNumber($_POST['matricule']);
	$user->setPassword($_POST['mot_de_passe']);

	$_SESSION['user'] = serialize($user);

	header('Location: ../index.php');
}
catch(Exception $e)
{
	echo 'Exception reçue : '.$e->getMessage();
}
?>
