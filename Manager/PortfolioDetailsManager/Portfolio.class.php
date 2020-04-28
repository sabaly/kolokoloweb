<?php
/**
* Classe représentant un élément du portfolio.
* @author s@dmin kolokolo member.
*/
class Portfolio
{
	protected $erreurs = [],
			  $id,
			  $categorie,
			  $client,
			  $url,
			  $dateAjout,
			  $titre,
			  $contenu,
			  $image,
			  $dateModif;

	/**
	* Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
	*/
	const CATEGORIE_INVALIDE = 1;
	const CLIENT_INVALIDE = 2;
	const CONTENU_INVALIDE = 3;

	/**
	* Constructeur de la classe qui assigne les données spécifiées en paramètre aux attributs
	correspondants.
	* @param $valeurs array Les valeurs à assigner
	* @return void
	*/
	public function __construct($valeurs = [])
	{
		if (!empty($valeurs)) // Si on a spécifié des valeurs, alors on hydrate l'objet.
		{
			$this->hydrate($valeurs);
		}

	}

	/**
	* Méthode assignant les valeurs spécifiées aux attributs correspondant.
	* @param $donnees array Les données à assigner
	* @return void
	*/
	public function hydrate($donnees)
	{
		foreach ($donnees as $attribut => $valeur)
		{
			$methode = 'set'.ucfirst($attribut);
			if (is_callable([$this, $methode]))
			{
				$this->$methode($valeur);
			}
		}
	}

	/**
	* Méthode permettant de savoir si la news est nouvelle.
	* @return bool
	*/
	public function isNew()
	{
		return empty($this->id);
	}

	/**
	* Méthode permettant de savoir si la news est valide.
	* @return bool
	*/
	public function isValid()
	{
		return !(empty($this->categorie) || empty($this->client) || empty($this->contenu));
	}

	// SETTERS //
	public function setId($id)
	{
		$this->id = (int) $id;
	}

	public function setCategorie($categorie)
	{
		if (!is_string($categorie) || empty($categorie))
		{
			$this->erreurs[] = self::CATEGORIE_INVALIDE;
		}
		else
		{
			$this->categorie = $categorie;
		}
	}

	public function setclient($client)
	{
		if (!is_string($client) || empty($client))
		{
			$this->erreurs[] = self::CLIENT_INVALIDE;
		}
		else
		{
			$this->client = $client;
		}
	}

	public function setTitre($titre)
	{
		$this->titre = $titre;
	}

	public function setContenu($contenu)
	{
		if (!is_string($contenu) || empty($contenu))
		{
			$this->erreurs[] = self::CONTENU_INVALIDE;
		}
		else
		{
			$this->contenu = $contenu;
		}
	}

	public function setUrl($url)
	{
		$this->url = $url;
	}

	public function setDateAjout(DateTime $dateAjout)
	{
		$this->dateAjout = $dateAjout;
	}

	public function setImage($image)
	{
		$this->image = $image;
	}

	public function setDateModif(DateTime $dateModif)
	{
		$this->dateModif = $dateModif;
	}

	// GETTERS //
	public function erreurs()
	{
		return $this->erreurs;
	}

	public function id()
	{
		return $this->id;
	}

	public function categorie()
	{
		return $this->categorie;
	}

	public function client()
	{
		return $this->client;
	}

	public function url()
	{
		return $this->url;
	}

	public function titre()
	{
		return $this->titre;
	}

	public function contenu()
	{
		return $this->contenu;
	}

	public function image()
	{
		return $this->image;
	}

	public function dateAjout()
	{
		return $this->dateAjout;
	}

	public function dateModif()
	{
		return $this->dateModif;
	}

}