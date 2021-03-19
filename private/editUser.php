<?php
  include_once "connection.php";
  include_once "functions.php";
  if(isset($_POST["change_submit"])){
    $id = $mysqli->real_escape_string($_SESSION["log_id"]);
    $username = $mysqli->real_escape_string($_POST["change_username"]);
    $firstname = $mysqli->real_escape_string($_POST["change_firstname"]);
    $lastname = $mysqli->real_escape_string($_POST["change_lastname"]);
    $email = $mysqli->real_escape_string($_POST["change_email"]);
    $password = $mysqli->real_escape_string($_POST["change_password"]);
    $checkQuery = "SELECT * FROM users WHERE username='$username' AND id<>".$_SESSION['log_id']." ;";
    if(checkIfEmptySet($checkQuery, $mysqli)){
      $query = "UPDATE users SET username='$username', email='$email', password=AES_ENCRYPT('$password','$password'), firstname='$firstname', lastname='$lastname' WHERE id=$id;";
      if($result = $mysqli->query($query)){
        echo "<script>alert(\"Successfully updated personal info\");</script>";
      } else {
        echo "<script>alert(\"Failed to update personal info\");</script>";
      }
    } else {
      header('Location: ../public/account.php?error=true');
    }
  }
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <meta name="Description" content="Online Survey">
     <meta name="viewport" content="width=device-width, initial-scale=1">
   </head>
   <body onload="document.getElementById('callback').click();">
     <a id="callback" href="../public/logout.php"></a>
   </body>
 </html>
