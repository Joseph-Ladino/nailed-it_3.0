<?php
  if(strpos($_SERVER['REQUEST_URI'], 'nailed-it_3.0')) {
    $dbname = "nailed-it";
    $dbhostname = "localhost";
    $dbusername = "root";
    $dbpassword = '';
  } else {
    $url = getenv('CLEARDB_DATABASE_URL');
    $dbparts = parse_url($url);
    $dbname = ltrim($dbparts['path'],'/');
  }
  $dbhostname = $dbparts['host'];
  $dbusername = $dbparts['user'];
  $dbpassword = $dbparts['pass'];
  
  $dbc = mysqli_connect($dbhostname, $dbusername, $dbpassword, $dbname) or die('could not connect to database');
  mysqli_set_charset($dbc, 'utf8');
 ?>
