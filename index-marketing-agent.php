<?php 
session_start();

// Vérifiez si l'ID de l'utilisateur à supprimer est passé en paramètre GET
if(isset($_POST['supp'])) {
    // Récupérez l'ID de l'utilisateur à partir du paramètre GET
    $id = $_GET['id'];

    // Connexion à la base de données
    $connexion = new mysqli("localhost", "root", "", "entreprise");

  
    // Requête pour supprimer l'utilisateur de la base de données
    $query = "DELETE FROM tache WHERE tache.id ='$id' ";
    $result = $connexion->query($query);

    // Vérifiez si la suppression a réussi
    if ($result) {
        // Redirigez l'utilisateur vers une page de confirmation ou une autre page appropriée
        header("Location: pages-tache-marketing-agent.php");
        exit();
    } else {
        // Affichez un message d'erreur ou redirigez l'utilisateur vers une page d'erreur
        echo "Une erreur s'est produite lors de la suppression de l'utilisateur.";
        exit();
    }

}


?>


<!DOCTYPE php>
<php lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / tache - Nicemarketing-agent Bootstrap Template</title>
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

  <link rel="stylesheet" href="assets/css/style_msgbox.css">
  <!-- =======================================================
  * Template Name: Nicemarketing-agent
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-marketing-agent-bootstrap-marketing-agent-php-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
 .modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
}
.modal-content {
  background-color: #fff;
  padding: 40px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 900px;
  height: 800px;}

   /* Pour le dashboard */
   .dashboard {
              max-width: 1200px;
              margin: 0 auto;
          }

          .stats {
              display: flex;
              justify-content: space-between;
              margin-bottom: 20px;
          }

          .stat-box {
              background-color:aquamarine;
              padding: 20px;
              border-radius: 10px;
              box-shadow: 10px 5px 4px 6px black ;
              text-align: center;
              flex: 1;
              margin: 0 10px;
          }

          .stat-box.income {
              background-color: #ff7b7b;
              color: #fff;
          }

          .stat-number {
              font-size: 24px;
              font-weight: bold;
          }

          .stat-label {
              color: black;
              font-size: 20px;
              
          }

          .content {
              display: flex;
              justify-content: space-between;
          }

          .recent-projects, .new-customers {
              background-color: #fff;
              padding: 20px;
              border-radius: 10px;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
              width: 48%;
          }

          .header {
              display: flex;
              justify-content: space-between;
              align-items: center;
              margin-bottom: 20px;
          }

          .see-all {
              background-color: #ff7b7b;
              color: #fff;
              border: none;
              padding: 10px 20px;
              border-radius: 5px;
              cursor: pointer;
          }

          .see-all:hover {
              background-color: aqua;
              color: black;
              border: none;
              transition: all 0.2s ease-in;
              transform: scaleX(1.1);
              cursor: pointer;
          }

          table {
              width: 100%;
              border-collapse: collapse;
          }

          th, td {
              padding: 10px;
              text-align: left;
          }

          th {
              background-color: #f4f5f7;
          }

          .status {
              padding: 5px 10px;
              border-radius: 20px;
              color: #fff;
              text-align: center;
              display: inline-block;
          }

          .status.review {
              background-color: #7bff7b;
          }

          .status.in-progress {
              background-color: #ffc107;
          }

          .status.pending {
              background-color: #ff7b7b;
          }

          .customer {
              display: flex;
              align-items: center;
              margin-bottom: 10px;
          }

          .avatar {
              border-radius: 50%;
              width: 40px;
              height: 40px;
              margin-right: 10px;
          }

          .info {
              flex: 1;
          }

          .name {
              font-weight: bold;
          }

          .position {
              color: #888;
          }

          .contact-icons {
              display: flex;
              gap: 10px;
          }

          .email-icon, .phone-icon {
              font-size: 20px;
              cursor: pointer;
          }

</style>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index-marketing-agent.php" class="logo d-flex align-items-center">
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
                echo "<i class='bi bi-circle' style='background-color:red; border-radius:50px'></i>&nbsp;Hors ligne.";
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
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
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
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
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
                echo "Aucun agent trouvé.";
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
              <h6>UTILISATEUR</h6>
              <span>...travail</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile-marketing-agent.php">
                <i class="bi bi-person"></i>
                <span>Mon profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

      

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile-marketing-agent.php">
                <i class="bi bi-gear"></i>
                <span>Paramètre</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq-marketing-agent.php">
                <i class="bi bi-question-circle"></i>
                <span>Besoin d aide ?</span>
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
  <aside id="sidebar" class="sidebar" data-aos="fade-right" data-aos-delay="300" data-aos-duration="400">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index-marketing-agent.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- End Forms Nav -->

     

      <!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile-marketing-agent.php">
          <i class="bi bi-person"></i>
          <span>Profil</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-gestion-marketing-agent.php">
          <i class="bi bi-book"></i>
          <span>Gestion des produits et clientèle</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-tache-marketing-agent.php">
          <i class="bi bi-list-task"></i>
          <span>Tâches & Rapports</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact-marketing-agent.php">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

     


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main" data-aos-duration="600" data-aos="fade-left" data-aos-delay="500">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index-admin.php">Accueil</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="dashboard">
        <div class="stats">
            <div class="stat-box">
                <p class="stat-number">54</p>
                <p class="stat-label">Clientèles</p>
            </div>
            <div class="stat-box">
                <p class="stat-number">79</p>
                <p class="stat-label">Projets</p>
            </div>
            <div class="stat-box">
                <p class="stat-number">124</p>
                <p class="stat-label">Orders</p>
            </div>
            <div class="stat-box income">
                <p class="stat-number">$6k</p>
                <p class="stat-label">Revenus</p>
            </div>
        </div>
        <div class="content">
            <div class="recent-projects">
                <div class="header">
                    <h3>Projets recents</h3>
                    <button class="see-all">Tout voir</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Titre du projet</th>
                            <th>Departement</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>UI/UX Design</td>
                            <td>UI Team</td>
                            <td><span class="status review">Révesion</span></td>
                        </tr>
                        <tr>
                            <td>Web development</td>
                            <td>Frontend</td>
                            <td><span class="status in-progress">En progression</span></td>
                        </tr>
                        <tr>
                            <td>Ushop app</td>
                            <td>Mobile Team</td>
                            <td><span class="status pending">En instance</span></td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
            <div class="new-customers">
                <div class="header">
                    <h3>Nouveaux clients</h3>
                    <button class="see-all">Tout voir</button>
                </div>
                <div class="customer">
                    <img src="avatar.jpg" alt="Avatar" class="avatar">
                    <div class="info">
                        <p class="name">EZA BA PUISSANCE ABSOLU</p>
                        <p class="position">PDG</p>
                    </div>
                    <div class="contact-icons">
                        <a href="pages-contact-admin.php" ><span class="email-icon">📧</span></a>
                    </div>
                </div>
                <!-- Repeat customer blocks as needed -->
            </div>
        </div>
    </div>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer justify-content-center" style="position:relative;  top:2000px; display:flex; align-items:center;">
    <div class="copyright">
      &copy; Copyright <strong><span>MILLENIUM</span></strong>. Tous droits reservés
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-marketing-agent-bootstrap-marketing-agent-php-template/ -->
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