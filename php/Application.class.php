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
			$this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			if(isset($_SESSION['user']))
				$this->currentUser = unserialize($_SESSION['user']);
			else
				$this->currentUser = new User();
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	/*Fonction qui retourne le champ "nom" de l'enregistrement d'une table de pilotage à
	partir de son ID*/
	public function getDrivingTableElementName($tableName,$ID)
	{
			
						
		foreach($this->database->query("SELECT nom from ".$tableName." WHERE ID=".$ID) as $row)
			$nom = $row['nom'];
		
		if (isset($nom))
			return $nom;
		else
			return 'Non définie';
		
	}
	
	/*Fonction qui retourne un champ d'identification unique (ex: categorieMediaID)
	dans un enregistrement d'une table	Exemple d'utilisation: Je suis actuellement dans des enregistrements de la 
	table "médias" et je veux avoir le ID de la catégorie de média utilisée par le support de média courant.
	 getFurtherRowID('supports','categorieMediaID',$row['supportID']);
	*/
	public function getFurtherRowID($tableName,$fieldName,$ID)
	{
									
		foreach($this->database->query("SELECT ".$fieldName. " from ".$tableName." WHERE ID=".$ID) as $row)
			$otherID = $row[$fieldName];
		
		if (isset($otherID))
			return $otherID;
		else
			return 0;
	}
}

$application = new Application();
?>
