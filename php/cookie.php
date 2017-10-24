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
      unset($_COOKIE[$name]);
    } else {
      return '';
    }
  }

  function retrieveC($name) {
    if(isset($_COOKIE[$name])) {
      return $_COOKIE[$name];
    } else {
      return '';
    }
  }
?>
