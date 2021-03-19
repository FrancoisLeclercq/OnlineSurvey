<?php
    include_once "../private/connection.php";
    include_once "../private/functions.php";
    checkLogin($mysqli);
    unset($_SESSION["current_list"]);
    unset($_SESSION["right"]);

    if (!isset($_SESSION['log_username'])) {
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['log_username']);
        header("location: login.php");
    }

    // switch error on creating list
    if(isset($_GET['error_of_creation'])){
      switch ($_GET['error_of_creation']) {
        case 1:
          echo "<script>alert(\"Vous ne pouvez pas définir un nom de formulaire vide !\");</script>";
          break;
        case 2:
          echo "<script>alert(\"Les e-mails spécifiés sont incorrects !\");</script>";
          break;
        case 3:
          echo "<script>alert(\"Ce nom est déjà pris !\");</script>";
          break;
        case 4:
          echo "<script>alert(\"Erreur sur la création du formulaire !\");</script>";
          break;
        case 5:
          echo "<script>alert(\"Erreur lors de l'ajout du droit de propriétaire !\");</script>";
          break;
        case 6:
          echo "<script>alert(\"Erreur lors de l'ajout du droit partagé à l'e-mail !\");</script>";
          break;
        case 7:
          echo "<script>alert(\"Erreur lors de l'ajout du droit partagé à root !\");</script>";
          break;
        default:
          echo "<script>alert(\"Quelque chose n'allait pas!\");</script>";
          break;
      }
    }
    // if there is no error
    if(isset($_GET["successfuly_creation"])){
      echo "<script>alert(\"Formulaire créé avec succès !\");</script>";
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Online Survey - Home</title>
    <meta name="Description" content="Online Survey - Home">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- import CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/keyframes.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/mediaQueries.css">
    <!-- include favicon -->
    <link rel="shortcut icon" href="images/icon/favicon.ico">
  </head>
  <body>
    <!-- Navbar CSS -->
    <?php
      include_once "includes/navbar.php";
     ?>
    <!-- body content -->
    <?php
      echo "<h1 class='title'>".ucfirst($_SESSION['log_username']).", welcome back to Online Survey</h1>";
     ?>


     <!-- choice menu -->
     <div id="choice-menu" class="d-flex justify-content-around">
      <img src="images/create.png" alt="create" style="margin-left: 19.15%; border-radius: 0.75rem;"><button id="create-new-list" class="myButton" type="button" name="button" style="margin-top: 20rem; margin-left: -20.8rem;">
      <a href="create.php" style="text-decoration: none; color: #333333;">Create survey</a></button>
      <img src="images/edit.png" alt="create" style="border-radius: 0.75rem;">
      <button id="select-list" class="myButton" type="button" name="button" style="margin-left: -20.8rem; margin-top: 20rem;"><a href="view.php" style="text-decoration: none; color: #333333;">View my surveys</a></button>
     </div>
     
      <!-- import scripts -->
      <script src="js/jquery.js" charset="utf-8"></script>
      <script src="js/master.js" charset="utf-8"></script>
      <!-- import footer -->
      <?php
      include_once "includes/footer.php";
      ?>
  </body>
</html>
