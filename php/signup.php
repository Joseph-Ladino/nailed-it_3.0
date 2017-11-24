<?php
include('./cookie.php');
  if(!empty(retrieveC('user'))) {
    header('Location: ./account.php');
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('connect.php')
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
    $gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
    $remember = mysqli_real_escape_string($dbc, trim($_POST['remember']));
    $q = mysqli_query($dbc, "SELECT * FROM users WHERE email='".$email."'");
    if(mysqli_num_rows($q) <= 0) {
      $q = mysqli_query($dbc, "SELECT * FROM users WHERE username='".$username."'");
      if(mysqli_num_rows($q) <= 0) {
        function randId($dbc) {
          error_reporting(0);
          for($i = 0; $i < 10; $i++) {
            $id .= mt_rand(0,9);
          }
          error_reporting(-1);
          $q = mysqli_query($dbc, "SELECT * FROM users WHERE id='".$id."'");
          if(mysqli_num_rows($q) >= 1) {
            $id = randId();
          } else {
            return $id;
          }
        }
        $id = randId($dbc);
        mysqli_query($dbc, "INSERT INTO users(id, username, email, password, gender) VALUES('$id', '$username', '$email', '$password', '$gender')");
        deleteC('user');
        if($remember == 1) {
          createC('user', $id, time() + 60*60*24*365);
        } else {
          createC('user', $id);
        }
        header('Location: ../');
      } else {
        echo "<script type='text/javascript'>alert('That username is already registered.')</script>";
      }
    } else {
      echo "<script type='text/javascript'>alert('That email is already registered.')</script>";
    }
  }
?>

<!DOCTYPE html>
<html>
  <?php $title = "Sign Up"; include('./header.php'); ?>
  <body>
    <center>
      <form name="signup" action="./signup.php" method="post">
        <label for="username">Enter username:</label>
        <input name="username" maxlength="25" type="text" /><br />
        <label for="email">Enter email:</label>
        <input name="email" maxlength="50" type="email" /><br />
        <label for="gender">Please select your gender:</label>
        <input name="gender" value="Male" type="radio" checked />
        <input name="gender" value="Female" type="radio" /><br />
        <label for="password">Enter password:</label>
        <input name="password" maxlength="25" type="password" />
        <label for="remember"> Remember password?</label>
        <input name="remember" value="1" type="checkbox" />
        <input name="submit" value="Submit" type="submit" />
      </form>
    </center>
  </body>
</html>
