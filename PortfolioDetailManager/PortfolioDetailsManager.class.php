<?php
/**
 * 
 */
abstract class PortfolioDetailsManager
{
	/**
	* Méthode permettant d'ajouter un portfolio.
	* @param $element l'élément à ajouter
	* @return void
	*/
	abstract protected function add(Portfolio $element);

	/**
	* Méthode renvoyant le nombre d'éléments du portfolio total.
	* @return int
	*/
	abstract public function count();
	
	/**
	* Méthode permettant de supprimer un élément du portfolio.
	* @param $id int L'identifiant de l'élément à supprimer
	* @return void
	*/
	abstract public function delete($id);
	
	/**
	* Méthode retournant une liste des éléments demandées.
	* @param $debut int Le première premier à sélectionner
	* @param $limite int Le nombre d'éléments à sélectionner
	* @return array La liste des éléments. Chaque entrée est une instance de Portfolio.
	*/
	abstract public function getList($debut = -1, $limite = -1);
	
	/**
	* Méthode retournant un élément précis.
	* @param $id int L'identifiant du portfolio à récupérer
	* @return Portfolios portfolio demandé
	*/
	abstract public function getUnique($id);
	
	/**
	* Méthode permettant d'enregistrer un éléments dans le portfolio.
	* @param $portfolios portfolio à enregistrer
	* @see self::add()
	* @see self::modify()
	* @return void
	*/
	public function save(Portfolio $portfolios)
	{
		if ($portfolios->isValid())
		{
			$portfolios->isNew() ? $this->add($portfolios) : $this->update($portfolios);
		}
		else
		{
			throw new RuntimeException('La news doit être valide pour être enregistrée');
		}
	}
	
	/**
	* Méthode permettant de modifier un élément du portfolio.
	* @param $portfolios portfolio  à modifier
	* @return void
	*/
	abstract protected function update(Portfolio $portfolios);
}