<?php
require_once('Application.class.php');
require_once('Media.class.php');

class PrintedMedia extends Media
{
	//////////////////////////////////////////////////
	// Attribute(s)
	//////////////////////////////////////////////////

	//////////////////////////////////////////////////
	// Constructor
	//////////////////////////////////////////////////

	public function __construct($id = null)
	{
		global $application;

		$query = $application->database->prepare('
			SELECT medias.ID, 
				medias.titre, 
				medias.annee_publication, 
				medias.reference, 
				medias.notes, 
				medias.image, 
				maisons_edition.nom AS maison_edition, 
				supports.nom AS support, 
				categories_media.image AS imageCategorieMedia, 
				genres.nom AS genre, 
				artistes.nom AS artiste 
			FROM medias 
				LEFT JOIN maisons_edition ON maisons_edition.ID = medias.maison_editionID 
				INNER JOIN supports ON supports.ID = medias.supportID 
				INNER JOIN categories_media ON categories_media.ID = supports.categorie_mediaID 
				LEFT JOIN genres ON medias.genreID = genres.ID 
				LEFT JOIN artistes ON medias.artisteID = artistes.ID 
			WHERE medias.ID = ?');
		$query->execute(array($id));
		$row = $query->fetch();

		parent::__construct($row);

		if($row != null)
		{
		}
	}

	//////////////////////////////////////////////////
	// Get(s)
	//////////////////////////////////////////////////

	//////////////////////////////////////////////////
	// Set(s)
	//////////////////////////////////////////////////

	//////////////////////////////////////////////////
	// Methods(s)
	//////////////////////////////////////////////////

}
?>
