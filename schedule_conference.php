<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['conferenceTitle'];
  $date = $_POST['conferenceDate'];
  $time = $_POST['conferenceTime'];
  $participants = $_POST['conferenceParticipants'];
  $description = $_POST['conferenceDescription'];

  // Processus pour générer un lien Jitsi et envoyer les invitations
  // ...

  // Redirection après la soumission
  header('Location: conference.php?success=1');
}
?>
