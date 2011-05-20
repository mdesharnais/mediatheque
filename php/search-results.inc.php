<?php
require_once('Application.class.php');

function printSearchResults($sqlQuery)
{
	global $application;

	$query = $application->database->prepare($sqlQuery);
	$query->execute();
	
	foreach($query as $row)
	{
	
	echo $row['titre'];
	
	
	}

}

?>
