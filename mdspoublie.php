<?php
session_start();
// Connexion à la base de données
$connexion = new mysqli("localhost", "root", "", "entreprise");

if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}




if (isset($_POST["login"])) {
    $password2 = $_POST["password2"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    
    // Si les deux mots de passes sont identiques
    if ($password == $password2) {
        $_SESSION["message"] = " <strong> DESOLE </strong> le mot de passe changé ne doit pas être identique à l'ancien";
        header("Location: mdspoublie.php");
      
        exit();
    }

    // Verifier s'ils existent 
    $stmt = $connexion->prepare(" SELECT email FROM directeur WHERE email = ? 
        UNION SELECT email FROM agent WHERE email = ? 
        UNION SELECT email FROM respo WHERE email = ? 
        UNION SELECT email FROM technicien WHERE email = ?
    ");
    $stmt->bind_param("ssss", $email, $email, $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        header("Location: mdspoublie.php");
        $_SESSION["message"] = " <strong> DESOLE </strong> , Email inexistant";
        exit();
    } else {
        // PREPARER LES TABLES OH
        $update_director = $connexion->prepare("UPDATE directeur SET mot_de_passe = ? WHERE email = ?");
        $update_director->bind_param("ss", $password2, $email);
        $update_director->execute();

        $update_agent = $connexion->prepare("UPDATE agent SET mot_de_passe = ? WHERE email = ?");
        $update_agent->bind_param("ss", $password2, $email);
        $update_agent->execute();

        $update_respo = $connexion->prepare("UPDATE respo SET mot_de_passe = ? WHERE email = ?");
        $update_respo->bind_param("ss", $password2, $email);
        $update_respo->execute();

        $update_technician = $connexion->prepare("UPDATE technicien SET mot_de_passe = ? WHERE email = ?");
        $update_technician->bind_param("ss", $password2, $email);
        $update_technician->execute();
            $_SESSION['message'] = "  Mot de passe changé avec succes ";
        header("Location: mdspoublie.php?success=password_updated");
        
        exit();
    }
}
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

  <!-- ======================================================mot_de_passe, email Template Name: NiceAdmimot_de_passe, email Updated: Sep 18 2023 with Bootstrap v5.3.mot_de_passe, email Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-php-templatemot_de_passe, email Author: BootstrapMade.comot_de_passe, email License: https://bootstrapmade.com/license/
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
              <div class="card mb-3">
              <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                   <?php  echo $_SESSION['message']; ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['message']); endif; ?>
                <div class="card-body"  >

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">CHANGEMENT DE MOT DE PASSE</h5>
                    <p class="text-center small"></p>
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
                      <label for="yourPassword" class="form-label"><b>ANCIEN MOT DE PASSE</b></label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required placeholder="Entrez votre mot de passe svp...">
                      <div class="invalid-feedback">SVP, entrez votre mot de passe!</div>
                    </div><br>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label"><b>NOUVEAU MOT DE PASSE</b></label>
                      <input type="password" name="password2" class="form-control" id="password" required placeholder="Entrez votre mot de passe svp...">
                      <div class="invalid-feedback">SVP, entrez votre mot de passe!</div>
                    </div>
                    <div class="errors"><br>

                
                    <span id="chiffre" class="chiffre" style="color:gray"> &nbsp;Votre mot de passe doit avoir 1 chiffre</li><br>
                    <span id="majuscule" class="majuscule" style="color:gray"> &nbsp;Votre mot de passe doit avoir 1 lettre majuscule</li><br>
                    <span id="caractere" class="caractere"> &nbsp;Votre mot de passe doit avoir 1 lettre caractère</li><br>
                    <span id="generique" class="generique"> &nbsp;Votre mot doit comporter 8 caractères au minimum</li>
                </div><br>
                   
                   
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login"><b>Se connecter</b></button><style>button.btn:hover{font-size: 25px; letter-spacing: 5px; color:Yellow; font-family:"times new roman", sans-serif; transition: all 300ms ease-in-out; box-shadow: 0 5px 15px yellow; transform: scale(1,0.9);}</style>
                    </div>
                    <div class="col-12">
                      <br><p class="small mb-0">Connectez-vous &nbsp; <a href="pages-login.php">Cliquez ici alors</a></p><br>
                     
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
    <script>
                    function validate() {
                        var pass = document.getElementById('password');
                        var upper = document.getElementById('majuscule');
                        var num = document.getElementById('chiffre');
                        var caractere = document.getElementById('caractere');
                        var len = document.getElementById('generique');

                        // POUR LE CHIFFRE
                        num.style.color = pass.value.match(/[0-9]/) ? 'green' : 'red';

                        // POUR LE CARCTERE AMAJUSCULE
                        upper.style.color = pass.value.match(/[A-Z]/) ? 'green' : 'red';

                        // POUR LE CARACTERE
                        caractere.style.color = pass.value.match(/[.@_*-,:]/) ? 'green' : 'red';

                        // POUR LE NOMBRE MINIMAL
                        len.style.color = pass.value.length >= 8 ? 'green' : 'red';
                    }

                    // Attachez la fonction validate à l’événement keyup de l’entrée
                    document.getElementById('password').addEventListener('keyup', validate);
    </script>
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