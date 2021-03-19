<?php
  // include connection and functions
  include_once "connection.php";
  include_once "functions.php";

  // then add the new current task to database
  if(isset($_POST["add-field"]) && $_POST["title"] != "") {

    $currentList = $mysqli->real_escape_string($_SESSION['current_list']);
    $currentList = str_replace(' ','_',$currentList);

    if(isset($_POST['title'])) {
        $title = $mysqli->real_escape_string($_POST['title']);
    }
    if(isset($_POST['content'])) {
        $content = $mysqli->real_escape_string($_POST['content']);
    }

    $i = 1;
    while(isset($_POST["radio".$i])) {
        ${"radio".$i} = $mysqli->real_escape_string($_POST["radio".$i]);
        $i += 1;
    }

    $j = 1;
    while(isset($_POST["checkbox".$j])) {
        ${"checkbox".$j} = $mysqli->real_escape_string($_POST["checkbox".$j]);
        $j += 1;
    }

    if(strlen($_FILES['image']['name']) > 0) {
     
        $image = basename($_FILES['image']['name']);
        $dir = "images/shared/";
        $file = $dir.$image;
        $uploadOk = 2;
        $imageFileType = strtolower(pathinfo($file,PATHINFO_EXTENSION));

        if (file_exists("../public/".$file)) {
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jfif" && $imageFileType != "pjp" && $imageFileType != "pjpeg") {
            echo "<script>alert(\"Only JPG, PNG & JFIF files are allowed\")</script>";
            $uploadOk = 1;
        }

        if ($uploadOk == 0 || $uploadOk == 2) {

            if ($uploadOk == 0) {
                $i = 1;
                $filesearch = str_replace(".$imageFileType", '', $file);
                while(file_exists("../public/$filesearch-$i.$imageFileType")) {
                    $i += 1;
                }
                $file = str_replace(".$imageFileType", "-$i.$imageFileType", $file);
                move_uploaded_file($_FILES['image']['tmp_name'], "../public/$file");
            }
            else {
                move_uploaded_file($_FILES['image']['tmp_name'], "../public/$file");
                //echo "<script>alert(\"".$_FILES['image']['tmp_name'].", ".$file."\")</script>";
            }
        }
    }

    $query = "SELECT * FROM $currentList WHERE title='$title';";
    if(checkIfEmptySet($query, $mysqli)){
        print_r($_POST);
        if(!isset($_POST["radio1"]) && !isset($_POST["checkbox1"])) {
            $newQuery = "INSERT INTO $currentList (title,content,image,status) VALUES ('$title', '$content','$file','current');";

        } else if(!isset($_POST["content"]) && !isset($_POST["checkbox1"])) {
            $newQuery = "INSERT INTO $currentList (title,image,status) VALUES ('$title','$file','current');";
            $i = 1;
            $contents = '';
            while(isset(${"radio".$i})) {
                if (strlen($contents) > 0) {
                    $contents .= ';'.${'radio'.$i};
                } else $contents = ${'radio'.$i};
                $i += 1;
            }
            $newQuery .= "UPDATE $currentList SET radio='".$contents."' WHERE title='$title';";

        } else if(!isset($_POST["content"]) && !isset($_POST["radio1"])) {
            $newQuery = "INSERT INTO $currentList (title,image,status) VALUES ('$title','$file','current');";
            $j = 1;
            $contents = '';
            while(isset(${"checkbox".$j})) {
                if (strlen($contents) > 0) {
                    $contents .= ';'.${'checkbox'.$j};
                } else $contents = ${'checkbox'.$j};
                $j += 1;
            }
            $newQuery .= "UPDATE $currentList SET checkbox='".$contents."' WHERE title='$title';";
        }        
    } else {
        echo "<script>alert(\"Name already exists\")</script>";
        //header("location: ../public/onlinesurvey.php?survey=".str_replace(' ','_',$_SESSION["current_list"]));
    }

    if($result = $mysqli->multi_query($newQuery)){
        // SUCCESS
        header("location: ../public/onlinesurvey.php?survey=".str_replace(' ','_',$_SESSION["current_list"]));
    } else {
        echo "<script>alert(\"Error\")</script>";
        header("location: ../public/onlinesurvey.php?survey=".str_replace(' ','_',$_SESSION["current_list"]));
    }
  } else if((isset($_POST["content"]) || isset($_POST["radio"]) || isset($_POST["checkbox"])) && $_POST["title"] == "") {
        header("location: ../public/onlinesurvey.php?survey=".str_replace(' ','_',$_SESSION["current_list"]));
  }

  // finaly get All card
  if(isset($_SESSION["current_list"])){
    getAllFields($_SESSION["current_list"], $status="current", $mysqli);
  }
?>