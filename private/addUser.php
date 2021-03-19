<?php
  include_once "connection.php";
  include_once "functions.php";

  if(isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $mysqli->real_escape_string($_POST["username"]);
    $firstname = $mysqli->real_escape_string($_POST["firstname"]);
    $lastname = $mysqli->real_escape_string($_POST["lastname"]);
    $email = $mysqli->real_escape_string($_POST["email"]);
    $password = $mysqli->real_escape_string($_POST["password"]);
    $checkQuery = "SELECT * FROM users WHERE username='$username' OR email='$email';";
    if(checkIfEmptySet($checkQuery, $mysqli)){
      $query = "INSERT INTO users (username, email, password, mySurveys, noShare, sharedSurveys, firstname, lastname)
                VALUES ('$username','$email',AES_ENCRYPT('$password','$password'),'','','','$firstname','$lastname');";
      if($result = $mysqli->query($query)){
        echo "<script>alert(\"Successfully created user\");</script>";
      } else {
        echo "<script>alert(\"Failed to create user\");</script>";
      }
    } else {
      echo "<script>alert(\"Please pick a different username\");</script>";
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
