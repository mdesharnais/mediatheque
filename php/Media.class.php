<?php
require_once('Application.class.php');

class Media
{
	//////////////////////////////////////////////////
	// Attribute(s)
	//////////////////////////////////////////////////

	const READ_ONLY = 1;
	const READ_WRITE = 2;

	private $ID;
	private $title;
	private $publicationYear;
	private $referenceNumber;
	private $publishingHouse;
	private $support;
	private $nationality;
	private $universalProductCode;
	private $collection;
	private $positionInCollection;
	private $description;
	private $image;
	private $supportImage;

	private $readOnly;

	//////////////////////////////////////////////////
	// Constructor
	//////////////////////////////////////////////////

	public function __construct($row = null, $openMode = self::READ_WRITE)
	{
		if($openMode == self::READ_ONLY)
			$this->readOnly = true;
		else
			$this->readOnly = false;

		if($row != null)
		{
			$this->ID = $row['ID'];
			$this->title = stripslashes($row['titre']);
			$this->publicationYear = $row['annee_publication'];
			$this->referenceNumber = stripslashes($row['reference']);
			$this->publishingHouse = stripslashes($row['maison_edition']);
			$this->support = stripslashes($row['support']);
			$this->nationality = stripslashes($row['nationalite']);
			$this->universalProductCode = stripslashes($row['CUP']);
			$this->collection = stripslashes($row['collection']);
			$this->positionInCollection = $row['position_collection'];
			$this->description = stripslashes($row['notes']);
			$this->image = stripslashes($row['image']);
			$this->supportImage = stripslashes($row['imageCategorieMedia']);
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

	//////////////////////////////////////////////////
	// Set(s)
	//////////////////////////////////////////////////

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
