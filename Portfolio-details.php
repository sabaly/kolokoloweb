<?php
  require 'PortfolioDetailManager/autoload.class.php';

  $db = DBFactory::getMysqlConnexionWithPDO();
  $manager = new PortfoliosManager_PDO($db);

  if(isset($_GET['id']))
  {
    $portfolio = $manager->getUnique((int) $_GET['id']);
  }else {
    $portfolio = $manager->getUnique(2);
  }
  $portfolios = $manager->getList();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Portfolio Details - Knight Bootstrap Template</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon-kolo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!--aos-master-->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1><a href="index.html">KoloKoloWeb</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/favicon-logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="./#header">Acceuil</a></li>
          <li class="drop-down"><a href="#">A propos</a>
            <ul>
              <li><a href="./#about">De Kolokolo</a></li>
              <li><a href="./#team">Equipe</a></li>
              <li><a href="./#">Projets</a></li>
              <li class="drop-down"><a href="#portfolio">Réalisations</a>
                <ul>
                  <li><a href="#">Web</a></li>
                  <li><a href="#">Mobile</a></li>
                  <li><a href="#">Desktop</a></li>
                  <li><a href="#">Logo</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="./#services">Services</a></li>
          <li><a href="./#portfolio">Portfolio</a></li>
          <!--li><a href="#testimonials">Testimonials</a></li-->
          <li><a href="./#contact">Contactez-nous</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <!--a href="#" class="instagram"><i class="icofont-instagram"></i></a-->
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Details Portfolio</h2>
          <ol>
            <li><a href="index.html">Acceuil</a></li>
            <li>Details Portfolio</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container" data-aos="zoom-in" data-aos-duration="2000">

        <div class="portfolio-details-container">
          <img src="assets/img/portfolio-details/<?php echo $portfolio->image(); ?>" class="img-fluid" alt="">

          <div class="portfolio-info" data-aos="flip-down" data-aos-duration="1500">
            <h3>Project information</h3>
            <ul>
              <li><strong>Categorie</strong>: <?php echo$portfolio->categorie(); ?></li>
              <li><strong>Client</strong>: <?php echo $portfolio->client(); ?></li>
              <li><strong>Date</strong>: <?php echo $portfolio->dateAjout()->format('d/m/Y à H\hi'); ?></li>
              <li><strong>URL</strong>: <a href="<?php echo $portfolio->url(); ?>"><?php echo $portfolio->url(); ?></a></li>
            </ul>
          </div>

        </div>

        <div class="portfolio-description" data-aos="zoom-in-right" data-aos-duration="1500">
          <h2><?php echo $portfolio->titre(); ?></h2>
          <p>
            Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.
          </p>
        </div>

      </div>
    </section><!-- End Portfolio Details Section -->


    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h2>Autres</h2>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Tout</li>
              <li data-filter=".filter-app">Web</li>
              <li data-filter=".filter-card">Logos</li>
              <li data-filter=".filter-web">Mobile</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <?php
          foreach ($portfolios as $element) 
          {
            if(strstr($element->categorie(), 'Web'))
            {
              $filter = 'filter-web';
            }else if(strstr($element->categorie(), 'Logo'))
            {
              $filter = 'filter-card';
            }else {
              $filter = 'filter-app';
            }
          ?>
            <div class="col-lg-4 col-md-6 portfolio-item <?php echo $filter; ?> wow fadeInUp">
              <div class="portfolio-wrap">
                <figure>
                  <img src="assets/img/portfolio/<?php echo $element->image();?>" class="img-fluid" alt="">
                  <a href="assets/img/portfolio/<?php echo $element->image();?>" data-gall="portfolioGallery" class="link-preview venobox" title="Voir"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.php?id=<?php echo $element->id(); ?>" class="link-details" title="Details"><i class="bx bx-link"></i></a>
                </figure>

                <div class="portfolio-info">
                  <h4><a href="portfolio-details.php"><?php echo $element->client();?></a></h4>
                  <p><?php echo $element->categorie();?></p>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
      </div>
    </section><!-- End Portfolio Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>KoloKolo</h3>
            <p>
              <strong>tel(s):</strong> +221 78 537 89 91 / +33 7 58 19 94 30 / +221 77 832 19 63 <br>
              <strong>Email:</strong> kolo-kolo@gmail.com <br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Liens utiles</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="./#header" class="scrollto">Acceuil</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="./#about" class="scrollto">A propos</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="./#services" class="scrollto">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#" >Conditions de services</a></li>
              <!--li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li-->
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Nos services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a>Développement Web</a></li>
              <li><i class="bx bx-chevron-right"></i> <a>Développement Mobile</a></li>
              <li><i class="bx bx-chevron-right"></i> <a>Contruction de logos</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Newsletter</h4>
            <!--p></p-->
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="S'inscrire">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>kolokolo</span></strong>, 2020 kolo-kolo@gmail.com
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <!--a href="#" class="instagram"><i class="bx bxl-instagram"></i></a-->
        <!--a href="#" class="google-plus"><i class="bx bxl-skype"></i></a-->
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/index.js"></script>

  <!--aos master-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

</body>

</html>