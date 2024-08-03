<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['meetingTitle'];
  $date = $_POST['meetingDate'];
  $time = $_POST['meetingTime'];
  $participants = $_POST['meetingParticipants'];
  $description = $_POST['meetingDescription'];

  // Processus pour sauvegarder la réunion dans la base de données
  // ...

  // Redirection après la soumission
  header('Location: conference.php?success=1');
}
?>
