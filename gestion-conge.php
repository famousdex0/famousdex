<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MILLENIUM</title>
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
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- Vendor CSS Files -->

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/s.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-php-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body class="bod">
<script>
  AOS.init();
</script>
<header class="nam"  data-aos="fade-down" data-aos-delay="300" data-aos-duration="500" ><a href="index-admin.php" class="im"><img src="assets/img/logo.png" alt="" class="ime" id="ime"> <span class="milleneium"> MILLENIUM</span></a></header>
    <section class="partone" data-aos="fade-right" data-aos-delay="800" data-aos-duration="1000" >
       <div class="one" > 
          <nav class="na">

             <div class="ones"><style>.lii{ text-decoration:none;}</style>
             <a href="users-connected.php" class="lii" id="myLink" > <strong> UTILISATEUR(S) CONNECTE(S)</strong></a>
             </div>
             <div class="ones"><style>.li{ text-decoration:none;}</style>
              <a href="gestion-absence.php" class="li" id="myLink"> <strong> GESTION ABSENCES</strong></a>
             </div>
             <div class="ones"><style>.lai{ color: rgb(255, 63, 63); text-decoration:underline;}</style>
             <a href="gestion-conge.php" class="lai" id="myLink" ><strong> GESTION CONGES</strong></a>
             </div>
             <div class="ones"><style>.li{ text-decoration:none;}</style>
             <a href="gestion_journalier.php" class="li" id="myLink">  <strong> GESTION POINTAGE JOURNALIER</strong></a>
             </div>
            
            </nav>
             <br><br>
        </div>
        <div class="two" >
            <div class="twoss">
                <table class="tb">
                    <tr class="trr" >
                       <srong> <td class="tt" >
                            #PHOTO
                        </td> 
                        <td class="tt">
                           NOM
                        </td>
                        <td class="tt">
                            PRENOM(S)
                        </td>
                        <td class="tt">
                            E-MAIL
                        </td>
                        <td class="tt">
                            MOTIF_CONGE
                        </td>
                        <td class="tt">
                            DATE_DEBUT
                        </td>
                        <td class="tt">
                           DATE_REPRISE
                        </td>
                        <td class="tt">
                           OPERATION
                        </td>
                    </strong>
                    </tr>
                    <tr class="trr">
                       <td>
                            #photo
                        </td>
                        <td>
                            #nom
                        </td>
                        <td>
                            #prenom
                        </td>
                        <td>
                            #email
                        </td>
                        <td>
                            #motif
                        </td>
                        <td>
                            #date deb
                        </td>
                        <td>
                            #date reprise
                        </td>
                        <td class="ope">
                            #EDIT #DEL #PRINT
                       </td>
                    </tr>
</table>
            </div>
        </div>
    </section>
    
</body>
</html>
<script>
    
    // Ajouter un gestionnaire d'événements au lien
    document.getElementById("myLink").addEventListener("click", function() {
        // Ajouter la classe active au clic
        this.classList.toggle("liii");
    });

</script>
<style>
 @media (max-width: 720px){
    
    .nam{
      justify-content: center;
      align-items: center;
     
    }

    .trr{
    border: 1px rgb(87, 219, 11) solid;
    justify-content: center;
    align-items: center;
  }
    .twoss{
      justify-content: center;
      align-items: center;
      position: relative;
      position: absolute;
     margin-left: -448px;
    }
   
    .na{
        position:relative;
       left:60px;
    display: flex;
    justify-content: center;
    align-items: right;
    font-size: 10px;
    padding-top: 10px;
    font-family: 'Times New Roman', Times, serif;
  }
  td{
    justify-content: center;
    align-items: center;
    margin: 10px;
    padding-left: 10px;
    padding-right: 10px;
  }
  .imen{
    width: 25px;
    height: 25px;
    position:relative;
    right:40px;
    top:-3px;
  }
  
  
  .ones{
    position:relative;
    display:flex;
    top:15px;
  }
  .tb{
    position:absolute;
    margin-top: 10px;
    
    margin-bottom: 15px;
    
  }
  }
 
</style>