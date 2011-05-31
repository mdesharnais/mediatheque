<?php
require_once('Application.class.php');
require_once('Media.class.php');

class AudioMedia extends Media
{
	//////////////////////////////////////////////////
	// Attribute(s)
	//////////////////////////////////////////////////

	protected $nationality;
	protected $universalProductCode;
	protected $collection;
	protected $positionInCollection;

	public $tracks;

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
				audios_videos.CUP, 
				audios_videos.position_collection, 
				maisons_edition.nom AS maison_edition, 
				supports.nom AS support, 
				categories_media.image AS imageCategorieMedia, 
				nationalites.nom AS nationalite, 
				collections.nom AS collection, 
				genres.nom AS genre 
			FROM medias 
				INNER JOIN audios_videos ON audios_videos.exID = medias.ID 
				LEFT JOIN maisons_edition ON maisons_edition.ID = medias.maison_editionID 
				INNER JOIN supports ON supports.ID = medias.supportID 
				INNER JOIN categories_media ON categories_media.ID = supports.categorie_mediaID 
				LEFT JOIN nationalites ON nationalites.ID = audios_videos.nationaliteID 
				LEFT JOIN collections ON collections.ID = audios_videos.collectionID 
				LEFT JOIN genres ON medias.genreID = genres.ID 
			WHERE medias.ID = ?');
		$query->execute(array($id));
		$row = $query->fetch();

		parent::__construct($row);

		if($row != null)
		{
			$this->nationality = stripslashes($row['nationalite']);
			$this->universalProductCode = stripslashes($row['CUP']);
			$this->collection = stripslashes($row['collection']);
			$this->positionInCollection = $row['position_collection'];
		}

		$query = $application->database->prepare('
			SELECT pieces.ID AS id, 
				pieces.position_media, 
				pieces.titre 
			FROM pieces 
				INNER JOIN audios_videos ON audios_videos.ID = pieces.exID
			WHERE audios_videos.exID = ?');
		$query->execute(array($id));

		$this->tracks = array();

		foreach($query as $row)
		{
			$track = new Track($row['id']);
			$track->setPosition($row['position_media']);
			$track->setTitle($row['titre']);

			$this->tracks[] = $track;
		}
	}

	//////////////////////////////////////////////////
	// Get(s)
	//////////////////////////////////////////////////

	public function getNationality()
	{
		return $this->nationality;
	}

	public function getUniversalProductCode()
	{
		return $this->universalProductCode;
	}

	public function getCollection()
	{
		return $this->collection;
	}

	public function getPositionInCollection()
	{
		return $this->positionInCollection;
	}

	//////////////////////////////////////////////////
	// Set(s)
	//////////////////////////////////////////////////

	//////////////////////////////////////////////////
	// Methods(s)
	//////////////////////////////////////////////////

	public function printNationalityField()
	{
		global $application;
		echo '<label for="nationaliteID">Nationalité</label>';

		if($this->readOnly)
		{
			echo '<span>'.$this->getNationality().'</span>';
		}
		else
		{
			$query = $application->database->prepare('SELECT ID, nom FROM nationalites WHERE inactif = FALSE OR nom = ? ORDER BY nom ASC');
			$query->execute(array($this->getNationality()));

			echo '<select id="nationaliteID" name="nationaliteID">';
			echo '<option value="0"></option>';
			foreach($query as $row)
			{
				if($row['nom'] == $this->getNationality())
					echo '<option value="'.$row['ID'].'" selected>'.$row['nom'].'</option>';
				else
					echo '<option value="'.$row['ID'].'">'.$row['nom'].'</option>';
			}
			echo '</select>';
		}
	}

	public function printUniversalProductCodeField()
	{
		echo '<label for="CUP">CUP</label>';

		if($this->readOnly)
		{
			echo '<span>'.$this->getUniversalProductCode().'</span>';
		}
		else
		{
			echo '<input type="number" id="CUP" name="CUP"';

			if(isset($this->universalProductCode))
				echo ' value="'.$this->getUniversalProductCode().'"';

			echo '>';
		}
	}

	public function printCollectionField()
	{
		global $application;
		echo '<label for="collectionID">Collection</label>';

		if($this->readOnly)
		{
			echo '<span>'.$this->getCollection().'</span>';
		}
		else
		{
			$query = $application->database->prepare('SELECT ID, nom FROM collections WHERE inactif = FALSE OR nom = ? ORDER BY nom ASC');
			$query->execute(array($this->getCollection()));

			echo '<select id="collectionID" name="collectionID">';
			echo '<option value="0"></option>';
			foreach($query as $row)
			{
				if($row['nom'] == $this->getCollection())
					echo '<option value="'.$row['ID'].'" selected>'.$row['nom'].'</option>';
				else
					echo '<option value="'.$row['ID'].'">'.$row['nom'].'</option>';
			}
			echo '</select>';
		}
	}

	public function printPositionInCollectionField()
	{
		echo '<label for="position_collection">Position</label>';

		if($this->readOnly)
		{
			echo '<span>'.$this->getPositionInCollection().'</span>';
		}
		else
		{
			echo '<input type="number" id="position_collection" name="position_collection" min="0"';

			if(isset($this->positionInCollection))
				echo ' value="'.$this->getPositionInCollection().'"';

			echo '>';
		}
	}
}
?>
