<?php
  $dbname = "nailed-it";
  $dbhostname = "localhost";
  $dbusername = "root";
  $dbpassword = '';
  $dbc = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname) or die('could not connect to database');
  mysqli_set_charset($dbc, 'utf8');
 ?>
