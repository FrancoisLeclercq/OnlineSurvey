<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Online Survey - Login</title>
    <meta name="Description" content="Online Survey - Login">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- import CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/keyframes.css">
    <link rel="stylesheet" href="css/register-login.css">
    <script src="js/jquery.js" charset="utf-8"></script>
    <!-- include favicon -->
    <link rel="shortcut icon" href="images/icon/favicon.ico">
  </head>
  <body>
    <?php
      include_once "includes/register.php";
      include_once "includes/login.php";
      if(isset($_GET["message"])){
        echo "<script>";
        echo "const labelSubmit = document.getElementById('label-submit');";
        echo "labelSubmit.style.display = 'block';";
        switch ($_GET["message"]) {
          case 1:
            echo "labelSubmit.innerText = 'Incorrect username / password';";
            break;
          case 2:
            echo "labelSubmit.innerText = 'Incorrect username / password';";
            break;
          case 3:
            echo "labelSubmit.innerText = \"Can't recover user information from database!\";";
            break;
          default:
            break;
        }
        echo "</script>";
      }
     ?>
  </body>
</html>
