<?php
session_start();
$connexion = new mysqli("localhost", "root", "", "entreprise");

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupération des données du formulaire et nettoyage
if(isset($_POST['OKK'])) {
    $name = $_POST['fullName'];
    $biblio = $_POST['about'];
    $image = $_POST['image'];
    $compa = $_POST['company'];
    $travail = $_POST['job'];
    $pays = $_POST['country'];
    $adre = $_POST['address'];
    $cont = $_POST['phone'];
    $email = $_POST['email'];
    $twi = $_POST['twitter'];
    $fb = $_POST['facebook'];
    $ig = $_POST['instagram'];
    $link = $_POST['linkedin'];

    // Requête préparée pour l'insertion des données
    $requete = $connexion->prepare("INSERT INTO info_ressource_agent (image, nom, bibliographie, compagnie, travail, pays, adresse, contact, email, twitter, facebook, instagram, linkedin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $requete->bind_param("sssssssssssss", $image, $name, $biblio, $compa, $travail, $pays, $adre, $cont, $email, $twi, $fb, $ig, $link);
    $requete->execute();
   
    
    // Redirection après l'insertion des données
    header('Location: users-profile-ressources-agent.php');
    exit(); // Assurez-vous que le script se termine après la redirection
}

$connexion->close();
?>


<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users / Profile - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-php-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
  
  .image-container {
    width: 120px; /* Définir la largeur de la div */
    height: 150px; /* Définir la hauteur de la div */
    border-radius: 50%; /* Rendre les bords arrondis pour créer une forme circulaire */
    overflow: hidden; /* Cacher tout contenu dépassant de la div */
}

.image-container img {
    width: 100%; /* Assurer que l'image remplit la div */
    height: auto; }
</style>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index-ressources-agent.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">MILLENIUM</span>
      </a>
      <?php
        
        // Connexion à la base de données 
        $connexion = new mysqli("localhost", "root", "", "entreprise");

        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['email'])) {
            // Utilisateur connecté, afficher le nom et le prénom
            $email = $_SESSION['email'];
            $sql = "SELECT nom, prenom, service FROM agent WHERE email = '$email'";
            $result = $connexion->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<i class='bi bi-circle' style='background-color:green; border-radius:50px'></i>&nbsp<span class='t' style='font-family:times new romans; font-size:20px;color:blue'> <strong>".$row["service"]."</span> </strong>";
            } else {
                echo "<i class='bi bi-circle' style='background-color:green; border-radius:50px'></i>&nbsp;Hors ligne.";
            }
        } 
        $connexion->close();
        ?>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
             Vous avez 4 nouvelles notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">TOUT VOIR</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>...</h4>
                <p>...</p>
                <p>30 min</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>...</h4>
                <p>...</p>
                <p>1 hr</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>...</h4>
                <p>...</p>
                <p>2 hrs</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>...</h4>
                <p>...</p>
                <p>4 hrs</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Voir toutes les notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              Vous avez 3 nouveaux messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
              <!--  <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle"> -->
                <div>
                  <h4>...</h4>
                  <p>...</p>
                  <p>4 hrs</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
               <!-- <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle"> -->
                <div>
                  <h4>...</h4>
                  <p>...</p>
                  <p>6 hrs</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
               <!-- <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle"> -->
                <div>
                  <h4>...</h4>
                  <p>...</p>
                  <p>8 hrs</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">
        <?php
        
        // Connexion à la base de données 
        $connexion = new mysqli("localhost", "root", "", "entreprise");

        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['email'])) {
            // Utilisateur connecté, afficher le nom et le prénom
            $email = $_SESSION['email'];
            $sql = "SELECT nom, prenom FROM agent WHERE email = '$email'";
            $result = $connexion->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "Salut " . $row["nom"] . " " . $row["prenom"];
            } else {
                echo "Aucun ressources_agent trouvé.";
            }
        } else {
            // Utilisateur non connecté, afficher un lien de connexion
            echo "<a href='pages-login.php'>Connexion</a>";
        }

        $connexion->close();
        ?>
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="d-none d-md-block dropdown-toggle ps-2">
         </span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6></h6>
              <span>.....travail</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile-ressources-agent.php">
                <i class="bi bi-person"></i>
                <span>Mon profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile-ressources-agent.php">
                <i class="bi bi-gear"></i>
                <span>Paramètre</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq-ressources-agent.php">
                <i class="bi bi-question-circle"></i>
                <span>Besoin d'aide ?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="signout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Déconnexion</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar" data-aos="fade-right" data-aos-delay="300" data-aos-duration="500">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index-ressources-agent.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- End Components Nav -->

      <!-- End Forms Nav -->

  <!-- End Tables Nav -->

   <!-- End Charts Nav -->

    <!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link " href="users-profile-ressources-agent.php">
          <i class="bi bi-person"></i>
          <span>Profil</span>
        </a>
      </li><!-- End Profile Page Nav -->

 
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-gestion-ressources-agent.php">
          <i class="bi bi-file-earmark-text"></i>
          <span>Gestion des contrats</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-gestion-ressources-absences-agent.php">
          <i class="bi bi-book"></i>
          <span>Gestion des absences</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-gestion-ressources-conge-agent.php">
          <i class="bi bi-calendar-check"></i>
          <span>Gestion des congés</span>
        </a>
      </li>

