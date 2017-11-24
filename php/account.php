<?php
  $title = "Manage Your Account";
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['logout'])) {
      $logout = mysql_real_escape_string(trim($_GET['logout']));
      if($logout == 1) {
        $title = "Logout";
        include('./cookie.php');
        deleteC('user');
        header('Location: ../');
      }
    } elseif(isset($_POST['oldEmail'])) {
      if(isset($_POST['oldEmail']) && isset($_POST['newEmail']) && isset($_POST['changeEmail'])) {
        include('connect.php');
        $oldEmail = mysql_real_escape_string($dbc, trim($_POST['oldEmail']));
        $newEmail = mysql_real_escape_string($dbc, trim($_POST['newEmail']));
        $confirmEmail = mysql_real_escape_string($dbc, trim($_POST['confirmEmail']));
        mysqli_close($dbc);
        echo $oldEmail.' '.$newEmail.' '.$confirmEmail;
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <?php $title = "Manage your Account" include('./header.php'); ?>
  <body>
    <label for="changeEmail">Change email address</label><br />
    <form name="changeEmail" method="post" action="./account.php">
      <label for="oldEmail">Enter Old Email:</label>
      <input type="email" name="oldEmail" maxlength="50" /><br />
      <label for="newEmail">Enter New Email:</label>
      <input type="email" name="newEmail" maxlength="50" /><br />
      <label for="confirmEmail">Confirm New Email:</label>
      <input type="email" name="confirmEmail" maxlength="50" />
      <input type="submit" name="submit" value="Submit" />
    </form>
  </body>
</html>
