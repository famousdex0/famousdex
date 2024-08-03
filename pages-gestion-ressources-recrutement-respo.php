<?php 
session_start();

// Vérifiez si l'ID de l'utilisateur à supprimer est passé en paramètre GET
if(isset($_POST['supp'])) {
    // Récupérez l'ID de l'utilisateur à partir du paramètre GET
    $id = $_GET['id'];

    // Connexion à la base de données
    $connexion = new mysqli("localhost", "root", "", "entreprise");

  
    // Requête pour supprimer l'utilisateur de la base de données
    $query = "DELETE FROM pages_gestion_ressources_absences_respo WHERE pages_gestion_ressources_absences_respo.id ='$id' ";
    $result = $connexion->query($query);

    // Vérifiez si la suppression a réussi
    if ($result) {
        // Redirigez l'utilisateur vers une page de confirmation ou une autre page appropriée
        header("Location: pages-tache-ressources-respo.php");
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

  <title>Pages / tache - Niceressources-respo Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/style_msgbox.css">
  <!-- =======================================================
  * Template Name: Niceressources-respo
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-ressources-respo-bootstrap-ressources-respo-php-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 600%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: white;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 900px;
            height: 1400px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-header {
            background-color: #3498db;
            color: white;
            padding: 10px;
        }
        .modal-body label {
            font-weight: bold;
        }
        .section {
            margin-bottom: 20px;
        }
    </style>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index-ressources-respo.php" class="logo d-flex align-items-center">
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
            $sql = "SELECT nom, prenom, service FROM respo WHERE email = '$email'";
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
            $sql = "SELECT nom, prenom FROM respo WHERE email = '$email'";
            $result = $connexion->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "Salut " . $row["nom"] . " " . $row["prenom"];
            } else {
                echo "Aucun respo trouvé.";
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
              <a class="dropdown-item d-flex align-items-center" href="users-profile-ressources-respo.php">
                <i class="bi bi-person"></i>
                <span>Mon profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

      

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile-ressources-respo.php">
                <i class="bi bi-gear"></i>
                <span>Paramètre</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq-ressources-respo.php">
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
        <a class="nav-link collapsed" href="index-ressources-respo.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- End Forms Nav -->

     

      <!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile-ressources-respo.php">
          <i class="bi bi-person"></i>
          <span>Profil</span>
        </a>
      </li><!-- End Profile Page Nav -->
      <li class="nav-item">
        <a class="nav-link " href="pages-gestion-ressources-recrutement-respo.php">
          <i class="bi bi-file-earmark-text"></i>
          <span>Gestion des talents et recrutements</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-gestion-ressources-list-respo.php">
          <i class="bi bi-card-checklist"></i>
          <span>Liste des talents et recrutements</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-tache-ressources-respo.php">
          <i class="bi bi-list-task"></i>
          <span>Tâches & Rapports</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact-ressources-respo.php">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

     


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main" data-aos-duration="600" data-aos="fade-left" data-aos-delay="500">
        <div class="pagetitle">
            <h1>GERER LES TALENTS ET LES RECRUTEMENTS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index-ressources-respo.php">Accueil</a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">talents et recrutements</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        
        <div class="container mt-5">
            <h1 class="text-center">Gestion des Talents et Recrutements</h1>
            <div class="text-center mt-4">
                <button type="button" class="btn btn-primary" onclick="openModal('task')">
                    Ouvrir le Formulaire
                </button>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal" id="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gestion des Talents et Recrutements</h5>
                    <span class="close-button" onclick="closeModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <form id="task-form" method="POST">
                        <input type="hidden" name="type" value="task">

                        <div class="section">
                            <h2>Processus de Recrutement</h2>
                            <label for="position">Poste à pourvoir :</label>
                            <input type="text" id="position" name="position" required class="form-control">
                            
                            <label for="department">Département :</label>
                            <input type="text" id="department" name="department" required class="form-control">
                            
                            <label for="requirements">Exigences du poste :</label>
                            <textarea id="requirements" name="requirements" rows="4" required class="form-control"></textarea>
                            
                            <label for="recruitment_date">Date de début du recrutement :</label>
                            <input type="date" id="recruitment_date" name="recruitment_date" required class="form-control">
                            
                            <label for="recruitment_steps">Étapes du processus de recrutement :</label>
                            <textarea id="recruitment_steps" name="recruitment_steps" rows="4" required class="form-control"></textarea>
                        </div>
                        
                        <div class="section">
                            <h2>Gestion des Talents</h2>
                            <label for="employee_name">Nom et prenom de l'employé :</label>
                            <input type="text" id="employee_name" name="employee_name" required class="form-control">
                            
                            <label for="employee_position">Poste actuel :</label>
                            <input type="text" id="employee_position" name="employee_position" required class="form-control">
                            
                            <label for="skills">Compétences :</label>
                            <textarea id="skills" name="skills" rows="4" required class="form-control"></textarea>
                            
                            <label for="development_plan">Plan de développement :</label>
                            <textarea id="development_plan" name="development_plan" rows="4" required class="form-control"></textarea>
                            
                            <label for="evaluation_date">Date de la dernière évaluation :</label>
                            <input type="date" id="evaluation_date" name="evaluation_date" required class="form-control">
                            
                            <label for="evaluation_comments">Commentaires sur l'évaluation :</label>
                            <textarea id="evaluation_comments" name="evaluation_comments" rows="4" required class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Soumettre</button>
                    </form>
                </div>
            </div>
        </div>
       
    </main>

    <script>
        function openModal(type) {
            document.getElementById('modal').style.display = 'flex';
            if (type === 'task') {
                document.getElementById('task-form').style.display = 'block';
            } 
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>

<script>
    // Fonction pour supprimer un élément en utilisant AJAX
    function deleteElement(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
            // Créez un objet XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Configurez la requête
            xhr.open('POST', 'delete_element.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            // Définissez ce qui se passe quand la requête est terminée
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Rechargez la page après la suppression réussie
                    location.reload();
                }
            };

            // Envoyez la requête avec l'ID de l'élément à supprimer
            xhr.send('id=' + id);
        }
    }
</script>

    


    </main ><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer justify-content-center" style="position:relative;  top:2000px; display:flex; align-items:center;">
    <div class="copyright">
      &copy; Copyright <strong><span>MILLENIUM</span></strong>. Tous droits reservés
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-ressources-respo-bootstrap-ressources-respo-php-template/ -->
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

</php>
<script>
  AOS.init();
</script>