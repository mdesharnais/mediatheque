<?php
class User
{
	//////////////////////////////////////////////////
	// Attribute(s)
	//////////////////////////////////////////////////
	
	private $ID;
	private $matricule;
	private $mot_de_passe;
	private $nom;
	private $prenom;
	private $telephone;
	private $courriel;
	private $inactif;

	//////////////////////////////////////////////////
	// Constructor
	//////////////////////////////////////////////////
	
	public function __construct($id)
	{
		$this->ID = $id;
	}

	//////////////////////////////////////////////////
	// Get(s)
	//////////////////////////////////////////////////

	public function getID()
	{
		return $this->ID;
	}

	public function getStudentNumber()
	{
		return $this->matricule;
	}

	public function getPassword()
	{
		return $this->mot_de_passe;
	}

	public function getFirstName()
	{
		return $this->prenom;
	}

	public function getLastName()
	{
		return $this->nom;
	}

	public function getTelephoneNumber()
	{
		return $this->telephone;
	}

	public function getEmailAddress()
	{
		return $this->courriel;
	}

	public function isActive()
	{
		return $this->inactif == false;
	}

	public function isInactive()
	{
		return $this->inactif == true;
	}

	//////////////////////////////////////////////////
	// Set(s)
	//////////////////////////////////////////////////

	public function setStudentNumber($value)
	{
		$this->matricule = $value;
	}

	public function setPassword($value)
	{
		$this->mot_de_passe = $value;
	}

	public function setFirstName($value)
	{
		$this->prenom = $value;
	}

	public function setLastName($value)
	{
		$this->nom = $value;
	}

	public function setTelephoneNumber($value)
	{
		$this->telephone = $value;
	}

	public function setEmailAddress($value)
	{
		$this->courriel = $value;
	}

	public function setActive()
	{
		$this->inactif = false;
	}

	public function setInactive()
	{
		$this->inactif = true;
	}

	//////////////////////////////////////////////////
	// Methods(s)
	//////////////////////////////////////////////////
	
}
?>
