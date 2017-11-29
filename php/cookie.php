<?php
  function createC($name, $value, $time = 0, $path = "/") {
      if (isset($name) || isset($value)) {
      setcookie($name, $value, $time, $path);
    } else {
      return '';
    }
  }

  function deleteC($name) {
    if(isset($_COOKIE[$name])) {
      setcookie($name, 0, time() - 1, "/");
      unset($_COOKIE[$name]);
      unset($_COOKIE[$name]);
    } else {
      return '';
    }
  }

  function retrieveC($name) {
    if(isset($_COOKIE[$name])) {
      include("connect.php");
      return mysqli_real_escape_string($dbc, trim($_COOKIE[$name]));
      mysqli_close($dbc);
    } else {
      return '';
    }
  }
?>
