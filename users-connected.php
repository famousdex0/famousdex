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
   <!-- Template Main CSS File -->
   <link href="assets/css/s.css" rel="stylesheet" type="text/css">

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
  
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">


  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-php-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<body class="bod">
<script>
  AOS.init();
</script>
    <header class="nam"  data-aos="fade-down" data-aos-delay="300" data-aos-duration="500" ><a href="index-admin.php" class="im"><img src="assets/img/logo.png" alt="" class="ime" id="ime"><span class="milleneium"> MILLENIUM</span></a></header>
    <section class="partone" data-aos="fade-right" data-aos-delay="800" data-aos-duration="1000" >
       <div class="one" > 
          <nav class="na" >
  
             <div class="ones" ><style>.lii{ color: rgb(255, 63, 63); text-decoration:underline;} </style>
             <a href="users-connected.php" class="lii" id="myLink" > <strong> UTILISATEUR(S) INSCRIT(S)</strong></a>
             </div>
            
             
            </nav>
             
        </div><br><br>
        <div class="two d-flex justify-content-center" style="margin-left:60px;">
          <div class="twos d-flex justify-content-center">
        <div class="table-responsive d-flex justify-content-center" >
            <table class="table " style="width: 1400px ; height: 300px ; margin-left:60px; ">
                <thead>
                    <tr >
                        <th style="color: red; letter-spacing: 2px;" >CODE_UTILISATEUR</th>
                        <th style="display:flex; padding-left: 40px; color: red;">NOM </th>
                        <th style="display:fixed; padding-left: 40px; color: red;">PRENOM(S)</th>
                        <th style="display:fixed; padding-left: 40px; color: red;">E-MAIL</th>
                        <th style="display:fixed; padding-left: 40px; color: red;">FONCTION</th>
                        <th style="display:fixed; padding-left: 40px; color: red;">SERVICE </th>
                        <th style="display:fixed; padding-left: 40px; color: red;">OPERATION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                          // Connexion à la base de données (à adapter selon votre configuration)
                          $connexion = new mysqli("localhost", "root", "", "entreprise");
                          /* PREPAREZ LA BASE DE DONNEES A RECHERCHER LES DONNEES */
                          $sql = "SELECT * FROM directeur 
                                  UNION 
                                  SELECT * FROM agent
                                  UNION 
                                  SELECT * FROM respo
                                  UNION 
                                  SELECT * FROM technicien";
                          $result = $connexion->query($sql);
                          // Affichage des résultats
                          if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                  echo "<tr class='ligne-utilisateur'> ";
                                  echo "<td style='font-weight: 1600;
                                  background-color: rgb(103, 103, 234); font-weight: 800 ; font-size: 20px; padding: 30px; letter-spacing: 2px;'>".$row["code_user"]."</td>"; 
                                  echo "<td style='font-weight: 1600;
                                  background-color: rgb(103, 103, 234); font-weight: 800 ; font-size: 20px; padding: 30px;' >".$row["nom"]."</td>";
                                  echo "<td style='font-weight: 1600;
                                  background-color: rgb(103, 103, 234); font-weight: 800 ; font-size: 20px; padding: 30px;'>".$row["prenom"]."</td>";
                                  echo "<td style='font-weight: 1600;
                                  background-color: rgb(103, 103, 234); font-weight: 800; font-size: 20px; padding: 30px;'>".$row["email"]."</td>";
                                  echo "<td style='font-weight: 1600;
                                  background-color: rgb(103, 103, 234); font-weight: 800; font-size: 20px; padding: 30px;'>".$row["fonction"]."</td>";
                                  echo "<td style='font-weight: 1600;
                                  background-color: rgb(103, 103, 234); font-weight: 800; font-size: 20px; padding: 30px;'>".$row["service"]."</td>";
                                  echo "<td style='font-weight: 1600;
                                  background-color: black; padding: 30px; padding-left:60px; margin-right:200px; '><a href='' class='btn btn-danger btn-sm' title='Supprimer un utilisateur'><i class='bi bi-trash'></i></a></a></td> ";
                                  echo "</tr>";
                                  
                              }
                          } else {
                              echo "<tr><td colspan='7'>Aucun utilisateur trouvé.</td></tr>";
                          }
                          $connexion->close();
                          ?>
                        </tbody>
            </table>
        </div>
    </div>
</div>
    </section>
    
</body>


</html>

<script>
    
    // Ajouter un gestionnaire d'événements au lien
    document.getElementById("myLink").addEventListener("click", function() {
        // Ajouter la classe active au clic
        this.classList.toggle("lii");
    });

</script>
<style>

</style>