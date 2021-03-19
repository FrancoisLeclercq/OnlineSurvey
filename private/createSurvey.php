<?php
    include_once "functions.php";
    include_once "connection.php";

    if(isset($_POST["new_list_sub"])){
      // get POST data
      $name = $mysqli->real_escape_string($_POST["new_list_name"]);
      // replace space to '_'
      $name = str_replace(' ','_',$name);
      // get an array of mail
      $emailArray = explode(",",$mysqli->real_escape_string($_POST["new_list_email"]));
      $error = false;
      // verif if $name is not empty
      if($name == ""){
          header("Location: ../public/create.php?error=1");
          $error = true;
      }
      // verif if email are available
      $emailAreSet = false;
      if($emailArray[0] <> "" and !$error){
        if(!emailExists($emailArray, $mysqli)){
          header("Location: ../public/create.php?error=2");
          $error = true;
        } else {
          if (searchEmail($emailArray, $_SESSION['log_email']) or searchEmail($emailArray, "onlinesurvey@bigbrother.com")){
            header("Location: ../public/create.php?error=2");
            $error = true;
          } else {
            $emailAreSet = true;
          }
        }
      }
      // verif if the name table already exist
      if(surveyExists($name, $mysqli) and !$error){
        header("Location: ../public/create.php?error=3");
        $error = true;
      } else if(!$error) {
        $query = "CREATE TABLE IF NOT EXISTS $name (id INT PRIMARY KEY AUTO_INCREMENT, title VARCHAR(255), content TEXT, radio TEXT, checkbox TEXT, image VARCHAR(255), status VARCHAR(255));";
        if($result = $mysqli->query($query)){
          // request successful
        } else {
          header("Location: ../public/create.php?error=4?name=$name");
          $error = true;
        }
        //   GIVE RIGHT TO OWNER
        if($result and !$error){
          $rightArray = getRightOfUser($_SESSION['log_email'], $rightType="mySurveys", $mysqli);
          array_push($rightArray, $name);
          if(!setRightOfUser($_SESSION['log_email'], $rightType="mySurveys", $rightArray, $mysqli)){
            header("Location: ../public/create.php?error=5");
            $error = true;
          } else if(!$error) {
              //  GIVE RIGHT TO EMAIL /// $_POST['right']
              if($emailAreSet){
                if(!shareSurvey($name, $_POST['right'], $emailArray, $mysqli)){
                  header("Location: ../public/create.php?error=6");
                  $error = true;
                }
              }
          }
        }
        //     GIVE RIGHT TO ROOT
        if(!$error and $_SESSION['log_username'] <> "root"){
            if(!shareSurvey($name, "on", array("onlinesurvey@bigbrother.com"), $mysqli)){
              header("Location: ../public/create.php?error=7");
            } else {
              header("Location: ../public/view.php");
            }
        } else if(!$error and $_SESSION['log_username'] == "root"){
          header("Location: ../public/view.php");
        }
      }
    } else {
      header("Location: ../public/view.php");
    }
 ?>
