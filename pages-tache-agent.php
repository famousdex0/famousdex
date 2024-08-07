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
        header("Location: pages-tache-agent.php");
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

  <title>Pages / tache - Niceagent Bootstrap Template</title>
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/style_msgbox.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: Niceagent
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-agent-bootstrap-agent-php-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index-Agent.php" class="logo d-flex align-items-center">
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
                echo "Aucun directeur trouvé.";
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
              <a class="dropdown-item d-flex align-items-center" href="users-profile-agent.php">
                <i class="bi bi-person"></i>
                <span>Mon profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

      

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile-agent.php">
                <i class="bi bi-gear"></i>
                <span>Paramètre</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq-agent.php">
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
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index-Agent.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- End Forms Nav -->

     

      <!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile-agent.php">
          <i class="bi bi-person"></i>
          <span>Profil</span>
        </a>
      </li><!-- End Profile Page Nav -->

    

<li class="nav-item">
  <a class="nav-link " href="pages-tache-agent.php">
    <i class="bi bi-list-task"></i>
    <span>Tâches & Rapports</span>
  </a>
</li>



      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact-agent.php">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

     


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

  <div class="pagetitle">
  <h1>GERER LES PRODUITS</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index-marketing-agent.php">Accueil</a></li>
      <li class="breadcrumb-item">Pages</li>
      <li class="breadcrumb-item active">Vente des produits</li>
    </ol>
  </nav>
</div><!-- End Page Title -->


<section class="tache-rapport">
    <div class="tacherapport d-grid  " >
    <table class="table" style="width: max-content; margin: 0 auto; " >
            <h2>Liste de ventes de produits</h2>
            <button class="add-button" onclick="openModal('task')" style="width:200px; height:100px ;">AJOUTER UN PRODUIT</button><br><br>
            <!--  AFFICHER LES DONNES DE LA BASE DE DONNEES DANS UNE DIV -->
            <div class="table-responsive d-flex justify-content-center">
