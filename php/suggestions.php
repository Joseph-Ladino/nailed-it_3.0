<?php
  include('connect.php');
  include('cookie.php');
  if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['delete'])) {
      $delete_id = $_GET['delete'];
      $q = mysqli_query($dbc, "SELECT * FROM users WHERE username='DRTNT25'");
      while($row = mysqli_fetch_array($q)) {
        if(!empty(retrieveC('user')) && retrieveC('user') == $row[0]) {
          $q = mysqli_query($dbc, "SELECT `sug-id` FROM suggestions WHERE `sug-id`='".$delete_id."'");
          if(mysqli_num_rows($q) != 0) {
            mysqli_query($dbc, "DELETE FROM suggestions WHERE `sug-id`='".$delete_id."'");
          }
        }
        header('Location: ./suggestions.php');
      }
    }
  }
?>
<!DOCTYPE html>
<html>
  <?php $title = "Your Suggestions"; include('header.php'); ?>
  <body>
    <h1 class="main-header center">Viewer Suggestions</h1>
    <br />
    <table id="sug-table" border="1" width="auto" align="center">
      <thead>
        <tr style="color: white; font-size: 1.3rem;" align="center">
          <td>Name:</td>
          <td>Suggestion:</td>
          <td>Date:</td>
          <?php
            $q = mysqli_query($dbc, "SELECT id FROM users WHERE email='drtnt25@gmail.com'");
            while($row = mysqli_fetch_array($q)) {
              if(!empty(retrieveC('user')) && retrieveC('user') == $row[0]) {
                echo "<td>Delete Suggestion:<td>";
              }
            }
          ?>
        </tr>
        <tbody>
          <?php
            error_reporting(0);
            $q = mysqli_query($dbc, "SELECT * FROM suggestions ORDER BY 'sug-id' ASC");
            if(mysqli_num_rows($q) != 0) {
              error_reporting(1);
              while($row = mysqli_fetch_array($q)) {
                echo "<tr id='".$row['sug-id']."'>
                <td>".$row['person']."</td>
                <td>".$row['suggestion']."</td>
                <td>".$row['time']."</td>";
                $q = mysqli_query($dbc, "SELECT id FROM users WHERE email='drtnt25@gmail.com'");
                while($id = mysqli_fetch_array($q)) {
                  $id = $id['id'];
                  if(!empty(retrieveC('user')) && retrieveC('user') == $id) {
                    echo "<td><a href='suggestions.php?delete=".$row['sug-id']."'>Delete Suggestion</a><td>
                    </tr>";
                  }
                }
              }
            } else {
              echo "<tr><td>No</td><td>Items to</td><td>Display</td></tr>";
            }
          ?>
        </tbody>
      </thead>
    </table>
  </body>
</html>
