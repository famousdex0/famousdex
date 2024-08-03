<?php
SESSION_start();

require 'vendor/autoload.php'; // Chargez PHPMailer


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Connexion à la base de données (à adapter selon votre configuration)
$connexion = new mysqli("localhost", "root", "", "entreprise");

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}




// Récupération des données du formulaire
if(isset($_POST['valider']))
{
   
@$nom = $_POST['nom'];
@$prenom = $_POST['prenom'];
@$email = $_POST['email'];
@$fonction = $_POST['dire'];
@$mdp = $_POST['password'];
@$service = $_POST['service'];

$_SESSION["nom"] = $_POST['nom'];
$_SESSION["prenom"] = $prenom;
$_SESSION['email'] = $_POST['email'];
$_SESSION['fonction'] = $_POST['dire'];
$code = uniqid();


// Requête SQL pour vérifier si l'email existe déjà dans la base de données
$sql = "SELECT email FROM directeur WHERE email = '$email' 
UNION SELECT email FROM agent WHERE email = '$email' 
UNION SELECT email FROM respo WHERE email = '$email' 
UNION SELECT email FROM technicien WHERE email = '$email' ";

$result = $connexion->query($sql);

if ($result->num_rows == 0) {

        // Génération d'un code de confirmation unique
$code_confirmation = uniqid();

// Enregistrement de l'utilisateur dans la base de données avec le code de confirmation
if($_POST['dire'] == 'Directeur') { $sql_ve = "INSERT INTO directeur (nom, code_user, prenom, email, fonction, service, mot_de_passe) 
  VALUES ('$nom', '$code', '$prenom', '$email', '$fonction', '$service', '$mdp') ";
  $connexion->query($sql_ve); } 

  if($_POST['dire'] == 'Responsable de service') {$sql_verr = "INSERT INTO respo (nom, code_user, prenom, email, fonction, service, mot_de_passe) 
    VALUES ('$nom', '$code', '$prenom', '$email', '$fonction', '$service', '$mdp') ";
    $connexion->query($sql_verr);} 

    if($_POST['dire'] == 'Agent de maitrise') { $sql_verrr = "INSERT INTO agent (nom, code_user, prenom, email, fonction, service, mot_de_passe) 
      VALUES ('$nom', '$code', '$prenom', '$email', '$fonction', '$service', '$mdp') ";
      $connexion->query($sql_verrr);} 

      if($_POST['dire'] == 'Technicien') {
        $sql_verrrr = "INSERT INTO technicien (nom, code_user, prenom, email, fonction, service, mot_de_passe) 
        VALUES ('$nom', '$code', '$prenom', '$email', '$fonction', '$service', '$mdp') ";
        $connexion->query($sql_verrrr);
        }

if (strlen($mdp) < 8 || !preg_match('/[A-Z]/', $mdp) || !preg_match('/[0-9]/', $mdp) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $mdp)) {
  // Le mot de passe ne satisfait pas aux critères de complexité ou dépasse la longueur maximale
   header("Location: pages-register.php");
   
  } else{
    $_SESSION["prenom"] = $prenom;
    $_SESSION["email"] = $email;

    // Vérifier le résultat de la requête
      
// Envoi de l'e-mail de confirmation
$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Remplacez par votre serveur SMTP
    $mail->SMTPAuth   = true;
    $mail->Username   = 'daix.kakou@gmail.com'; // Remplacez par votre adresse e-mail SMTP
    $mail->Password   = 'myqlbnccncggyrtv'; // Remplacez par votre mot de passe SMTP
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
      header("Location: verification.php");
    $mail->setFrom('daix.kakou@gmail.com', 'MILLENIUM');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Confirmation d\'inscription';
    $mail->Body    = "Merci de bien vouloir vous être inscrire. Cliquez sur le lien suivant pour confirmer votre inscription :<a href='http://localhost/wetransfer_template-pour-appli-web_2023-11-16_1842/appliweb/pages-login.php'>Confirmer l'inscription</a>";
    
    $mail->send();
    echo 'Un e-mail de confirmation a été envoyé à votre adresse e-mail. Veuillez vérifier votre boîte de réception.';

        //Verification de la fonction 
   
} catch (Exception $e) {
    echo "Erreur d'envoi d'e-mail : {$mail->ErrorInfo}";
}exit();



      
     
}
    } else {$_SESSION['ERREUR'] = "OUPS!!!!, E-mail existe déjà!";   }
}
mysqli_close($connexion);
?>



