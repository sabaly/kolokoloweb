<?php
	require 'autoload.class.php';

	$db = DBFactory::getMysqlConnexionWithPDO();
	$manager = new PortfoliosManager_PDO($db);

	if (isset($_GET['modifier']))
	{
		$portfolios = $manager->getUnique((int) $_GET['modifier']);
	}

	if (isset($_GET['supprimer']))
	{
		$manager->delete((int) $_GET['supprimer']);
		$message = 'L\'élément a bien été supprimée !';
	}

	if (isset($_POST['categorie']))
	{
		$portfolios = new Portfolio(
			[
			'categorie' => $_POST['categorie'],
			'client' => $_POST['client'],
			'url' => $_POST['url'],
			'titre' => $_POST['titre'],
			'contenu' => $_POST['contenu'],
			'image' => $_FILES['image']['name']
			]
		);
		
		if (isset($_POST['id']))
		{
			$portfolios->setId($_POST['id']);
		}

		if ($portfolios->isValid())
		{
			$manager->save($portfolios);
			$message = $portfolios->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !';
		}
		else
		{
			$erreurs = $portfolios->erreurs();
		}

	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Administration</title>
		<meta charset="utf-8" />
	    <meta content="width=device-width, initial-scale=1.0" name="viewport">

	    <title>Portfolio Details Admin - Administrator</title>
	    <meta content="" name="descriptison">
	    <meta content="" name="keywords">


    	<!-- Favicons -->
    	<link href="../assets/img/favicon-kolo.png" rel="icon">
    	<link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	    <!-- Google Fonts -->
	    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
		
		<!-- Vendor CSS Files -->
		<link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
		<link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
		<link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
	    <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
		<link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">


		  <!-- Template Main CSS File -->
		<link href="../assets/css/style.css" rel="stylesheet">

		  <!--aos-master-->
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		
	</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1><a href="index.html">KoloKoloWeb</a></h1>
      </div>

      <div class="header-social-links">
        <a href="../Portfolio-details.php"><i class="icofont-eye" title="voirs les enregistrements"></i></a>
        <a href="../index.html"><i class="icofont-home" title="Site"></i></a>
      </div>

    </div>
  </header><!-- End Header -->

  <main id="main">
  	<!--=== formulaire ===-->
  	<section id="formulaire" class="formulaire">

      <div class="container" data-aos="zoom-in" data-aos-duration="2000">
		<form action="admin.php" method="post" enctype="multipart/form-data" role="form" class="php-email-form">
		<p style="text-align: center">
<?php
	if (isset($message))
	{
		echo $message, '<br />';
	}
?>
<?php 
	if (isset($erreurs) && in_array(Portfolio::CATEGORIE_INVALIDE, $erreurs)) echo 'La catégorie est invalide.<br />';
?>
	<div class="form-row">
		<div class="form-group col-md-6">
	      <label for="categorie">Categorie</label>
			<input type="text" name="categorie" value="<?php if (isset($portfolios)) echo $portfolios->categorie(); ?>" class="form-control" id="categorie" required/>
		</div>
<?php 
	if (isset($erreurs) && in_array(News::CLIENT_INVALIDE, $erreurs)) echo 'Le client est invalide.<br />';
?>
		<div class="form-group col-md-6">
		    <label for="client">Client</label>
			<input type="text" name="client" value="<?php if (isset($portfolios)) echo $portfolios->client();?>" class="form-control" id="client" required/>
		</div>
	</div>


	<div class="form-row">
		<div class="form-group col-md-4">
	      <label for="url">URL</label>
			<input type="text" name="url" value="<?php if (isset($portfolios)) echo $portfolios->url();?>" class="form-control" id="url" required/>
		</div>

		<div class="form-group col-md-5">
		    <label for="titre">Titre</label>
			<input type="text" name="titre" value="<?php if (isset($portfolios)) echo $portfolios->titre();?>" class="form-control" id="titre" />
		</div>

		<div class="form-group col-md-3">
		    <label for="image">Image</label>
			<input type="file" name="image" value="<?php if (isset($portfolios)) echo $portfolios->image(); ?>" class="form-control" id="image" required/>
		</div>
	</div>

<?php
 	if (isset($erreurs) && in_array(News::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; 
?>
	<div class="form-group">
	    <label for="contenu">Contenu</label>
		<textarea rows="8" cols="60" name="contenu" placeholder="Description" id="contenu" class="form-control" required><?php if (isset($portfolios)) echo $portfolios->contenu(); ?></textarea>
	</div>

	<div class="form-group row">
		<div class="col-sm-10">
<?php
	if(isset($portfolios) && !$portfolios->isNew())
	{
?>
		<input type="hidden" name="id" value="<?= $portfolios->id() ?>" class="btn"/>
		<div class="text-center"><button type="submit">Modifier</button></div>
<?php
	}
	else
	{
?>
		<div class="text-center"><button type="submit">Ajouter</button></div>
<?php
	}
?>
		</div>
	</div>
	</p>
		</form>
	</div>
	</section><!--=== fin formulaire ===-->

	<section>
		<div class="container">
			<div class="section-title section-title-contact">
          		<h2>Lites des enregistrements</h2>
				<p style="text-align: center">Il y a actuellement <?= $manager->count() ?> éléments dans le portfolio</p>
			</div>

		<table class="table">
			<thead>
				<tr>
					<th scope="col">Catégorie</th>
					<th scope="col">Client</th>
					<th scope="col">Date</th>
					<th scope="col">Dernière Modifcation</th>
					<th scope="col">URL</th>
					<th scope="col">Titre</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
<?php
	foreach ($manager->getList() as $portfolios)
	{
		echo '<tr><td>', $portfolios->categorie(), '</td><td>', $portfolios->client(), '</td><td>',$portfolios->dateAjout()->format('d/m/Y à H\hi'), '</td><td>', ($portfolios->dateAjout() == $portfolios->dateModif() ? '-' : $portfolios->dateModif()->format('d/m/Y à H\hi')), '</td><td>', $portfolios->url(), '</td><td>', $portfolios->titre(), '</td><td><a href="?modifier=', $portfolios->id(), '">Modifier</a> | <a href="?supprimer=', $portfolios->id(), '">Supprimer</a></td></tr>', "\n";
	}
?>
		</table>
	</section>

	</main>


  <!-- Vendor JS Files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="../assets/vendor/counterup/counterup.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/venobox/venobox.min.js"></script>
  <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/index.js"></script>

  <!--aos master-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>