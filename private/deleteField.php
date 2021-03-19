<?php
  // include connection and functions
  include_once "connection.php";
  include_once "functions.php";
  // then change the status of the task
  if(isset($_POST['id'])){
    if($_SESSION["right"] <> "noShare"){
      $currentList = $mysqli->real_escape_string($_SESSION["current_list"]);
      // replace space to '_'
      $currentList = str_replace(' ','_',$currentList);
      $id = $mysqli->real_escape_string($_POST["id"]);
      $query = "DELETE FROM $currentList WHERE id=$id;";
      if($result = $mysqli->query($query)){
        // TODO : DELETE IMAGE ON PC
        // unlink("../public/".$file);
      } else {
        echo "<script>alert(\"Error on deleting field\")</script>";
      }
    } else {
      echo "<script>alert(\"No permission to delete field\")</script>";
    }
  }
 ?>
