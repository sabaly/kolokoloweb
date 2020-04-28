<?php
	require 'autoload.class.php';

	$db = DBFactory::getMysqlConnexionWithPDO();
	$manager = new PortfoliosManager_PDO($db);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Test</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<p><a href="admin.php">Accéder à l'espace d'administration</a></p>
		<?php
			if (isset($_GET['id']))
			{
				$portfolios = $manager->getUnique((int) $_GET['id']);
				echo '<p>Catégorie :  <em>', $portfolios->categorie(), '</em>,<br/> Client : ', $portfolios->client(), '<br/>Date : ', $portfolios->dateAjout()->format('d/m/Y à H\hi'), '<br/> URL : ', $portfolios->url(), 
				'</p>', "\n",
				'<h2>', $portfolios->titre(), '</h2>', "\n",
				'<p>', nl2br($portfolios->contenu()), '</p>', "\n";
				if ($portfolios->dateAjout() != $portfolios->dateModif())
				{
					echo '<p style="text-align: right;"><small><em>Modifiée le ', $portfolios->dateModif(), '</em></small></p>';
				}
			}
			else
			{
				echo '<h2 style="text-align:center">Liste des 5 dernières éléments du Portfolio</h2>';
				foreach ($manager->getList(0, 5) as $portfolio)
				{
					if (strlen($portfolio->contenu()) <= 200)
					{
						$contenu = $portfolio->contenu();
					}
					else
					{
						$debut = substr($portfolio->contenu(), 0, 200);
						$debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
						$contenu = $debut;
					}
					echo '<h4><a href="?id=', $portfolio->id(), '">', $portfolio->titre(), '</a></h4>', "\n", '<p>', nl2br($contenu), '</p>';
				}
			}
		?>

	</body>
</html>