<li class="nav-item">
  <a class="nav-link collapsed" href="pages-tache-ressources-agent.php">
    <i class="bi bi-list-task"></i>
    <span>Tâches & Rapports</span>
  </a>
</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact-ressources-agent.php">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

     

     

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main" data-aos="fade-left" data-aos-delay="600" data-aos-duration="500">

    <div class="pagetitle">
      <h1>Profil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index-ressources-agent.php">Accueil</a></li>
          <li class="breadcrumb-item">Utilisateur</li>
          <li class="breadcrumb-item active">Profil</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <div class="image-container">
            <?php
                        
                        // Connexion à la base de données
                        $connexion = new mysqli("localhost", "root", "", "entreprise");
                        
                        // Vérifiez si la connexion a réussi
                        if ($connexion->connect_error) {
                            die("Erreur de connexion à la base de données : " . $connexion->connect_error);
                        }
                        
                        // Récupérer le chemin de l'image depuis la base de données
                        $result = $connexion->query("SELECT image FROM info_ressource_agent "); // Remplacez 'table_images' et 'id' par vos valeurs réelles
                        
                        // Vérifiez si la requête a renvoyé des résultats
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $chemin_image = $row["image"];
                        
                            // Affichez l'image dans une balise img
                            echo '<div class="image-container">';
                      
                            echo '<img src="' . $chemin_image . '" alt="Votre image">';
                            

                            echo '</div>';
                            
                        } 
                        
                        // Fermez la connexion à la base de données
                        $connexion->close();
                                        ?>
                          </div><a href=''; class='btn btn-danger btn-sm' name='supp' title='Supprimer un utilisateur'><i class='bi bi-trash'></i></a>
                            <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
                            
                                        
                              <h2><?php
        
        // Connexion à la base de données 
        $connexion = new mysqli("localhost", "root", "", "entreprise");

        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['email'])) {
            // Utilisateur connecté, afficher le nom et le prénom
            $email = $_SESSION['email'];
            $sql = "SELECT nom, prenom FROM agent WHERE email = '$email'";
            $result = $connexion->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo  $row["nom"] . " " . $row["prenom"];
        } }

        $connexion->close();
        ?></h2>
              <h3><?php
        
        // Connexion à la base de données 
        $connexion = new mysqli("localhost", "root", "", "entreprise");

        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['email'])) {
            // Utilisateur connecté, afficher le nom et le prénom
            $email = $_SESSION['email'];
            $sql = "SELECT fonction FROM agent WHERE email = '$email'";
            $result = $connexion->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo  $row["fonction"];
        } }
    
        $connexion->close();
       
        ?>
        
      </h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Vue</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Paramètres</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Mot de passe</button>
                </li>

              </ul>
              <form action = "" method = "POST">
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">A propos de</h5>
                  <p class="small fst-italic">
                    <?php $connexion = new mysqli("localhost", "root", "", "entreprise");
                      if (isset($_SESSION['email'])) {
                        $email = $_SESSION['email'];
                        
                      $result = $connexion -> query("SELECT * FROM info_ressource_agent");
                             if ($result->num_rows > 0) {
                                       $row = $result->fetch_assoc(); 
                                          echo  $row["bibliographie"];
                                      }} ?></p>

                  <h5 class="card-title">Details du profil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nom complet</div>
                    <div class="col-lg-9 col-md-8"><?php
                    
                    $connexion = new mysqli("localhost", "root", "", "entreprise");
                      if (isset($_SESSION['email'])) {
                        $email = $_SESSION['email'];
                        
                      $result = $connexion -> query("SELECT * FROM info_ressource_agent");
                             if ($result->num_rows > 0) {
                                       $row = $result->fetch_assoc(); 
                                          echo  $row["nom"];
                                      }} ?></div>
                      </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Compagnie</div>
                    <div class="col-lg-9 col-md-8"><?php
                    $connexion = new mysqli("localhost", "root", "", "entreprise");

                      $resulta = $connexion -> query("SELECT compagnie FROM info_ressource_agent");
                             if ($resulta->num_rows > 0) {
                             
                                      while ($row = $resulta->fetch_assoc()) {
                                          echo  $row["compagnie"] ;
                                      }} ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Travail</div>
                    <div class="col-lg-9 col-md-8"><?php
                    $connexion = new mysqli("localhost", "root", "", "entreprise");

                      $result = $connexion -> query("SELECT travail FROM info_ressource_agent ");
                             if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          echo  $row["travail"] ;
                                      }} ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pays</div>
                    <div class="col-lg-9 col-md-8"><?php 
                     $result = $connexion -> query("SELECT pays FROM info_ressource_agent ");
                    if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          echo  $row["pays"] ;
                                      }}  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Adresse</div>
                    <div class="col-lg-9 col-md-8"><?php
                     $result = $connexion -> query("SELECT adresse FROM info_ressource_agent ");
                    if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          echo  $row["adresse"] ;
                                      }}  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Contact</div>
                    <div class="col-lg-9 col-md-8"><?php
                     $result = $connexion -> query("SELECT contact FROM info_ressource_agent ");
                    if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          echo  $row["contact"] ;
                                      }}  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php 
                     $result = $connexion -> query("SELECT email FROM info_ressource_agent ");
                    if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          echo  $row["email"] ;
                                      }}  ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Twitter</div>
                    <div class="col-lg-9 col-md-8"><?php
                     $result = $connexion -> query("SELECT twitter FROM info_ressource_agent ");
                    if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          echo  $row["twitter"] ;
                                      }}  ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Facebook</div>
                    <div class="col-lg-9 col-md-8"><?php 
                     $result = $connexion -> query("SELECT facebook FROM info_ressource_agent ");
                    if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          echo  $row["facebook"] ;
                                      }}  ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Instagram</div>
                    <div class="col-lg-9 col-md-8"><?php 
                     $result = $connexion -> query("SELECT instagram FROM info_ressource_agent ");
                    if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          echo  $row["instagram"] ;
                                      }}  ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Linkedin</div>
                    <div class="col-lg-9 col-md-8"><?php 
                     $result = $connexion -> query("SELECT linkedin FROM info_ressource_agent ");
                    if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          echo  $row["linkedin"] ;
                                      }}  ?></div>
                  </div>
                  </div>
                     </form>
                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action = "" method = "POST">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image</label>
                      <div class="col-md-8 col-lg-9">
                      <!--  <img src="assets/img/profile-img.jpg" alt="Profile"> -->
                        <div class="pt-2">
                          <input type="file" id="image" name="image" accept="image/*" class="" title="Upload new profile image" ><br>
                          <a href="" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom complet</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">A propos de </label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" style="height: 100px" <?php ?>></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Compagnie</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control"  <?php  ?> >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Travail</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control"  <?php  ?>>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Pays</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control"  <?php  ?> >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Adresse</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" <?php  ?> >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Contact</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" <?php  ?> >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" <?php  ?> >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Profil_Twitter </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" <?php  ?> >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Profil_Facebook </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control"<?php ?> >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Profil_Instagram </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control"<?php ?> >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Profil_Linkedin </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control"  <?php ?> >
                      </div>
                    </div>

                    <div class="text-center">
                      <input type="submit" value="Sauvergarder les changements" class="btn btn-primary" name="OKK">
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Notifications_Email</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                          Modifications apportées à votre compte
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information sur les nouveaux produits et services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                          Offres marketing et promotionnelles
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Alerte de securite
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="save">Sauvegarder les changements</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mot de passe actuel</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de passe</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmez votre mot de passe</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="changed" >Changer le mot de passe</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>MILLENIUM</span></strong>. Tous droits reservés
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-php-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
<script>
  AOS.init();
</script>
</php>