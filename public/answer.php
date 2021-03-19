<?php
    include_once "../private/connection.php";
    include_once "../private/functions.php";
    checkLogin($mysqli);

    if(isset($_SESSION["log_username"]) and isset($_SESSION["log_password"]) and (isset($_POST["sub_list"]) or isset($_SESSION["current_list"]))){
      if(!isset($_SESSION["current_list"])){
        $_SESSION["current_list"] = $_POST["list_name"];
      }
      if(isset($_POST["sub_list"]) or isset($_SESSION["right"])){
        if(!isset($_SESSION["right"])){
          $_SESSION["right"] = $_POST["right"];
        }
      } else {
        header("Location: ../public/view.php");
      }
    } else {
      header("Location: ../public/view.php");
    }
    // AJAX requets add card
    if(isset($_POST['title']) and isset($_POST['content']) and isset($_POST['image'])){
      echo "<script>alert(\"Script done\")</script>";
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo "Answering: ".$_SESSION["current_list"];?></title>
    <meta name="Description" content="My Online Survey">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- import CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/keyframes.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/mediaQueries.css">
    <!-- import scripts -->
    <script src="js/jquery.js" charset="utf-8"></script>
    <script src="js/master.js" charset="utf-8"></script>
    <!-- include favicon -->
    <link rel="shortcut icon" href="images/icon/favicon.ico">
  </head>
  <body>
    <!-- Navbar -->
    <?php
      include_once "includes/navbar.php";
    ?>
    <!-- title -->
    <h1 id="current-list-name" class="title" style="z-index: 0; padding-left: 5rem; padding-right: 5rem;"><?php echo $_SESSION["current_list"]; ?></h1>
    <div class="d-flex justify-content-around todo-content">
      <div class="current-card d-flex flex-column background-survey" style="margin-top: -1rem;">
        <form method="post" id="answer-form" action="../private/submitAnswer.php">
          <?php
            getAllFieldsShared($_SESSION["current_list"], $status="current", $mysqli);
          ?>
          <input type="submit" name="submit-survey" class="myButton2" id="submit-survey" style="margin-top: 3rem; width: 14rem;" value="Submit survey">
        </form>
      </div>
    </div>
    <!-- import footer -->
    <?php
      include_once "includes/footer.php";
     ?>
  </body>
</html>