<?php
session_start();
unset($_SESSION['matricule']);
unset($_SESSION['mot_de_passe']);
header('Location: ../index.php');
?>
