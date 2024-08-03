<?php
session_start();

// Si des cookies existent, les utiliser pour la connexion
if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $_POST['email'] = $_COOKIE['email'];
    $_POST['password'] = $_COOKIE['password'];
    $_POST['login'] = true;
    
  }  




// Connexion à la base de données (à adapter selon votre configuration)
$connexion = new mysqli("localhost", "root", "", "entreprise");

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Récupération des données du formulaire
if(isset($_POST['login']))
{

   

    $_SESSION['email'] = $_POST['email'];
    $email = $_POST['email'];
    $mdp = $_POST['password'];
    $remember = isset($_POST['remember']);

    // Vérifier pour le directeur
    $stmt = $connexion->prepare("SELECT email, mot_de_passe FROM directeur WHERE BINARY email = ? AND BINARY mot_de_passe = ?");
    $stmt->bind_param("ss", $email, $mdp);
    $stmt->execute();
    $result = $stmt->get_result();

    if(mysqli_num_rows($result) > 0){
        $check_stmt = $connexion->prepare("SELECT email, password FROM `connexion` WHERE BINARY email = ? AND BINARY password = ?");
        $check_stmt->bind_param("ss", $email, $mdp);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
      

        if(mysqli_num_rows($check_result) == 0) {
            $insert_stmt = $connexion->prepare("INSERT INTO `connexion` (email, password) VALUES (?, ?)");
            $insert_stmt->bind_param("ss", $email, $mdp);
            $insert_stmt->execute();
        } 

        header("Location: index-admin.php");
        exit;
    }

   // Vérification des responsables
$stmt = $connexion->prepare("SELECT email, mot_de_passe, service FROM respo WHERE BINARY email = ? AND BINARY mot_de_passe = ?");
$stmt->bind_param("ss", $email, $mdp);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) > 0) {
    $row = $result->fetch_assoc();
  
    switch ($row['service']) {
        case 'Finance et comptabilite':
            header("Location: index-finance-respo.php");
            exit;
        case 'Marketing et commercial':
            header("Location: index-marketing-respo.php");
            exit;
        case 'Ressources humaines':
            header("Location: index-ressources-respo.php");
            exit;
        default:
            header("Location: index-Respo.php");
            exit;
    }
}

// Vérification des agents
$stmt = $connexion->prepare("SELECT email, mot_de_passe, service FROM agent WHERE BINARY email = ? AND BINARY mot_de_passe = ?");
$stmt->bind_param("ss", $email, $mdp);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) > 0) {
    $row = $result->fetch_assoc();
   
    
    switch ($row['service']) {
        case 'Finance et comptabilite':
            header("Location: index-finance-agent.php");
            exit;
        case 'Marketing et commercial':
            header("Location: index-marketing-agent.php");
            exit;
        case 'Ressources humaines':
            header("Location: index-ressources-agent.php");
            exit;
            case 'Secretaire';
            header("Location: index-secretaire");
        default:
            header("Location: index-Agent.php");
            exit;
    }
}

    // Vérifier pour le technicien
    $stmt = $connexion->prepare("SELECT email, mot_de_passe FROM technicien WHERE BINARY email = ? AND BINARY mot_de_passe = ?");
    $stmt->bind_param("ss", $email, $mdp);
    $stmt->execute();
    $result = $stmt->get_result();

    if(mysqli_num_rows($result) > 0){
        $check_stmt = $connexion->prepare("SELECT email, password FROM `connexion` WHERE BINARY email = ? AND BINARY password = ?");
        $check_stmt->bind_param("ss", $email, $mdp);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
      
        if(mysqli_num_rows($check_result) == 0) {
            $insert_stmt = $connexion->prepare("INSERT INTO `connexion` (email, password) VALUES (?, ?)");
            $insert_stmt->bind_param("ss", $email, $mdp);
            $insert_stmt->execute();
        }

        header("Location: index.php");
        exit;
    }
   

    else{  $_SESSION['message'] = "E-mail ou mot de passe incorrecte ou inexistant";
    header("Location: pages-login.php");} // Redirection vers la page de connexion
    exit;
    
}

mysqli_close($connexion);
?>




<!DOCTYPE php>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Login - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
 
<!-- ANIMATION JS 
<link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">-->

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

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
<body data-aos="fade-right" data-aos-duration="4000">
    <form action="" method="POST">
  <main>
    <div class="container" id="#contai" >

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4" >
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="pages-login.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">MILLENIUM</span>
                </a>       
              </div><!-- End Logo -->
              <div class="card mb-3" style="box-shadow: 10px 10px 5px 10px black">
                <?php if (isset($_SESSION['message'])){ ?><div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Désolé</strong> <?php echo $_SESSION['message']; ?>
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div><?php unset($_SESSION['message']); } ?>
                <div class="card-body"  >

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">SE CONNECTER</h5>
                    <p class="text-center small">Entrez votre email & mot de passe pour vous connecter</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate>

                    <div class="col-12" >
                      <label for="yourUsername" class="form-label"><b>EMAIL</b></label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="email" class="form-control" id="Votre mail" required placeholder="Entrez votre adresse-email svp...">
                        <div class="invalid-feedback">SVP, entrez votre email.</div>
                      </div>
                    </div>
                  <br>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label"><b>MOT DE PASSE</b></label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required placeholder="Entrez votre mot de passe svp...">
                      <div class="invalid-feedback">SVP, entrez votre mot de passe!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" value="1" type="checkbox" name="remember" value="true" id="rememberMe"style="border: 1px solid black;">
                        <label class="form-check-label" for="rememberMe">Se souvenir</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login"><b>Se connecter</b></button><style>button.btn:hover{font-size: 25px; letter-spacing: 5px; color:Yellow; font-family:"times new roman", sans-serif; transition: all 300ms ease-in-out; box-shadow: 0 5px 15px yellow; transform: scale(1,0.9);}</style>
                    </div>
                    <div class="col-12">
                      <br><p class="small mb-0">OH !!!, VOUS N'AVEZ PAS DE COMPTE? &nbsp; <a href="pages-register.php">Cliquez ici alors</a></p><br>
                     <a href="mdspoublie.php"><u>MOT DE PASSE OUBLIE ?</u></a>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-php-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

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