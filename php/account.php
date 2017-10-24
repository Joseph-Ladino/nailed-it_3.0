<?php
  $title = "Manage Your Account";
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $logout = $_GET['logout'];
    if($logout == 1) {
      $title = "Logout";
      include('./cookie.php');
      deleteC('user');
      header('Location: ../');
    }
  }
?>

<!DOCTYPE html>
<html>
  <?php include('./header.php'); echo $head; ?>
  <body>

  </body>
</html>
