<?php
    include_once "../private/connection.php";
    include_once "../private/functions.php";
    checkLogin($mysqli);
    unset($_SESSION["current_list"]);
    unset($_SESSION["right"]);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo ucfirst($_SESSION["log_username"]); ?> - My surveys</title>
    <meta name="Description" content="My Surveys">
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
      echo "<a name='mySurveys'><h1 class='title' style='margin-bottom: 6rem;'>My created surveys</h1></a>";
     ?>

     <!-- my surveys -->
     <div>
       <div class="d-flex flex-column bd-highlight lists my-list-todo">
         <?php
           if(isset($_SESSION["log_username"]) and isset($_SESSION["log_password"]) and (isset($_POST["sub_list"]) or isset($_SESSION["current_list"]))){
              if(!isset($_SESSION["current_list"])){
                $_SESSION["current_list"] = $_POST["list_name"];
              }
            }
            listAllSurveys($list="mySurveys", $mysqli);
          ?>
       </div>
     </div>

    <?php
      echo "<a name='sharedSurveys'><h1 class='title' style='margin-top: 2rem; margin-bottom: 6rem;'>Shared surveys</h1></a>";
     ?>

     <!-- shared surveys -->
     <div>
       <div class="d-flex flex-column bd-highlight lists my-list-todo">
         <?php
           if(isset($_SESSION["log_username"]) and isset($_SESSION["log_password"]) and (isset($_POST["sub_list"]) or isset($_SESSION["current_list"]))){
              if(!isset($_SESSION["current_list"])){
                $_SESSION["current_list"] = $_POST["list_name"];
              }
            }
            listAllSurveysShared($list="sharedSurveys", $mysqli);
          ?>
       </div>
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