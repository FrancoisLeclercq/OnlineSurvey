<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Deleting Account Service</title>
    <meta name="Description" content="Online Survey">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style media="screen">
      * {
        background-color: black;
        color : yellow;
      }
    </style>
  </head>
  <body onload="document.getElementById('callback').click();">
    <h1>Wait...</h1>
    <?php

      include_once "connection.php";
      include_once "functions.php";

      if(isset($_GET['delete_acc']) and isset($_SESSION['log_id'])) {
        // delete all right on user list
        $query = "SELECT * FROM users WHERE id=".$_SESSION['log_id'].";";
        $request = $mysqli->query($query);
        // first step recup user list
        while ($row = $request->fetch_assoc()) {
          $mySurveys = explode(",",$row['mySurveys']);
        }
        // second step delete table and delete rights
        foreach ($mySurveys as &$list) {
          $query = "DROP TABLE $list";
          if($result = $mysqli->query($query)){
            removeSharedSurveysUser($list, $mysqli);
          }
        }
        // finaly delete account
        $query = "DELETE FROM users WHERE id=".$_SESSION['log_id'].";";
        if($mysqli->query($query)){
          echo "<a id='callback' href='../public/logout.php'></a>";
        } else {
          echo "<a id='callback' href='../public/account.php?delete_error=1'></a>";
        }
      } else {
        echo "<a id='callback' href='../public/account.php?delete_error=1'></a>";
      }
     ?>

  </body>
</html>
