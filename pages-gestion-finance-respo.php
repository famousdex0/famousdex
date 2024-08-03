<?php 
session_start();

// Vérifiez si l'ID de l'utilisateur à supprimer est passé en paramètre GET
if(isset($_POST['supp'])) {
    // Récupérez l'ID de l'utilisateur à partir du paramètre GET
    $id = $_GET['id'];

    // Connexion à la base de données
    $connexion = new mysqli("localhost", "root", "", "entreprise");

  
    // Requête pour supprimer l'utilisateur de la base de données
    $query = "DELETE FROM pages_gestion_finance_respo WHERE pages_gestion_finance_respo.id ='$id' ";
    $result = $connexion->query($query);

    // Vérifiez si la suppression a réussi
    if ($result) {
        // Redirigez l'utilisateur vers une page de confirmation ou une autre page appropriée
        header("Location: pages-tache-finance-respo.php");
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

  <title>Pages / tache - Nicefinance-respo Bootstrap Template</title>
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
  * Template Name: Nicefinance-respo
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-finance-respo-bootstrap-finance-respo-php-template/
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
  height: 800px;
}
</style>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index-finance-respo.php" class="logo d-flex align-items-center">
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
                echo "Aucun responsable trouvé.";
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
              <a class="dropdown-item d-flex align-items-center" href="users-profile-finance-respo.php">
                <i class="bi bi-person"></i>
                <span>Mon profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

      

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile-finance-respo.php">
                <i class="bi bi-gear"></i>
                <span>Paramètre</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq-finance-respo.php">
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
        <a class="nav-link collapsed" href="index-finance-respo.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <!-- End Forms Nav -->

     

      <!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile-finance-respo.php">
          <i class="bi bi-person"></i>
          <span>Profil</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link" href="pages-gestion-finance-respo.php">
          <i class="bi bi-book"></i>
          <span>Gestion de la comptabilité </span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-tache-finance-respo.php">
          <i class="bi bi-list-task"></i>
          <span>Tâches & Rapports</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact-finance-respo.php">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

     


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main"  data-aos-duration="600" data-aos="fade-right" data-aos-delay="500">

    <div class="pagetitle">
      <h1>GERER LES PRODUITS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index-finance-respo.php">Accueil</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Vente des produits</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    
    <section class="tache-rapport">
    <div class="tacherapport d-grid">
        <table class="table" style="width: max-content; margin: 0 auto;">
            <h2>Liste de ventes de produits</h2>
            <button class="add-button" onclick="openModal('task')" style="width:200px; height:100px;">AJOUTER UNE COMMANDE</button><br><br>
            <!-- AFFICHER LES DONNÉES DE LA BASE DE DONNÉES DANS UNE DIV -->
            <div class="table-responsive d-flex justify-content-center">
                <table class="table" style="width: max-content; box-shadow: 1px 1px 10px black; position: absolute; top: 500px;">
                    <thead>
                        <tr>
                            <th style="color: red; letter-spacing: 2px;">ID</th>
                            <th style="color: red;">TYPE</th>
                            <th style="color: red;">DATE</th>
                            <th style="color: red;">MONTANT DU BON</th>
                            <th style="color: red;">TYPE DE FACTURE</th>
                            <th style="color: red;">NOM DU CLIENT</th>
                            <th style="color: red;">PRÉNOM DU CLIENT</th>
                            <th style="color: red;">CONTACT DU CLIENT</th>
                            <th style="color: red;">PRIX UNITAIRE</th>
                            <th style="color: red;">QUANTITÉ</th>
                            <th style="color: red;">REMISE</th>
                            <th style="color: red;">TVA</th>
                            <th style="color: red;">MONTANT TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connexion à la base de données (à adapter selon votre configuration)
                        $connexion = new mysqli("localhost", "root", "", "entreprise");
                        // Préparez la base de données à rechercher les données
                        $envoi = "SELECT * FROM pages_gestion_finance_agent";
                        $mess = $connexion->query($envoi);
                        // Affichage des résultats
                        if ($mess->num_rows > 0) {
                            while ($row = $mess->fetch_assoc()) {
                                echo "<tr class='ligne-utilisateur'>";
                                echo "<td style='color: red;'>" . $row["id"] . "</td>";
                                echo "<td>" . $row["type_bon"] . "</td>";
                                echo "<td>" . $row["date_facture"] . "</td>";
                                echo "<td>" . $row["montant"] . "</td>";
                                echo "<td>" . $row["type_facture"] . "</td>";
                                echo "<td>" . $row["nom"] . "</td>";
                                echo "<td>" . $row["prenom"] . "</td>";
                                echo "<td>" . $row["contact"] . "</td>";
                                echo "<td>" . $row["prix_unitaire"] . "</td>";
                                echo "<td>" . $row["quantite"] . "</td>";
                                echo "<td>" . $row["remise"] . "</td>";
                                echo "<td>" . $row["tva"] . "</td>";
                                echo "<td>" . $row["montant_total"] . "</td>";
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
        </table>
    </div>
</section>

<!-- Modal principal -->
<div class="modal" id="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('standard')">&times;</span>
        <form id="task-form" method="POST" style="display: none;">
            <input type="hidden" name="type" value="task">
            <div>
                <label for="nom-report" style="color: red;"><strong>DATE</strong></label>
                <input type="date" id="nom-report" name="date_facture" class="form-control" required>
            </div><br>
            <div>
                <label for="nom" style="color: red;"><strong>TYPE DE BON</strong></label>
                <input type="text" id="type" name="type_bon" required class="form-control">
            </div>
            <div>
                <label for="designation" style="color: red;"><strong>MONTANT</strong></label>
                <input type="text" id="montant" name="montant" class="form-control" required oninput="calculateTotal()">
            </div><br><br><br>
            <div>
                <span style="font-size: 20px; font-weight: 600; font-family: Verdana, Geneva, Tahoma, sans-serif; letter-spacing: 5px;">FACTURE</span>
            </div>
            <div>
                <label for="nom" style="color: red;"><strong>TYPE DE FACTURE</strong></label>
            </div>
            <button class="add-button" type="button" onclick="openModal('taskk', 'pro')" style="width: 100px; height: 80px;">PRO-FORMAT</button>&nbsp;&nbsp;&nbsp;&nbsp;
            <br><br>
            <input type="submit" class="envoyer" value="ENVOYER" name="envoyer">
        </form>
    </div>
</div>


<!-- Modal pour Facture PRO-FORMAT -->
<div class="modal" id="modal-pro-format">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('pro')">&times;</span><center><label for="" style="color:black;font-size:20px">FACTURE PRO FORMA</label></center>
        <form id="taskk-form" method="POST">
            <input type="hidden" name="typee" value="taskk">
            <br>
            <div>
                <label for="type_facture" style="color: red;"><strong>TYPE DE FACTURE</strong></label>
                <input type="text" id="type_facture" name="type_facture" required class="form-control" readonly value="PRO-FORMA" style="color:blue">
            </div>
            <div>
                <label for="nom" style="color: red;"><strong>NOM</strong></label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div>
            <div>
                <label for="prenom" style="color: red;"><strong>PRÉNOM</strong></label>
                <input type="text" id="prenom" name="prenom" class="form-control" required>
            </div>
            <div>
                <label for="contact" style="color: red;"><strong>CONTACT</strong></label>
                <input type="text" id="contact" name="contact" class="form-control" required>
            </div>
            <div>
                <label for="prix_unitaire" style="color: red;"><strong>PRIX UNITAIRE</strong></label>
                <input type="number" id="prix_unitaire" name="prix_unitaire" class="form-control" required oninput="calculateTotal()">
            </div>
            <div>
                <label for="quantite" style="color: red;"><strong>QUANTITÉ</strong></label>
                <input type="number" id="quantite" name="quantite" class="form-control" required oninput="calculateTotal()">
            </div>
            <div>
                <label for="remise" style="color: red;"><strong>REMISE</strong></label>
                <input type="number" id="remise" name="remise" class="form-control" required oninput="calculateTotal()">
            </div>
            <div>
                <label for="tva" style="color: red;"><strong>TVA</strong></label>
                <input type="number" id="tva" name="tva" class="form-control" required oninput="calculateTotal()">
            </div>
            <div>
                <label for="montant_total" style="color: red;"><strong>MONTANT TOTAL</strong></label>
                <input type="text" id="montant_total" name="montant_total" class="form-control" required readonly>
            </div>
            <br><br><br>
            <input type="submit" class="envoyer" value="OKAY" name="enregistrer" style="position:absolute; top:840px">
        </form>
    </div>
</div>

<script>
function calculateTotal() {
   var code = parseFloat(document.getElementById('montant').value) || 0;
    var prixUnitaire = parseFloat(document.getElementById('prix_unitaire').value) || 0;
    var quantite = parseFloat(document.getElementById('quantite').value) || 0;
    var remise = parseFloat(document.getElementById('remise').value) || 0;
    var tva = parseFloat(document.getElementById('tva').value) || 0;
    
    var montantTotal = code + (prixUnitaire * quantite) - remise + tva;
    
    document.getElementById('montant_total').value = montantTotal.toFixed(2);
}
</script>


<script>
    function openModal(type, modalType) {
        if (modalType === 'pro') {
            document.getElementById('modal-pro-format').style.display = 'flex';
            document.getElementById('taskk-form').style.display = 'block';
        } else {
            document.getElementById('modal').style.display = 'flex';
            if (type === 'task') {
                document.getElementById('task-form').style.display = 'block';
            } else if (type === 'taskk') {
                document.getElementById('task-form').style.display = 'none';
                document.getElementById('taskk-form').style.display = 'block';
            }
        }
    }

    function closeModal(modalType) {
        if (modalType === 'pro') {
            document.getElementById('modal-pro-format').style.display = 'none';
        } else {
            document.getElementById('modal').style.display = 'none';
        }
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
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-finance-respo-bootstrap-finance-respo-php-template/ -->
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