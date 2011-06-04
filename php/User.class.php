<?php
require_once('Application.class.php');

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
	
	public function __construct($id = null)
	{
		if(isset($id))
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

	public function getName()
	{
		return $this->getFirstName().' '.$this->getLastName();
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

	public function isVisitor()
	{
		return is_null($this->ID);
	}

	/**
	 * \brief Retourne, si celui-ci existe, l'utilisateur correspondant à la clé primaire reçue en paramètre.
	 * \author Martin Desharnais
	 * \param id Clé primaire de l'utilisateur que l'on souhaite récupérer.
	 * \exception InvalidArgumentException Aucun utilisateur ne correspond à la clé primaire reçue.
	 * \return Une instance de l'a classe User correspondant à la clé primaire reçue en paramètre.
	 */
	public static function getInstanceOf($id)
	{
		global $application;

		$query = $application->database->prepare('
			SELECT utilisateurs.matricule,
				utilisateurs.nom,
				utilisateurs.prenom,
				utilisateurs.telephone,
				utilisateurs.courriel,
				utilisateurs.inactif
			FROM utilisateurs
			WHERE utilisateurs.ID = ?');
		$query->execute(array($id));
		$row = $query->fetch();

		if($row == false)
			throw new InvalidArgumentException('L\'utilisateur demandé n\'existe pas.');

		$user = new User($id);
		$user->setStudentNumber($row['matricule']);
		$user->setPassword('12345');
		$user->setFirstName($row['prenom']);
		$user->setLastName($row['nom']);
		$user->setTelephoneNumber($row['telephone']);
		$user->setEmailAddress($row['courriel']);
		if($row['inactif'])
			$user->setInactive();
		else
			$user->setActive();

		return $user;
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
	
	/**
	 * \brief Retourne si l'utilisateur courrant dispose des droits demandés sur la section demandée.
	 * \author Martin Desharnais
	 * \param section Chaine de caractères représentant la section pour laquelle il faut tester les droits.
	 * \param rights Nombre contenant les droits qu'il faut tester.
	 * \return TRUE si l'utilisateur dispose de tous les droits sur la section, sinon FALSE.
	 */
	public function haveRights($section, $rights)
	{
		global $application;

		if($this->isVisitor())
		{
			if($section == 'media.php' && $rights == $application->rights['read'])
				return true;
			else
				return false;
		}
		else
			return true;
	}
}
?>
