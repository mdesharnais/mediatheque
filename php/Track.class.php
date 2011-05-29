<?php
class Track
{
	//////////////////////////////////////////////////
	// Attribute(s)
	//////////////////////////////////////////////////

	private $id;
	private $position;
	private $title;

	private $readOnly;

	//////////////////////////////////////////////////
	// Constructor
	//////////////////////////////////////////////////

	public function __construct($id)
	{
		$this->id = $id;

		$this->readOnly = false;
	}

	//////////////////////////////////////////////////
	// Get(s)
	//////////////////////////////////////////////////

	public function getID()
	{
		return $this->id;
	}

	public function getPosition()
	{
		return $this->position;
	}

	public function getTitle()
	{
		return $this->title;
	}

	//////////////////////////////////////////////////
	// Set(s)
	//////////////////////////////////////////////////

	public function setPosition($value)
	{
		$this->position = $value;
	}

	public function setTitle($value)
	{
		$this->title = stripslashes($value);
	}

	//////////////////////////////////////////////////
	// Methods(s)
	//////////////////////////////////////////////////

	public function printPositionField()
	{
		echo '<label for="details_position_media">Position</label>';

		if($this->readOnly)
		{
			echo '<span>'.$this->getPosition().'</span>';
		}
		else
		{
			echo '<input type="number" id="details_position_media" name="details_position_media" min="0"';

			if(isset($this->position))
				echo ' value="'.$this->getPosition().'"';

			echo ' required>';
		}
	}

	public function printTitleField()
	{
		echo '<label for="details_titre">Titre</label>';

		if($this->readOnly)
		{
			echo '<span>'.$this->getTitle().'</span>';
		}
		else
		{
			echo '<input type="text" id="details_titre" name="details_titre" maxlength="75"';

			if(isset($this->title))
				echo ' value="'.$this->getTitle().'"';

			echo ' required>';
		}
	}
}
?>
