<?php
  include('./cookie.php');
  if(!empty(retrieveC('user'))) {
    header('Location: ./account.php');
  }
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    include('connect.php');
    $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $p = mysqli_real_escape_string($dbc, trim($_POST['password']));
    $q = mysqli_query($dbc, "SELECT * FROM users WHERE email='".$e."'");
    $account_row = mysqli_num_rows($q);
    if($account_row != 0) {
      while($row = mysqli_fetch_array($q)) {
        $user_email = $row['email'];
        $user_password = $row['password'];
        $username = $row['username'];
        $user_id = $row['id'];
      }
      if($p == $user_password) {
        createC('user', $user_id, time() + 60 * 60 * 24 * 365);
        header("Location: ../");
      } else {
        echo "<script type='text/javascript'>alert('Error: Incorrect Password!')</script>";
      }
    } else {
      echo "<script type='text/javascript'>alert('Error: Incorrect Email!')</script>";
    }
  }
?>

<!DOCTYPE html>
<html>
  <?php $title = "Login to your Account."; include('./header.php'); ?>
  <body>
    <center>
      <form name="Login" method="post" action="./login.php">
        <label for="email">Please enter your email address:</label>
        <input type="email" name="email" maxlength="50" /><br />
        <label for="password">Please enter your password:</label>
        <input type="password" name="password" maxlength="25" />
        <input type="submit" name="submit" value="Submit" name="submit" />
      </form>
    </center>
  </body>
</html>
