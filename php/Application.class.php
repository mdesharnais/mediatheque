<?php
require_once('autoLoadClasses.inc.php');

class Application
{
	public $database;
	public $currentUser;

	const DATABASE_HOST = 'localhost';
	const DATABASE_NAME = 'mediatheque';
	const DATABASE_USERNAME = 'website';
	const DATABASE_PASSWORD = '1234';

	public $rights = array(
		'read' => 1,
		'write' => 2,
		'execute' => 4);

	public function __construct()
	{
		try
		{
			$this->database = new PDO(
				'mysql:host='.self::DATABASE_HOST.
				';dbname='.self::DATABASE_NAME,
				self::DATABASE_USERNAME,
				self::DATABASE_PASSWORD);

			if(isset($_SESSION['user']))
				$this->currentUser = unserialize($_SESSION['user']);
			else
				$this->currentUser = new User();
		}
		catch(PDOExecption $e)
		{
			echo $e.getMessage();
		}
	}
}

$application = new Application();
?>
