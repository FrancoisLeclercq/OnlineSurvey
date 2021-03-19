<?php
  // include connection and functions
  include_once "connection.php";
  include_once "functions.php";

  // then add the new current task to database
  if(isset($_POST["submit-survey"])) {

    $username = $mysqli->real_escape_string($_SESSION['log_username']);
    $currentList = $mysqli->real_escape_string($_SESSION['current_list']);
    $currentList = str_replace(' ','_',$currentList);

    $newQuery = "INSERT INTO answers (survey, username) VALUES ('$currentList', '$username');";
    
    $contents = '';
    $checkEmpty = '';

    $i = 1;
    if(isset($_POST["content".$i."title"]) && (strlen($_POST["content".$i]) == 0)) {
        $checkEmpty = 'yes';
    }
    while(isset($_POST["content".$i])) {
        
        ${"content".$i} = $mysqli->real_escape_string($_POST["content".$i]);
        ${"content".$i."title"} = $mysqli->real_escape_string($_POST["content".$i."title"]);

        $contents .= "\n\t{\n\t\t\"Question\": \"".${"content".$i."title"}."\",\n\t\t\"Answer\": \"".${"content".$i}."\"\n\t},";

        $newQuery .= "UPDATE answers SET answers='$contents' WHERE survey='$currentList' AND username='$username' AND done IS NULL;";

        $i += 1;
    }

    $j = 1;
    if(isset($_POST["radio".$j."title"])) {
        while(isset($_POST["radio".$j])) {
            ${"radio".$j} = $mysqli->real_escape_string($_POST["radio".$j]);
            ${"radio".$j."title"} = $mysqli->real_escape_string($_POST["radio".$j."title"]);

            $contents .= "\n\t{\n\t\t\"Question\": \"".${"radio".$j."title"}."\",\n\t\t\"Answer\": \"".${"radio".$j}."\"\n\t},";

            $newQuery .= "UPDATE answers SET answers='$contents' WHERE survey='$currentList' AND username='$username' AND done IS NULL;";

            $j += 1;
        }
        if($j == 1) {
            $checkEmpty = 'yes';
        }
    }
    $k = 1;
    while(isset($_POST["checkbox".$k."title"])) {
        ${"checkbox".$k."title"} = $mysqli->real_escape_string($_POST["checkbox".$k."title"]);
        $newQuery .= "UPDATE answers SET answers='".$contents."\n\t{\n\t\t\"Question\": \"".${"checkbox".$k."title"}."\",\n\t\t\"Answer\": \"";
        
        $l = 1;
        $contents2 = '';
        while(!isset($_POST["checkbox".$k."-".$l])) {
            $l += 1;
        }
        while(isset($_POST["checkbox".$k."-".$l])) {
            ${"checkbox".$k."-".$l} = $mysqli->real_escape_string($_POST["checkbox".$k."-".$l]);

                if(strlen($contents2) > 0) {
                    $contents2 .= ",".${"checkbox".$k."-".$l};
                } else { $contents2 = ${"checkbox".$k."-".$l}; }
            $l += 1;
            while(!isset($_POST["checkbox".$k."-".$l]) && $l < 100) {
                $l += 1;
            }
        }
        if(strlen($contents2) == 0) { $checkEmpty = 'yes'; }
        $newQuery .= $contents2."\"\n\t},' WHERE survey='$currentList' AND username='$username' AND done IS NULL;";
        $k += 1;
    }
    $newQuery = substr_replace($newQuery,"\n' WHERE survey='$currentList' AND username='$username' AND done IS NULL", strrpos($newQuery, ','), -1);
    $newQuery .= "UPDATE answers SET done='completed' WHERE survey='$currentList' AND username='$username';";
    if(strlen($checkEmpty) == 0) {
        if($result = $mysqli->multi_query($newQuery)){
            // SUCCESS
            echo "<script>alert('Survey answers successfully submitted!');location.href='../public/view.php#sharedSurveys';</script>";
        } else {
            echo "<script>alert('Error');location.href='../public/answer.php?survey=".str_replace(' ','_',$_SESSION['current_list'])."</script>";
        }
    } else {
        echo "<script>alert('You must answer all the questions');location.href='../public/answer.php?survey=".str_replace(' ','_',$_SESSION['current_list'])."'</script>";
    }
  }

  // finaly get All card
  if(isset($_SESSION["current_list"])){
    getAllFields($_SESSION["current_list"], $status="current", $mysqli);
  }
?>