<?php
    include_once "../private/connection.php";
    include_once "../private/functions.php";
    checkLogin($mysqli);
    unset($_SESSION["current_list"]);
    unset($_SESSION["right"]);

    // switch error on creating list
    if(isset($_GET['error_of_creation'])){
      switch ($_GET['error_of_creation']) {
        case 1:
          echo "<script>alert(\"Enter a name for your survey\");</script>";
          break;
        case 2:
          echo "<script>alert(\"This survey name already exists\");</script>";
          break;
        case 3:
          echo "<script>alert(\"Error creating survey\");</script>";
          break;
        default:
          echo "<script>alert(\"Default error\");</script>";
          break;
      }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create your survey</title>
    <meta name="Description" content="Create your survey">
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
    <style>
      input[type="text"]::placeholder {
        text-align: left;
        padding-left: 34%;
      } 
    </style>
    <!-- Navbar CSS -->
    <?php
      include_once "includes/navbar.php";
     ?>
    <!-- body content -->
    <?php
      echo "<h1 class='title'>Create your survey</h1>";
    ?>

    <!-- choice menu -->
    <div id="choice-menu" class="d-flex justify-content-around">
    </div>

    <!-- create List div -->
    <div id="create-todo-view">
      <form class="formulaire add-new-list" action="../private/createSurvey.php" method="post"><br/>
        <input class="add-new-list-input" type="text" name="new_list_name" value="" placeholder="Survey Name" maxlength="50" autocomplete="off" style="margin-top: 0rem;">
        <p style="color: lightgrey; font-size:1.1rem; margin-top: -0.2rem;">Beware: you cannot change the survey name once it is created</p>
        <p style="color: lightgrey; font-size:1.1rem; margin-top: -0.6rem;">You cannot use special characters for the name at the moment</p>
        <br/><br/>
        <input class="saveButton" type="submit" name="new_list_sub" value="Next">
        </div>
      </form>
    </div>
    <!-- import scripts -->
    <script src="js/jquery.js" charset="utf-8"></script>
    <script src="js/master.js" charset="utf-8"></script>
    <br/>
    <br/>
    <br/>
    <br/>
    <!-- import footer -->
    <?php
      include_once "includes/footer.php";
    ?>
  </body>
</html>
