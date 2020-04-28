<?php
/**
 * 
 */
class PortfoliosManager_PDO extends PortfolioDetailsManager
{
	/**
	* Attribut contenant l'instance représentant la BDD.
	* @type PDO
	*/
	protected $db;

	/**
	* Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
	* @param $db PDO Le DAO
	* @return void
	*/
	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	/**
	* @see PortfoliossManager::add()
	*/
	protected function add(Portfolio $portfolios)
	{
		$requete = $this->db->prepare('INSERT INTO kk_portfolio(categorie, client, url, dateAjout, titre, contenu, image, dateModif)
		VALUES(:categorie, :client, :url, NOW(), :titre, :contenu, :image, NOW())');
		$requete->bindValue(':categorie', $portfolios->categorie());
		$requete->bindValue(':client', $portfolios->client());
		$requete->bindValue(':url', $portfolios->url());
		$requete->bindValue(':titre', $portfolios->titre());
		$requete->bindValue(':contenu', $portfolios->contenu());
		$requete->bindValue(':image', $portfolios->image());
		$requete->execute();
	}

	/**
	* @see PortfoliosManager::count()
	*/
	public function count()
	{
		return $this->db->query('SELECT COUNT(*) FROM kk_portfolio')->fetchColumn();
	}

	/**
	* @see PortfoliosManager::delete()
	*/
	public function delete($id)
	{
		$this->db->exec('DELETE FROM kk_portfolio WHERE id = '.(int) $id);
	}

	/**
	* @see PortfoliossManager::getList()
	*/
	public function getList($debut = -1, $limite = -1)
	{
		$sql = 'SELECT id, categorie, client, url, dateAjout, titre, contenu, image, dateModif FROM kk_portfolio ORDER BY id DESC';

		// On vérifie l'intégrité des paramètres fournis.
		if ($debut != -1 || $limite != -1)
		{
			$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
		}

		$requete = $this->db->query($sql);
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Portfolio');

		$listePortfolios = $requete->fetchAll();
		/*On parcourt notre liste de news pour pouvoir placer des instances de DateTime en guise de dates d'ajout et de modification.*/

		foreach ($listePortfolios as $portfolio)
		{
			$portfolio->setDateAjout(new DateTime($portfolio->dateAjout()));
			$portfolio->setDateModif(new DateTime($portfolio->dateModif()));
		}
		$requete->closeCursor();

		return $listePortfolios;
	}

	/**
	* @see PortfoliosManager::getUnique()
	*/
	public function getUnique($id)
	{
		$requete = $this->db->prepare('SELECT id, categorie, client, url, dateAjout, titre, contenu, image, dateModif FROM kk_portfolio
		WHERE id = :id');

		$requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
		$requete->execute();

		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Portfolio');
		$portfolios = $requete->fetch();
		if($portfolios!=null)
		{
			$portfolios->setDateAjout(new DateTime($portfolios->dateAjout()));
			$portfolios->setDateModif(new DateTime($portfolios->dateModif()));
		}
		return $portfolios;
	}

	/**
	* @see PortfoliosManager::update()
	*/
	protected function update(Portfolio $portfolio)
	{
		$requete = $this->db->prepare('UPDATE kk_portfolio SET categorie = :categorie, client = :client,url = :url, dateAjout = NOW(), titre = :titre, contenu = :contenu, image = :image, dateModif = NOW() WHERE id = :id');

		$requete->bindValue(':categorie', $portfolio->categorie());
		$requete->bindValue(':client', $portfolio->client());
		$requete->bindValue(':url', $portfolio->url());
		$requete->bindValue(':titre', $portfolio->titre());
		$requete->bindValue(':contenu', $portfolio->contenu());
		$requete->bindValue(':image', $portfolio->image());
		$requete->bindValue(':id', $portfolio->id(), PDO::PARAM_INT);

		$requete->execute();
	}

}