<!DOCTYPE html>
<php lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
<!-- ANIMATION JS -->
<link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-php-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body data-aos="fade-right" data-aos-duration="4000">

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">MILLENIUM</span>
                </a>
              </div><!-- End Logo -->
     
              <div class="card mb-3" role="alert" style="box-shadow: 10px 10px 5px 10px black" data-aos="fade-right" data-aos-duration="300">
    <?php 
    if (isset($_SESSION['ERREUR'])) { 
        $email = $_SESSION['email']; // Définir la variable email
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Désolé, </strong> L'email <strong><?php echo $email; ?></strong> existe déjà dans la base de données. 
        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['ERREUR']); } ?>


                <div class="card-body" >
                
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Creer un compte</h5>
                    <p class="text-center small">Entrez votre details personnels pour la creation de votre de compte</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="POST" action="">
                    <div class="col-12">
                      <label for="Votre nom" class="form-label">Nom </label>
                      <input type="text" name="nom" class="form-control" id="Votre nom" required placeholder="Entrez votre nom svp...">
                      <div class="invalid-feedback">SVP, entrez votre nom!</div>
                    </div>
                     
                    <div class="col-12">
                      <label for="Votre prenom" class="form-label">Prenom</label>
                      <input type="text" name="prenom" class="form-control" id="Votre prenom" required placeholder="Entrez votre prenom svp...">
                      <div class="invalid-feedback">SVP, entrez votre prenom!</div>
                    </div>

                    <div class="col-12">
                      <label for="Votre Email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="Votre Email" required placeholder="Entrez votre adresse-email svp...">
                      <div class="invalid-feedback">SVP, entrez votre email!</div>
                    </div>

                         
                
                    <div class="col-12" name="dir">
                      <label for="Votre fonction" class="form-label">Fonction</label><br>
                     <style> @media (max-width: 720px) {
                      .fonction:focus{ border-color:#4a78c7; color: black; 
                       box-shadow: 0 2px 2px 2px #4a78c7;}
    .fonction{
    font-size: 10px;
    left: 2px;
    position: relative;
    border-radius: 5px;
    height: 40px;
    width:500px;
    border: 1px solid #3d3a3a;
    outline: black ;
    
  }
  .service{
    font-size: 10px;
    left: 2px;
    position: relative;
    border-radius: 5px;
    height: 40px;
    width:500px;
    border: 1px solid #3d3a3a;
    outline: black ;
  }

}
.service:focus,
  .fonction:focus { border-color:#4a78c7; color: black; 
   
box-shadow: 0 2px 2px 2px #4a78c7; }
.fonction{
    font-size: 15px;
    left: 2px;
    position: relative;
    border-radius: 5px;
    height: 40px;
    width: 400px;
    border: 0,5px solid #3d3a3a;
    outline: transparent;
  }
  .service{
    font-size: 15px;
    left: 2px;
    position: relative;
    border-radius: 5px;
    height: 40px;
    width: 400px;
    border: 0,5px solid #3d3a3a;
    outline: transparent;
  }
</style>
                      <select  class="fonction"  name="dire"  required class="form-control">
                      <option name="diro"></option>
                      <option value="Directeur" name="dir"> DIRECTEUR </option>
                      <option value="Responsable de service" name="dir"> RESPONSABLE DE SERVICE</option>
                      <option value="Agent de maitrise" name="dir"> AGENT DE MAITRISE</option>
                      <option value="Technicien" name="dir"> TECHNICIEN</option>
                    
                      
                       </select><div class="invalid-feedback">Svp selectionnez votre fontion!</div>
                    </div>
                    
                    <div class="col-12">Service
                    <select  class="service"  name="service"  required class="form-control">
                      <option name="ser"></option>
                      <option value="Administrateur" name="serv"> ADMINISTRATEUR</option>
                      <option value="Secretaire" name="serv"> SECRETAIRE</option>
                      <option value="Finance et comptabilite" name="serv"> FINANCE ET COMPTABILITE</option>
                      <option value="Marketing et commercial" name="serv"> MARKETING ET COMMERCIAL</option>
                      <option value="Ressources humaines" name="serv"> RESSOURCES HUMAINES</option>
                      
                    
                      
                       </select>
                      <div class="invalid-feedback">Svp entrez votre service!</div>
                       
                    </div>
              
                    <div class="col-12">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" name="password" class="form-control" id="password" required placeholder="Entrez votre mot de passe svp...">
    <div class="invalid-feedback">SVP, entrez votre mot de passe!</div><br>
    <div class="errors">

    
        <span id="chiffre" class="chiffre" style="color:gray"> &nbsp;Votre mot de passe doit avoir 1 chiffre</li><br>
        <span id="majuscule" class="majuscule" style="color:gray"> &nbsp;Votre mot de passe doit avoir 1 lettre majuscule</li><br>
        <span id="caractere" class="caractere"> &nbsp;Votre mot de passe doit avoir 1 lettre caractère</li><br>
        <span id="generique" class="generique"> &nbsp;Votre mot doit comporter 8 caractères au minimum</li>
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
            
            // Vérifier si le mot de passe respecte la règle
           

        // Attachez la fonction validate à l’événement keyup de l’entrée
        document.getElementById('password').addEventListener('keyup', validate);
    </script>
             </div>     
        <br>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Je suis d accord et j accepte les <a href="#">termes et conditions</a></label>
                        <div class="invalid-feedback">Tu dois d abord cocher cette case.</div>
                      </div>
                    </div>
                    <div class="col-12">
                        
                      <button class="btn btn-primary w-100" type="submit" name="valider">Créer un compte</button>
                      <div class="col-12">
                        </div>
                      <p class="small mb-0">Vous aviez deja un compte? <a href="pages-login.php">Se connecter</a></p><style>button.btn:hover{font-size: 25px; letter-spacing: 5px; color:Yellow; font-family:"times new roman", sans-serif; transition: all 300ms ease-in-out; box-shadow: 0 5px 15px yellow; transform: scale(1,0.9);}</style>
                    </div>
                  </form>

                </div>
              </div>
              
              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-php-template/ -->
              &nbsp;  Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
<script>
  AOS.init();
</script>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/newFile.js"></script>
</body>

</php>