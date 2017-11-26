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
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['suggestor']) && isset($_POST['suggestions'])) {
      include('./php/connect.php');
      $suggestor = mysqli_real_escape_string($dbc, trim($_POST['suggestor']));
      $suggests = mysqli_real_escape_string($dbc, trim($_POST['suggestions']));
      $time = date("F jS Y");
      if(mysqli_num_rows(mysqli_query($dbc, "SHOW TABLES LIKE 'suggestions'")) != 1) {
        mysqli_query($dbc, "CREATE TABLE `suggestions` (`sug-id` INT(11) NOT NULL AUTO_INCREMENT, `person` VARCHAR(50) NOT NULL, `suggestion` LONGTEXT NOT NULL, `time` VARCHAR(25) NOT NULL, PRIMARY KEY(`sug-id`))");
      }
      mysqli_query($dbc, "INSERT INTO suggestions(person, suggestion, time) VALUES('$suggestor', '$suggests', '$time')");
      mysqli_close($dbc);
    }
  } elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['error'])) {
      $error = $_GET['error'];
      if ($error == 'restricted-access') {
        $error_msg = "This part of the site isn\'t available to you.";
      }
      echo "<script type='text/javascript'>alert('".$error_msg."');</script>";
    }
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
    var links = ['./', './php/<?php echo $link; ?>', 'https://github.com/Joseph-Ladino/nailed-it_3.0/commit/master'];
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
    <h1 class="main-header center">
      <?php echo $head1; ?> <span style="color: red;">Nailed</span><span style="color: lime;" style="display: inline;">-</span><span style="color: white;" style="display: inline;">It</span><?php if($head2 !== "") { echo ', ';} ?><span style="color: Lime;" style="display: inline;"><?php echo $head2; ?></span>!
    </h1>
    <h3 class="main-subheader center">Don't forget to look around for easter eggs!</h3>
    <br />
    <h3 class="center">Feel free to leave a suggestion!!!</h2><br />
    <form name="suggestion-box;" method="post" action="./index.php" class="center">
      <input type="text" name="suggestor" placeholder="Enter Name..." /><br /><br />
      <textarea name="suggestions" rows="10" cols="30" placeholder="Enter suggestions here..."></textarea><br />
      <input type="submit" name="Submit" value="Submit suggestion." />
    </form>
  </body>
</html>
