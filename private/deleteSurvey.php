<?php
    // include connection and functions
    include_once "connection.php";
    include_once "functions.php";

    if(isset($_POST["delete"])){
        $currentList = $mysqli->real_escape_string($_SESSION['current_list']);
        // replace space to '_'
        $currentList = str_replace(' ','_',$currentList);
        $query = "DROP TABLE $currentList";
        if($result = $mysqli->query($query)){
            removeSharedSurveysUser($currentList, $mysqli);
            echo "<script>alert(\"List has been deleted\")</script>";
            echo "<script>location.replace('../public/view.php');</script>";
        } else {
            echo "<script>alert(\"Error: could not delete list\")</script>";
        }
    }
?>
