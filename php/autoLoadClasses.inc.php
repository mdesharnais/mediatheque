<?php
function __autoload($className)
{
	if(file_exists("$className.class.php"))
		require_once("$className.class.php");
	elseif(file_exists("php/$className.class.php"))
		require_once("php/$className.class.php");
}
?>
