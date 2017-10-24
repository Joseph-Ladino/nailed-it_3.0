<?php
  $head1 = '';
  $head2 = '';
  $txt = '';
  $link = '';
  $logout;
  include('./php/cookie.php');
  if(!empty(retrieveC('user'))) {
    $user = retrieveC('user');
    include('./php/connect.php');
    $query = mysqli_query($dbc, "SELECT username FROM users WHERE id='".$user."'");
    if (!empty($query)) {
      while($row = mysqli_fetch_array($query)) {
        $name = $row['username'];
      }
      $head1 = "Welcome back to";
      $head2 = $name;
      $txt = "Manage Account";
      $link = "account.php";
      $logout = 1;
    }
  } else {
    $head1 = "Welcome to";
    $head2 = "";
    $txt = "Login";
    $link = "login.php";
    $logout = False;
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>New and Improved Nailed-It!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./css/style.css" type="text/css" rel="stylesheet" />
    <link href="./images/favicon.ico" type="image/x-icon" rel="icon" />
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
    var links = ['./', './php/<?php echo $link; ?>', './php/changelog.php'];
    </script>
    <script type="text/javascript" src="./js/main.js" id="nav-closed"></script>
  </head>
  <body>
    <script type="text/javascript">
    <?php if($logout == 1) {
      echo "$('#nav-log').click(function() {
        window.open('./php/account.php?logout=1', '_self');
      });";
    } ?>
    </script>
    <div id="nav-bar">
      <ul>
        <li id="nav-home">Home</li>
        <li id="nav-manage"><?php echo $txt; ?></li>
        <li id="nav-changes">Changelog</li>
        <?php if($logout == 1) {
          echo "<li id='nav-logout'>Logout</li>";
        } ?>
      </ul>
    </div>
    <img src="./images/arrow.png" id="nav-closed" class="nav-btn" />
    <br />
    <h1 id="main-header" class="center">
      <?php echo $head1; ?> <span style="color: red;">Nailed</span><span style="color: lime;" style="display: inline;">-</span><span style="color: white;" style="display: inline;">It</span><?php if($head2 !== "") { echo ', ';} ?><span style="color: Lime;" style="display: inline;"><?php echo $head2; ?></span>!
    </h1>
    <h3 id="main-subheader" class="center">Don't forget to look around for easter eggs!</h3>
  </body>
</html>