<table class="table" style="width: max-content; box-shadow:1px 1px 10px black; position:absolute;  top:500px">
    <thead>
        <tr>
            <th style="color: red; letter-spacing: 2px;">ID</th>
            <th style="color: red;">LIBELLE</th>
            <th style="color: red;">NOM</th>
            <th style="color: red;">DESIGNATION</th>
            <th style="color: red;">PRIX</th>
            <th style="color: red;">NOM DU CLIENT</th>
            <th style="color: red;">PRENOM DU CLIENT</th>
            <th style="color: red;">EMAIL DU CLIENT</th>
            <th style="color: red;">TELEPHONE DU CLIENT</th>
            <th style="color: red;">DATE </th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Connexion à la base de données (à adapter selon votre configuration)
            $connexion = new mysqli("localhost", "root", "", "entreprise");
            /* PREPAREZ LA BASE DE DONNEES A RECHERCHER LES DONNEES */
            $envoi = "SELECT * FROM tache_marketing_agent";
            $mess = $connexion->query($envoi);
            // Affichage des résultats
            if ($mess->num_rows > 0) {
                while ($row = $mess->fetch_assoc()) {
                    echo "<tr class='ligne-utilisateur'> ";
                    echo "<td style='color: red;'>".$row["id"]."</td>"; 
                    echo "<td>".$row["libelle"]."</td>";
                    echo "<td>".$row["description"]."</td>";
                    echo "<td>".$row["code"]."</td>";
                    echo "<td>".$row["date"]."</td>";
                    echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;<form method='post' action='delete_element.php'><input type='hidden' name='id' value='" . $row['id'] . "'><button type='submit' name='delete' class='btn btn-danger btn-sm' title='Supprimer un utilisateur'><i class='bi bi-trash'></i></button></form></td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun utilisateur trouvé.</td></tr>";
            }
            ?>
    </tbody>
</table>
</div>



        </div>
        
       <br><br><br><br><br>
        
   
        </div>
    </div>  
</section>

<div class="modal" id="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal()">&times;</span>
        <form id="task-form" method="POST" style="display: none;">
            <input type="hidden" name="type" value="task">
            <div>
                <label for="nom-report" style="color:red"><strong>DATE</strong></label>
                <input type="date" id="nom-report" name="date" class="form-control" required>
            </div><br>
            <div>
                <label for="nom" style="color:red"><strong>NOM DU PRODUIT</strong></label>
                <input type="text" id="titre" name="Titre" required class="form-control">
            </div>
            <div>
                <label for="designation" style="color:red"><strong>DESIGNATION DU PRODUIT</strong></label>
                <input type="text" id="designation" name="designation" class="form-control" required>
            </div>
            <div>
                <label for="designation" style="color:red"><strong>PRIX</strong></label>
                <input type="text" id="designation" name="designation" class="form-control" required>
            </div>
            <div>
                <label for="designation" style="color:red"><strong>NOM DU CLIENT</strong></label>
                <input type="text" id="designation" name="designation" class="form-control" required>
            </div>
            <div>
                <label for="designation" style="color:red"><strong>PRENOM DU CLIENT</strong></label>
                <input type="text" id="designation" name="designation" class="form-control" required>
            </div>
            <div>
                <label for="designation" style="color:red"><strong>EMAIL DU CLIENT</strong></label>
                <input type="email" id="designation" name="designation" class="form-control" required>
            </div>
            <div>
                <label for="designation" style="color:red"><strong>TELEPHONE DU CLIENT</strong></label>
                <input type="text" id="designation" name="designation" class="form-control" required>
            </div>
           
           
            <input type="submit" class="envoyer" value="ENVOYER" name="envoyer"></input>
        </form> <?php 
        
        ?>
    
        
        <form id="report-form"  method="POST" style="display: none;">
            <input type="hidden" name="type" value="report">
            <div>
                <label for="nom-report" style="color:red"><strong>DATE DU RAPPORT</strong></label>
                <input type="date" id="nom-report" name="datee" class="form-control" required>
            </div><br>
            <div>
                <label for="nom-report" style="color:red"><strong>TITRE DU RAPPORT</strong></label>
                <input type="text" id="nom-report" name="name" class="form-control" required>
            </div>
            <div>
                <label for="prenom-report" style="color:red"><strong>DESCRIPTION DU RAPPORT</strong></label>
                <textarea class="area" name="descrip" required class="form-control"></textarea> 
            </div>
            <div>
                <label for="category-report" style="color:red"><strong>ENVOYER A UN UTILISATEUR</strong></label>
                <select id="category-report" name="categoryy" required>
                <?php 
                   
                   $sqll = "SELECT * FROM directeur 
                   UNION 
                   SELECT * FROM agent
                   UNION 
                   SELECT * FROM respo
                   UNION 
                   SELECT * FROM technicien";
                    $connexion = new mysqli("localhost", "root", "", "entreprise");
                     $result = $connexion->query($sqll);
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option><tr><td style=td'color: red; font-weight:600;'>".$row['code_user']."</td></tr></option>"; 
                        }
                        
                    } if(isset($_POST["send"])){
                        $name =$_POST["name"];
                        $descrip =$_POST["descrip"];
                        $categoryy =$_POST["categoryy"];
                        $datee =$_POST["datee"];
                                                $descrip =$_POST["descrip"];
                                                $requ = "INSERT INTO rapport_marketing_agent (libelle, description, code, date) VALUES ('$name', '$descrip', '$categoryy', '$datee')"; 
                                                    $resu=$connexion->query($requ); 
                                                    header("Location:pages-tache-marketing-agent.php"); 

                } 
                    ?>
                </select>
            </div>
            <div class="info" style="color:blue"><strong>VOICI LA LISTE DES UTILISATEURS: </strong>
                <?php 
               $sql = "SELECT * FROM directeur 
               UNION 
               SELECT * FROM agent
               UNION 
               SELECT * FROM respo
               UNION 
               SELECT * FROM technicien";
                $connexion = new mysqli("localhost", "root", "", "entreprise");
                 $result = $connexion->query($sql);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option><tr><td  style='color: red; font-weight:600;'>".$row['code_user']." &nbsp;&nbsp; ".$row["nom"]."  &nbsp;&nbsp;".$row["prenom"]." &nbsp;&nbsp; ". $row["email"]." &nbsp;&nbsp; &nbsp;&nbsp;".$row["fonction"]." &nbsp;&nbsp;".$row["service"]."</td></tr></option>"; 
                    }}
                
                ?>
            </div>
            <input type="submit"class="envoyer" value="ENVOYER" name="send"></input>
        </form>
    </div>
</div>

<script>
    function openModal(type) {
        document.getElementById('modal').style.display = 'flex';
        if (type === 'task') {
            document.getElementById('task-form').style.display = 'block';
            document.getElementById('report-form').style.display = 'none';
        } else if (type === 'report') {
            document.getElementById('report-form').style.display = 'block';
            document.getElementById('task-form').style.display = 'none';
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
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-agent-bootstrap-agent-php-template/ -->
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