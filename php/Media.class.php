<?php
require_once('Application.class.php');

abstract class Media
{
	//////////////////////////////////////////////////
	// Attribute(s)
	//////////////////////////////////////////////////

	const READ_ONLY = 1;
	const READ_WRITE = 2;

	protected $ID;
	protected $title;
	protected $publicationYear;
	protected $referenceNumber;
	protected $publishingHouse;
	protected $support;
	protected $description;
	protected $image;
	protected $supportImage;

	protected $readOnly;

	//////////////////////////////////////////////////
	// Constructor
	//////////////////////////////////////////////////

	public function __construct($row = null)
	{
		if($row != null)
		{
			$this->ID = $row['ID'];
			$this->title = stripslashes($row['titre']);
			$this->publicationYear = $row['annee_publication'];
			$this->referenceNumber = stripslashes($row['reference']);
			$this->publishingHouse = stripslashes($row['maison_edition']);
			$this->support = stripslashes($row['support']);
			$this->description = stripslashes($row['notes']);
			$this->image = stripslashes($row['image']);
			$this->supportImage = stripslashes($row['imageCategorieMedia']);

			$this->readOnly = true;
		}
	}

	//////////////////////////////////////////////////
	// Get(s)
	//////////////////////////////////////////////////

	public function getID()
	{
		return $this->ID;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getPublicationYear()
	{
		return $this->publicationYear;
	}

	public function getReferenceNumber()
	{
		return $this->referenceNumber;
	}

	public function getPublishingHouse()
	{
		return $this->publishingHouse;
	}

	public function getSupport()
	{
		return $this->support;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getImage()
	{
		if($this->image != null)
			return 'images/medias/'.$this->image;
		else
			return 'images/typesMedia/'.$this->supportImage;
	}

	public static function getInstanceOf($id)
	{
		global $application;

		$query = $application->database->prepare('
			SELECT categories_media.nom AS typeMedia 
			FROM medias 
				INNER JOIN supports ON supports.ID = medias.supportID 
				INNER JOIN categories_media ON categories_media.ID = supports.categorie_mediaID 
			WHERE medias.ID = ?');
		$query->execute(array($_GET['id']));
		$row = $query->fetch();
		
		if($row == false)
			throw new Exception("Le média demandé n'existe pas.");

		switch($row['typeMedia'])
		{
		case 'Imprimé':
			$media = new PrintedMedia($id);
			break;

		case 'Audio':
			$media = new AudioMedia($id);
			break;

		case 'Vidéo':
			$media = new VideoMedia($id);
			break;
		}

		return $media;
	}

	//////////////////////////////////////////////////
	// Set(s)
	//////////////////////////////////////////////////

	public function setMode($mode)
	{
		switch($mode)
		{
		case self::READ_ONLY:
			$this->readOnly = true;
			break;
		case self::READ_WRITE:
			$this->readOnly = false;
			break;
		}
	}

	//////////////////////////////////////////////////
	// Methods(s)
	//////////////////////////////////////////////////

	public function printTitleField()
	{
		echo '<label for="titre">Titre</label>';

		if($this->readOnly)
		{
			echo '<span>'.$this->getTitle().'</span>';
		}
		else
		{
			echo '<input type="text" id="titre" name="titre" maxlength="75"';

			if(isset($this->title))
				echo ' value="'.$this->getTitle().'"';

			echo ' required>';
		}
	}

	public function printPublicationYearField()
	{
		echo '<label for="annee_publication">Année de publication</label>';

		if($this->readOnly)
		{
			echo '<span>'.$this->getPublicationYear().'</span>';
		}
		else
		{
			echo '<input type="number" id="annee_publication" name="annee_publication"';

			if(isset($this->publicationYear))
				echo ' value="'.$this->getPublicationYear().'"';

			echo '>';
		}
	}

	public function printReferenceNumberField()
	{
		echo '<label for="reference">Numéro de référence</label>';
		
		if($this->readOnly)
		{
			echo '<span>'.$this->getReferenceNumber().'</span>';
		}
		else
		{
			echo '<input type="text" id="reference" name="reference"';

			if(isset($this->referenceNumber))
		   		echo 'value="'.$this->getReferenceNumber().'"';

			echo ' required>';
		}
	}

	public function printPublishingHouseField()
	{
		global $application;
		echo '<label for="maison_editionID">Maison d\'édition</label>';

		if($this->readOnly)
		{
			echo '<span>'.$this->getPublishingHouse().'</span>';
		}
		else
		{
			$query = $application->database->prepare('SELECT ID, nom FROM maisons_edition WHERE inactif = FALSE OR nom = ? ORDER BY nom ASC');
			$query->execute(array($this->getPublishingHouse()));

			echo '<select id="maison_editionID" name="maison_editionID">';
			echo '<option value="0"></option>';
			foreach($query as $row)
			{
				if($row['nom'] == $this->getPublishingHouse())
					echo '<option value="'.$row['ID'].'" selected>'.$row['nom'].'</option>';
				else
					echo '<option value="'.$row['ID'].'">'.$row['nom'].'</option>';
			}
			echo '</select>';
		}
	}

	public function printSupportField()
	{
		global $application;
		echo '<label for="supportID">Support</label>';

		if($this->readOnly)
		{
			echo '<span>'.$this->getSupport().'</span>';
		}
		else
		{
			$query = $application->database->prepare('SELECT ID, nom FROM supports WHERE inactif = FALSE OR nom = ? ORDER BY nom ASC');
			$query->execute(array($this->getSupport()));

			echo '<select id="supportID" name="supportID">';
			echo '<option value="0"></option>';
			foreach($query as $row)
			{
				if($row['nom'] == $this->getSupport())
					echo '<option value="'.$row['ID'].'" selected>'.$row['nom'].'</option>';
				else
					echo '<option value="'.$row['ID'].'">'.$row['nom'].'</option>';
			}
			echo '</select>';
		}
	}
	public function printDescriptionField()
	{
		echo '<label for="notes">Description</label>';

		if($this->readOnly)
		{
			echo '<span>'.$this->getDescription().'</span>';
		}
		else
		{
			echo '<textarea id="notes" name="notes">';
			echo $this->getDescription();
			echo '</textarea>';
		}
	}
}
?>
