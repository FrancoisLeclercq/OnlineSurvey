<?php
    include_once "connection.php";
    include_once "functions.php";
    $survey = str_replace(' ','_',$_SESSION["current_list"]);
    if(isset($_POST['submit']) && $_POST['submit'] === 'Remove'){
      // get user information
      $user = $mysqli->real_escape_string($_POST['user']);
      $right = $mysqli->real_escape_string($_POST['right']);
      $list = $mysqli->real_escape_string($_POST['list']);
      $email = getEmailByName($user, $mysqli);
      // get user rights
      $rightArray = getRightOfUser($email, $right, $mysqli);
      // unset list from rights
      if (($key = array_search($list, $rightArray)) !== false) {
        unset($rightArray[$key]);
      }
      // then reset rights of user
      if(!setRightOfUser($email, $right, $rightArray, $mysqli)){
        header('Location: ../public/onlinesurvey.php?error_friend=1');
      } else {
        if($email === $_SESSION['log_email']){
          header('Location: ../public/view.php');
        } else {
          $removeAnswer = "DELETE FROM answers WHERE survey='$survey' AND username='$user'";
          if($result = $mysqli->query($removeAnswer)){
            header('Location: ../public/onlinesurvey.php?survey='.$survey);
          }
        }
      }
    } else {
      header('Location: ../public/onlinesurvey.php?error_friend=2');
    }
 ?>
