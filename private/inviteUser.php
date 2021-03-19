<?php
    // include connection and functions
    include_once "connection.php";
    include_once "functions.php";

    // then add user right
    if(isset($_POST['emails']) and isset($_POST['rights'])){
      if($_SESSION["right"] <> "noShare"){
        $emailArray = explode(",",$mysqli->real_escape_string($_POST["emails"]));
        $currentList = $mysqli->real_escape_string($_SESSION['current_list']);
        // replace space to '_'
        $currentList = str_replace(' ','_',$currentList);
        if(!emailExists($emailArray, $mysqli)){
          echo "<script>alert(\"Incorrect email address\")</script>";
        } else {
          if(!searchEmail($emailArray, $_SESSION['log_email']) and !searchEmail($emailArray, 'onlinesurvey@bigbrother.com')){
            if($_POST['rights'] == "true"){
              $_POST['rights'] = "on";
            } else {
              $_POST['rights'] = "off";
            }
            if(!shareSurvey($currentList, $_POST['rights'], $emailArray, $mysqli)){
              echo "<script>alert(\"Provided user is already part of the members for this survey\")</script>";
            }
          } else {
            echo "<script>alert(\"Incorrect email address\")</script>";
          }
        }
      } else {
        echo "<script>alert(\"No right permission\")</script>";
      }
    }

    // refresh participants list
    if(isset($_SESSION['log_email']) && isset($_SESSION['right'])){
      echo "<h1 class='title-ters'>Participants:</h1>";
      getMembers($_SESSION['log_email'], $_SESSION['right'], str_replace(' ','_',$_SESSION['current_list']), $mysqli);
      echo "<script>gotFriend = haveFriend();</script>";
    }
 ?>
