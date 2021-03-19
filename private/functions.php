<?php
    // this function call login page
    function goToLoginPage($error){
      header("Location: ../public/login.php?error=$error");
    }
    // this function return true & the id if the user and the password are correct
    function checkDB($user, $pass, $query, $mysqli){
      if($result = $mysqli->query($query)) {
        while($row = $result->fetch_assoc()) {
          if($row["pwd"] <> $pass || $pass == ''){
            return array(false, 1);
          } else {
            return array(true, intval($row['id']));
          }
        }
      }
      return array(false, 2);
    }

    // this function is called for each page and check the connection of the user
    function checkLogin($mysqli){
      include_once "connection.php";
      if((isset($_POST["log_username"]) and isset($_POST["log_password"])) or (isset($_SESSION["log_username"]) and isset($_SESSION["log_password"]))){
        if(isset($_POST["log_username"]) and isset($_POST["log_password"])){
          $user = $mysqli->real_escape_string($_POST["log_username"]);
          $pass = $mysqli->real_escape_string($_POST["log_password"]);
        } else {
          $user = $mysqli->real_escape_string($_SESSION["log_username"]);
          $pass = $mysqli->real_escape_string($_SESSION["log_password"]);
        }

        $query = "SELECT * , AES_DECRYPT(password, '$pass') AS pwd
                  FROM users WHERE username='$user' OR email='$user';";

        $login = checkDB($user, $pass, $query, $mysqli);

        if(!$login[0]){
          goToLoginPage($error=$login[1]);
        } else {
          $_SESSION['log_id'] = $login[1];
          $information = getUserInfo($_SESSION['log_id'], $mysqli);
          if($information){
            $_SESSION['log_username'] = $information[0];
            $_SESSION['log_firstname'] = $information[3];
            $_SESSION['log_lastname'] = $information[4];
            $_SESSION['log_email'] = $information[1];
            $_SESSION['log_password'] = $pass;
          } else {
            goToLoginPage($error=3);
          }
        }
      } else {
        goToLoginPage($error=0);
      }
    }

    // this function return true if the query return is an empty set
    function checkIfEmptySet($query, $mysqli){
      if($result = $mysqli->query($query)) {
        while($row = $result->fetch_assoc()) {
          return false;
        }
      }
      return true;
    }

    // this function return all informations of the user by his ID
    function getUserInfo($id, $mysqli){
      $query = "SELECT * FROM users WHERE id=$id;";
      if($result = $mysqli->query($query)) {
        while($row = $result->fetch_assoc()) {
          return array($row["username"],$row["email"],$row["password"],$row["firstname"],$row["lastname"]);
        }
      }
      return 0;
    }

    function createField($textContent, $srcImage, $cardTitle, $status, $id){
      $typeButton = array("current" => "Delete field");

      if($srcImage != '') {

        echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
        echo "<p class='card-id'>".$id."</p>";
        echo "<img src='$srcImage' class='card-img-top' alt='".$cardTitle."'>";
        echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
        echo "<h5 class='card-title' style='font-size: 24px; font-weight: bolder; width: 45rem;'>$cardTitle</h5>";
        echo "<p class='card-text' style='font-size: 20px; margin-right: 5rem; font-family: YouTube Sans Light; font-weight: bold;'>$textContent</p>";
        echo "</div>";
        echo "<a class='btn btn-primary' style='outline: 0; border: 0; position: relative; top: 1rem; right: 1rem; font-size: 0; background: url(images/icons/delete_48.svg) no-repeat; height: 48px; width: 48px;'></a>";
        echo "</div>";

      } else {
          
        echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
        echo "<p class='card-id'>".$id."</p>";
        echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
        echo "<h5 class='card-title' style='font-size: 24px; font-weight: bolder; width: 60rem;'>$cardTitle</h5>";
        echo "<p class='card-text' style='font-size: 20px; margin-right: 5rem; font-family: YouTube Sans Light; font-weight: bold;'>$textContent</p>";
        echo "</div>";
        echo "<a class='btn btn-primary' style='outline: 0; border: 0; position: relative; top: 1rem; right: 1rem; font-size: 0; background: url(images/icons/delete_48.svg) no-repeat; height: 48px; width: 48px;'></a>";
        echo "</div>";
      }
    }

    function getAllFields($listName, $status, $mysqli){
      $listName = str_replace(' ','_',$listName);
      $query = "SELECT * FROM $listName WHERE status='$status' ORDER BY id ASC;";
      if($result = $mysqli->query($query)){
        while ($row = $result->fetch_assoc()) {
          if(isset($row["content"])) {
            if($row["content"] == '') {
              $row["content"] = "Reply will be shown here";
            }
            createField($row["content"], $row["image"], $row["title"], $status, $row['id']);
          } else if(isset($row["radio"])) {
            $row["radio"] = str_replace(';','<br/>• ',$row["radio"]);
            $row["radio"] = "• ".$row["radio"];
            createField($row["radio"], $row["image"], $row["title"], $status, $row['id']);
          } else if(isset($row["checkbox"])) {
            $row["checkbox"] = str_replace(';','<br/>✓ ',$row["checkbox"]);
            $row["checkbox"] = "✓ ".$row["checkbox"];
            createField($row["checkbox"], $row["image"], $row["title"], $status, $row['id']);
          }
        }
      }
    }

    function createFieldSharedSimple($textContent, $srcImage, $cardTitle, $status, $id, $i){

      $cardTitle = str_replace("\"","'",$cardTitle);
      if($srcImage != '') {

        echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
        echo "<p class='card-id'>".$id."</p>";
        echo "<img src='$srcImage' class='card-img-top' name='' alt=\"".$cardTitle."\">";
        echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
        echo "<input style='font-size: 24px; font-weight: bolder; width: 54rem; background-color: transparent; border: none; outline: 0; margin-top: -0.5rem; margin-bottom: 0.68rem;' readonly value=\"".$cardTitle."\" name='content".$i."title'/>";
        echo "<textarea id='textareasimple".$id."' class='answer-card-item' rows='3' cols='50' name='content".$i."' value='' placeholder='$textContent' style='width: 54rem; padding-left: 0.5rem; padding-right: 0.5rem; margin-left: 0.25rem; font-size: 21px; margin-bottom: 0; margin-left: 1px; line-height: 1.63rem; padding-top: 0.1rem; padding-bottom: 0.2rem !important; min-height: 5.3rem; overflow: hidden'></textarea>";
        echo "<script type='text/javascript'>", "textarea = document.querySelector('#textareasimple".$id."');",
        "textarea.addEventListener('input', autoResize, false);", "function autoResize() { this.style.height = this.scrollHeight + 'px'; }", "</script>";
        echo "</div>";
        echo "</div>";

      } else {
          
        echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
        echo "<p class='card-id'>".$id."</p>";
        echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
        echo "<input style='font-size: 24px; font-weight: bolder; width: 63rem; background-color: transparent; border: none; outline: 0; margin-top: -0.5rem; margin-bottom: 0.68rem;' readonly value=\"".$cardTitle."\" name='content".$i."title'/>";
        echo "<textarea id='textareasimple".$id."' class='answer-card-item' rows='3' cols='50' name='content".$i."' value='' placeholder='$textContent' style='width: 64rem; padding-left: 0.5rem; padding-right: 0.5rem; margin-left: 0.25rem; font-size: 21px; margin-bottom: 0; margin-left: 0; line-height: 1.63rem; padding-top: 0.1rem; padding-bottom: 0.2rem !important; min-height: 5.3rem; overflow: hidden'></textarea>";
        echo "<script type='text/javascript'>", "textarea = document.querySelector('#textareasimple".$id."');",
        "textarea.addEventListener('input', autoResize, false);", "function autoResize() { this.style.height = this.scrollHeight + 'px'; }", "</script>";
        echo "</div>";
        echo "</div>";
      }
    }

    function createFieldSharedRadio($textContent, $srcImage, $cardTitle, $status, $id, $j){

      $cardTitle = str_replace("\"","'",$cardTitle);
      if($srcImage != '') {

        echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
        echo "<p class='card-id'>".$id."</p>";
        echo "<img src='$srcImage' class='card-img-top' alt=\"".$cardTitle."\">";
        echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
        echo "<input style='font-size: 24px; font-weight: bolder; width: 54rem; background-color: transparent; border: none; outline: 0; margin-top: -0.5rem; margin-bottom: 0.68rem;' readonly value=\"".$cardTitle."\" name='radio".$j."title'/>";
        $radioArray = explode("<br/>",$textContent);
        for($i = 0; $i < count($radioArray); $i++) {
          ${'radio'.$i} = $radioArray[$i];
          echo "<input type='radio' style='margin-left: 0.3rem;' value='".${'radio'.$i}."' id='".${'radio'.$i}."' name='radio".$j."'/><label for='' style='color: white; font-size: 20px; font-family: YouTube Sans Light; line-height: 1.4rem; color: #121212; font-weight: bold !important;'>&nbsp;&nbsp;$radioArray[$i]</label><br/>";
        }
        echo "</div>";
        echo "</div>";

      } else {
          
        echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
        echo "<p class='card-id'>".$id."</p>";
        echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
        echo "<input style='font-size: 24px; font-weight: bolder; width: 63rem; background-color: transparent; border: none; outline: 0; margin-top: -0.5rem; margin-bottom: 0.68rem;' readonly value=\"".$cardTitle."\" name='radio".$j."title'/>";
        $radioArray = explode("<br/>",$textContent);
        for($i = 0; $i < count($radioArray); $i++) {
          ${'radio'.$i} = $radioArray[$i];
          echo "<input type='radio' style='margin-left: 0.3rem;' value='".${'radio'.$i}."' id='".${'radio'.$i}."' name='radio".$j."'/><label for='' style='color: white; font-size: 20px; font-family: YouTube Sans Light; line-height: 1.4rem; color: #121212; font-weight: bold !important;'>&nbsp;&nbsp;$radioArray[$i]</label><br/>";
        }
        echo "</div>";
        echo "</div>";
      }
    }

    function createFieldSharedCheckbox($textContent, $srcImage, $cardTitle, $status, $id, $k){

      $kk = 1;
      $cardTitle = str_replace("\"","'",$cardTitle);

      if($srcImage != '') {

        echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
        echo "<p class='card-id'>".$id."</p>";
        echo "<img src='$srcImage' class='card-img-top' alt=\"".$cardTitle."\">";
        echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
        echo "<input style='font-size: 24px; font-weight: bolder; width: 54rem; background-color: transparent; border: none; outline: 0; margin-top: -0.5rem; margin-bottom: 0.68rem;' readonly value=\"".$cardTitle."\" name='checkbox".$k."title'/>";
        $checkboxArray = explode("<br/>",$textContent);
        for($i = 0; $i < count($checkboxArray); $i++) {
          ${'checkbox'.$i} = $checkboxArray[$i];
          echo "<input type='checkbox' style='margin-left: 0.3rem;' value='".${'checkbox'.$i}."' id='".${'checkbox'.$i}."' name='checkbox".$k."-".$kk."'/><label for='' style='color: white; font-size: 20px; font-family: YouTube Sans Light; line-height: 1.4rem; color: #121212; font-weight: bold !important;'>&nbsp;&nbsp;$checkboxArray[$i]</label><br/>";
          $kk += 1; // TO HAVE DIFFERENT CHECKBOX NAME FOR EVERY ANSWER
        }
        echo "</div>";
        echo "</div>";

      } else {
          
        echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
        echo "<p class='card-id'>".$id."</p>";
        echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
        echo "<input style='font-size: 24px; font-weight: bolder; width: 63rem; background-color: transparent; border: none; outline: 0; margin-top: -0.5rem; margin-bottom: 0.68rem;' readonly value='$cardTitle' name='checkbox".$k."title'/>";
        $checkboxArray = explode("<br/>",$textContent);
        for($i = 0; $i < count($checkboxArray); $i++) {
          ${'checkbox'.$i} = $checkboxArray[$i];
          echo "<input type='checkbox' style='margin-left: 0.3rem;' value='".${'checkbox'.$i}."' id='".${'checkbox'.$i}."' name='checkbox".$k."-".$kk."'/><label for='' style='color: white; font-size: 20px; font-family: YouTube Sans Light; line-height: 1.4rem; color: #121212; font-weight: bold !important;'>&nbsp;&nbsp;$checkboxArray[$i]</label><br/>";
          $kk += 1; // TO HAVE DIFFERENT CHECKBOX NAME FOR EVERY ANSWER
        }
        echo "</div>";
        echo "</div>";
      }
    }

    function getAllFieldsShared($listName, $status, $mysqli){
      $i = 1; $j = 1; $k = 1;
      $listName = str_replace(' ','_',$listName);
      $query = "SELECT * FROM $listName WHERE status='$status' ORDER BY id ASC;";
      if($result = $mysqli->query($query)){
        while ($row = $result->fetch_assoc()) {
          if(isset($row["content"])) {
            createFieldSharedSimple($row["content"], $row["image"], $row["title"], $status, $row['id'], $i);
            $i += 1;
          } else if(isset($row["radio"])) {
            $row["radio"] = str_replace(';','<br/>',$row["radio"]);
            createFieldSharedRadio($row["radio"], $row["image"], $row["title"], $status, $row['id'], $j);
            $j += 1;
          } else if(isset($row["checkbox"])) {
            $row["checkbox"] = str_replace(';','<br/>',$row["checkbox"]);
            createFieldSharedCheckbox($row["checkbox"], $row["image"], $row["title"], $status, $row['id'], $k);
            $k += 1;
          }
        }
      }
    }

    function createFieldsAnalyze($textContent, $srcImage, $cardTitle, $id, $piechart, $choice){

        $cardTitle = str_replace("\"","'",$cardTitle);

        if($choice == 1) {

            if($srcImage != '') {

                echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
                echo "<p class='card-id'>$id</p>";
                echo "<img src='$srcImage' class='card-img-top' alt=\"".$cardTitle."\">";
                echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
                echo "<h5 class='card-title' id='card-title-".$id."' style='font-size: 24px; font-weight: bolder;'>$cardTitle</h5>";
                echo "<p class='card-text' style='font-size: 20px;  font-family: YouTube Sans Light; font-weight: bold;margin-right: 5rem;'>$textContent</p>";
                echo "$piechart";
                echo "<script>showPiechart(".$id.")</script>";
                echo "</div>";
                echo "</div>";

            } else {
                
                echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
                echo "<p class='card-id'>$id</p>";
                echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
                echo "<h5 class='card-title' id='card-title-".$id."' style='font-size: 24px; font-weight: bolder;'>$cardTitle</h5>";
                echo "<p class='card-text' style='font-size: 20px;  font-family: YouTube Sans Light; font-weight: bold;margin-right: 5rem;'>$textContent</p>";
                echo "$piechart";
                echo "<script>showPiechart(".$id.")</script>";
                echo "</div>";
                echo "</div>";
            }

        } else if ($choice == 2) {

            if($srcImage != '') {

                echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
                echo "<p class='card-id'>$id</p>";
                echo "<img src='$srcImage' class='card-img-top' alt=\"".$cardTitle."\">";
                echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
                echo "<h5 class='card-title' id='card-title-".$id."' style='font-size: 24px; font-weight: bolder;'>$cardTitle</h5>";
                echo "<p class='card-text' style='font-size: 20px;  font-family: YouTube Sans Light; font-weight: bold;margin-right: 5rem;'>$textContent</p>";
                echo "</div>";
                echo "$piechart";
                echo "<div style='margin-right: 0.85rem; margin-top: 0.85rem;'>";
                echo "<button id='show-dataviz".$id."' class='myButton' style='width: 8.6rem; height: 2.22rem; font-size: 26px; margin-left: 0.5rem; animation: FADE_IN 0.5s; background: url(images/icons/pie_24.svg) no-repeat 0.3rem 0.4rem; background-color: #ffba26; color: black; padding-left: 2rem; padding-right: 0.5rem; line-height: 2.1rem;'>Pie Chart</button>";
                echo "<button id='close-dataviz".$id."' style='width: 2.3rem; height: 2.3rem; font-size: 26px; margin-top: 0; margin-left: -2rem; animation: FADE_IN 0.5s; background: url(images/icons/close_36.svg) no-repeat; border: none; outline: none; display: none;'></button>";
                echo "<script>showPiechart(".$id.")</script>";
                echo "</div>";
                echo "</div>";

            } else {
                
                echo "<div class='card' style='width: auto; margin: 0 auto; margin-top: 20px;'>";
                echo "<p class='card-id'>$id</p>";
                echo "<div class='card-body' style='margin-top: -0.25rem; font-family: YouTube Sans;'>";
                echo "<h5 class='card-title' id='card-title-".$id."' style='font-size: 24px; font-weight: bolder;'>$cardTitle</h5>";
                echo "<p class='card-text' style='font-size: 20px;  font-family: YouTube Sans Light; font-weight: bold;margin-right: 5rem;'>$textContent</p>";
                echo "</div>";
                echo "$piechart";
                echo "<div style='margin-right: 0.85rem; margin-top: 0.85rem;'>";
                echo "<button id='show-dataviz".$id."' class='myButton' style='width: 8.6rem; height: 2.22rem; font-size: 26px; margin-left: 0.5rem; animation: FADE_IN 0.5s; background: url(images/icons/pie_24.svg) no-repeat 0.3rem 0.4rem; background-color: #ffba26; color: black; padding-left: 2rem; padding-right: 0.5rem; line-height: 2.1rem;'>Pie Chart</button>";
                echo "<button id='close-dataviz".$id."' style='width: 2.3rem; height: 2.3rem; font-size: 26px; margin-left: -2rem; margin-top: 0; animation: FADE_IN 0.5s; background: url(images/icons/close_36.svg) no-repeat; border: none; outline: none; display: none;'></button>";
                echo "<script>showPiechart(".$id.")</script>";
                echo "</div>";
                echo "</div>";
            }
        }
    }

    function getAllCardFromAnalyze($listName, $mysqli){
      $listName = str_replace(' ','_',$listName);
      $query = "SELECT * FROM $listName ORDER BY id ASC;";
      if($result = $mysqli->query($query)){
        $queryJson = "SELECT answers FROM answers WHERE survey='$listName' AND answers IS NOT NULL;";
        if($resultJson = $mysqli->query($queryJson)){
          while($rowJson = $resultJson->fetch_assoc()) {
            $surveyLength = json_encode($rowJson["answers"]);
            $rowJsonFull[] = $rowJson["answers"];
          }
          while ($row = $result->fetch_assoc()) {
            if(isset($row["content"])) {

              $choice = 1;
              // Only show "Show more" button if there are more than 3 answers 
              if(count($rowJsonFull) > 3) {
                $piechart = "<div id='text_dataviz".$row['id']."'></div><div id='full_text_dataviz".$row['id']."' style='animation: FADE_IN 0.5s; display: none;'></div><script>textAnswers(".$row['id'].",".$surveyLength.",".json_encode($rowJsonFull).");</script>";
                $piechart .= "</div>";
                $piechart .= "<div style='margin-right: 0.85rem; margin-top: 0.85rem;'>";
                $piechart .= "<button id='show-dataviz".$row['id']."' class='myButton' style='width: 8.6rem; height: 2.22rem; font-size: 26px; margin-left: 0.5rem; animation: FADE_IN 0.5s; background-color: #ffba26; color: black; padding-left: 0.5rem; padding-right: 0.5rem; line-height: 2.1rem;'>Show more</button>";
                $piechart .= "<button id='close-dataviz".$row['id']."' style='width: 2.3rem; height: 2.3rem; font-size: 26px; margin-left: -2rem; margin-top: 0; animation: FADE_IN 0.5s; background: url(images/icons/close_36.svg) no-repeat; border: none; outline: none; display: none;'></button>";
              } else {
                $piechart = "<div id='text_dataviz".$row['id']."'></div><div id='full_text_dataviz".$row['id']."' style='animation: FADE_IN 0.5s; display: none;'></div><script>textAnswers(".$row['id'].",".$surveyLength.",".json_encode($rowJsonFull).");</script>";
                $piechart .= "</div>";
                $piechart .= "<div style='margin-right: 0.85rem; margin-top: 0.85rem;'>";
              }
                
              createFieldsAnalyze($row["content"], $row["image"], $row["title"], $row['id'], $piechart, $choice);

            } else if(isset($row["radio"])) {

              $choice = 2;
              $row["radio"] = str_replace(';','<br/>• ',$row["radio"]);
              $row["radio"] = "• ".$row["radio"];
              $piechart = "<div id='my_dataviz".$row['id']."' style='animation: FADE_IN 0.5s;'></div><script>piechartRadio(".$row['id'].",".$surveyLength.",".json_encode($rowJsonFull).");</script>";
              createFieldsAnalyze($row["radio"], $row["image"], $row["title"], $row['id'], $piechart, $choice);

            } else if(isset($row["checkbox"])) {
              
              $choice = 2;
              $row["checkbox"] = str_replace(';','<br/>✓ ',$row["checkbox"]);
              $row["checkbox"] = "✓ ".$row["checkbox"];
              $piechart = "<div id='my_dataviz".$row['id']."' style='animation: FADE_IN 0.5s;'></div><script>piechartCheckbox(".$row['id'].",".$surveyLength.",".json_encode($rowJsonFull).");</script>";
              //$piechart = "<button id='show_dataviz".$row['id']."' class='myButton' style='width: 11rem; height: 3rem; font-size: 30px; margin-left: 0.5rem; animation: FADE_IN 0s;'>Pie chart</button>";
              createFieldsAnalyze($row["checkbox"], $row["image"], $row["title"], $row['id'], $piechart, $choice);
            }
          }
        }
      }
    }

    // this function return the date of the last change on the table
    function surveyDateCreated($name, $mysqli){
      $name = str_replace(' ', '_', $name);
      $query = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='db2PROJ' AND TABLE_NAME='$name';";
      if($result = $mysqli->query($query)){
        while($row = $result->fetch_assoc()){
          $time = strtotime($row['CREATE_TIME']);
          return date("M d, Y (g:i A)", $time);
        }
      }
      return 'unknown';
    }

    function listSurvey($name, $listType, $mysqli){

      $name2 = str_replace(" ", "_", $name);
      $query = "SELECT answers FROM answers WHERE survey='$name2';";
      $result = $mysqli->query($query);

      echo "<div id='listspan' style='margin-bottom: 5rem;'>";
      echo "<div style='width:80rem; margin-left: 0rem; background-color:#909090;' class='container'>";
      echo "<form class='formulaire choice-list' action='../public/onlinesurvey.php?survey=".str_replace(" ","_",$name)."' method='post'>";

      echo "<label style='font-size: 3rem; color: #121212; text-align: left; margin: 1rem; order: 1; width: 60rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>".$name."</label>";
      echo "<input class='color-text' readonly='readonly' type='text' name='list_name' value='".$name."' style='display: none;'>";

      echo "<input readonly='readonly' type='text' name='right' value='".$listType."' style='display:none;'>";
      echo "<p class='color-text' style='text-align: right; padding-right: 0.25rem;'>Created on: ".surveyDateCreated($name, $mysqli)."</p>";

      echo "</div>";
      echo "<div>";

      echo "<input type='submit' name='sub_list' value='Edit survey' style='height: 2.32rem; outline: 0; background: url(images/icons/edit_36.svg) no-repeat 0.05rem 0.05rem; background-color: #ffba26 !important; margin-right: 5.6rem;padding-left: 2.6rem; padding-right: 0.5rem;' class='button-list'>";
      
      if($result->num_rows != 0) {
        echo "<span style='width: 11.55rem;'><button id='button-analyze-project' style='height: 2.32rem; outline: 0; background: url(images/icons/analyze.svg) no-repeat 0.05rem 0.05rem; background-color: #00cc44; padding-left: 2.6rem; padding-right: 0.5rem;' class='button-list' type='submit' name='button-analyze'><a href='analyze.php?survey=".str_replace(" ","_",$name)."' style='text-decoration: none; color: black; margin-top: -0.1rem;'>Analyze Survey</a></button></span>";
      } else {
        echo "<span style='width: 11.55rem;'><input type='button' value='Analyze survey' onclick='alert(\"Nobody has taken the survey yet, please comeback later\");' id='button-analyze-project' style='height: 2.32rem; outline: 0; background: url(images/icons/analyze.svg) no-repeat 0.05rem 0.05rem; background-color: #00cc44; padding-left: 2.6rem; padding-right: 0.5rem;' class='button-list'/></span>";
      }
      
      echo "</div>";
      echo "</div>";
      echo "</form>";
    }

    function listSurveyShared($name, $listType, $mysqli){

      echo "<div id='listspan' style='margin-bottom: 5rem;'>";
      echo "<div style='width:80rem; margin-left: 0rem; background-color:#909090;' class='container'>";
      echo "<form class='formulaire choice-list' action='../public/answer.php?survey=".str_replace(" ","_",$name)."' method='post'>";

      echo "<label style='font-size: 3rem; color: #121212; text-align: left; margin: 1rem; order: 1; width: 60rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>".$name."</label>";
      echo "<input class='color-text' readonly='readonly' type='text' name='list_name' value='".$name."' style='display: none;'>";

      echo "<input readonly='readonly' type='text' name='right' value='".$listType."' style='display:none;'>";
      echo "<p class='color-text' style='text-align: right; padding-right: 0.25rem;'>Created on: ".surveyDateCreated($name, $mysqli)."</p>";

      echo "</div>";
      echo "<div>";

      $queryCheck = "SELECT done FROM answers WHERE username='".strtolower($_SESSION['log_username'])."' AND survey='".str_replace(" ","_",$name)."';";
      $result = $mysqli->query($queryCheck);
      $row = $result->fetch_row();

      if($row[0] == 'completed') { // if survey is completed, only access results

        echo "<span style='width: 11.55rem;'><input type='button' value='Take survey' onclick='alert(\"You have already taken this survey\");' style='height: 2.32rem; outline: 0; background: url(images/icons/answer.svg) no-repeat 0.05rem 0.035rem; background-color: #ffba26 !important; margin-right: 5.36rem; margin-left: 0.24rem; padding-left: 2.6rem; padding-right: 0.5rem;' class='button-list'/></span>";

        echo "<span style='width: 11.55rem;'><button id='button-analyze-project' style='height: 2.32rem; outline: 0; background: url(images/icons/analyze.svg) no-repeat 0.05rem 0.05rem; background-color: #00cc44; padding-left: 2.6rem; padding-right: 0.5rem;' class='button-list' type='submit' name='button-analyze'><a href='analyze.php?survey=".str_replace(" ","_",$name)."' style='text-decoration: none; color: black; margin-top: -0.1rem;'>Analyze Survey</a></button></span>";

        } else { // if survey is not completed, can't access results

        echo "<span style='width: 11.55rem;'><input type='submit' name='sub_list' value='Take survey' style='height: 2.32rem; outline: 0; background: url(images/icons/answer.svg) no-repeat 0.05rem 0.035rem; background-color: #ffba26 !important; margin-right: 5.36rem; margin-left: 0.24rem; padding-left: 2.6rem; padding-right: 0.5rem;' class='button-list'></span>";

        echo "<span style='width: 11.55rem;'><input type='button' value='Analyze survey' onclick='alert(\"Please complete the survey before accessing the results\");' style='height: 2.32rem; outline: 0; background: url(images/icons/analyze.svg) no-repeat 0.05rem 0.05rem; background-color: #00cc44; padding-left: 2.6rem; padding-right: 0.5rem;' class='button-list'></span>";
      }
      
      echo "</div>";
      echo "</div>";
      echo "</form>";
    }

    function noSurvey(){
      echo "<h1 class='nosurvey'>You do not have any surveys at the moment.</h1>";
    }

    // this function create list of all Online Survey list by type of list
    function listAllSurveys($listType, $mysqli){
      $query = "SELECT $listType FROM users WHERE id=".$_SESSION["log_id"];
      if($result = $mysqli->query($query)){
        while ($row = $result->fetch_assoc()) {
          $tmp = array_map('strrev', explode(",",strrev($row[$listType])));
          foreach ($tmp as &$value) {
            if($value <> ""){
              listSurvey(str_replace('_',' ',$value), $listType, $mysqli);
            } else {
              noSurvey();
            }
          }
        }
      }
    }

    function listAllSurveysShared($listType, $mysqli){
      $query = "SELECT $listType FROM users WHERE id=".$_SESSION["log_id"];
      if($result = $mysqli->query($query)){
        while ($row = $result->fetch_assoc()) {
          $tmp = array_map('strrev', explode(",",strrev($row[$listType])));
          foreach ($tmp as &$value) {
            if($value <> ""){
              listSurveyShared(str_replace('_',' ',$value), $listType, $mysqli);
            } else {
              noSurvey();
            }
          }
        }
      }
    }

    // checks if provided survey name already exists
    function surveyExists($name, $mysqli){
      $query = "SELECT * FROM $name";
      if($result = $mysqli->query($query)){
        return true;
      } else {
        return false;
      }
    }

    // checks if provided email is already added to survey
    function emailExists($emailArray, $mysqli){
      foreach ($emailArray as $email) {
        $query = "SELECT * FROM users WHERE email='$email';";
        if(checkIfEmptySet($query, $mysqli)){
          return false;
        }
      }
      return true;
    }

    function getNameByEmail($email, $mysqli){
      $query = "SELECT * FROM users WHERE email='$email'";
      if($result = $mysqli->query($query)){
        while ($row = $result->fetch_assoc()) {
          return $row['username'];
        }
      }
      return 'unknown';
    }

    function getEmailByName($name, $mysqli){
      $query = "SELECT * FROM users WHERE username='$name'";
      if($result = $mysqli->query($query)){
        while ($row = $result->fetch_assoc()) {
          return $row['email'];
        }
      }
      return 'unknown';
    }


    function getRightOfUser($email, $rightType, $mysqli){
      $query = "SELECT $rightType FROM users WHERE email='$email';";
      if($result = $mysqli->query($query)){
        while($row = $result->fetch_assoc()){
          return explode(',', $row[$rightType]);
        }
      }
      return false;
    }

    function setRightOfUser($email, $rightType, $rightArray, $mysqli){
      if (($key = array_search("", $rightArray)) !== false) {
        unset($rightArray[$key]);
      }
      $rightString = implode(',', $rightArray);
      $query = "UPDATE users SET $rightType='$rightString' WHERE email='$email';";
      if($result = $mysqli->query($query)){
        return true;
      } else {
        echo $query;
        return false;
      }
    }

    function shareSurvey($name, $right, $emailArray, $mysqli){
      // replace space to '_'
      $name = str_replace(' ','_',$name);
      if($right=="on"){
        $rightType = "sharedSurveys";
      } else {
        $rightType = "noShare";
      }
      foreach ($emailArray as &$email) {
        $rightArray = getRightOfUser($email, $right="sharedSurveys", $mysqli);
        $rightArray = array_merge($rightArray, getRightOfUser($email, $right="noShare", $mysqli));
        if (($key = array_search("", $rightArray)) !== false) {
          unset($rightArray[$key]);
        }
        array_push($rightArray, $name);
        // Check for doublon
        if(count($rightArray) <> count(array_unique($rightArray))){
          return false;
        } else {
          $newRightArray =  getRightOfUser($email, $rightType, $mysqli);
          array_push($newRightArray, $name);
          if(!setRightOfUser($email, $rightType, $newRightArray, $mysqli)){
            return false;
          } else {
            //
            // SEND EMAIL TO $email FOR NOTIFIED IT !
            //
            if($email <> "onlinesurvey@bigbrother.com"){
              require_once "../private/library/mail.php";
              $mailReceive = $mysqli->real_escape_string($email);
              $nameReceiver = ucfirst(getNameByEmail($email, $mysqli));
              $listName = str_replace('_',' ',$name);
              $owner = ucfirst($mysqli->real_escape_string($_SESSION["log_username"]));
              $subject = ucfirst($mysqli->real_escape_string($_SESSION["current_list"]));
              if(!sendEmailToUser($mailReceive, $nameReceiver, $listName, $owner, $rightType, $subject)){
                return false;
              }
            }
          }
        }
      }
      return true;
    }

    // this function return true if your email is in the list of emails
    function searchEmail($arr, $a){
      return (is_numeric(array_search($a, $arr)) ? true : false);
    }

    // this function linked to deleteAllRights() delete for an user the right on a table
    function removeShare($right, $row, $mysqli){
      // find list if exist & delete
      removeSharedSurvey($right, $row, $rightType='mySurveys', $mysqli);
      removeSharedSurvey($right, $row, $rightType='noShare', $mysqli);
      removeSharedSurvey($right, $row, $rightType='sharedSurveys', $mysqli);
    }

    // this function delete de list name from the right type
    function removeSharedSurvey($right, $row, $rightType, $mysqli){
      $arr = explode(",",$mysqli->real_escape_string($row[$rightType]));
      foreach ($arr as $key=>$value) {
        if($right == $value){
          unset($arr[$key]);
        }
      }
      $newRight = implode(',', $arr);
      setRightOfUser($row["email"], $rightType, $arr, $mysqli);
    }

    // this function delete all the right on the table when she is deleted
    function removeSharedSurveysUser($right, $mysqli){
      $query = "SELECT * FROM users;";
      if($result = $mysqli->query($query)){
        while($row = $result->fetch_assoc()){
          removeShare($right, $row, $mysqli);
        }
      } else {
        return false;
      }
    }

    // this function return an array of all the rights by user
    function getMembersRight($right, $mysqli){
      $arr = array();
      $query = "SELECT * FROM users;";
      if($result = $mysqli->query($query)){
        while($row = $result->fetch_assoc()){
          $arr[$row['username']] = explode(',', $row[$right]);
        }
      }
      return $arr;
    }

    // this function return a div with a friend who got rights on a List
    function showMembers($user, $userRight, $right, $list){
      echo "<form class='friend-content' action='../private/removeUser.php' method='post'>";
      echo "<input class='friend-content-input disable-select' type='text' readonly='readonly' name= 'list' value='".$list."' style='display:none;'/>";
      echo "<input class='friend-content-input disable-select' type='text' readonly='readonly' name= 'right' value='".$userRight."' style='display:none;'/>";
      if(($right === 'mySurveys' && $userRight <> 'mySurveys') || ($right <> 'mySurveys' && $user === $_SESSION['log_username']) || ($_SESSION['log_email'] === "onlinesurvey@bigbrother.com" && $userRight <> 'mySurveys')){
        if($user === $_SESSION['log_username']) {
          echo "<input class='friend-content-input disable-select' type='text' readonly='readonly' name= 'user' value='".$user."' style='font-weight:bold;'/>";
        } else {
          echo "<input class='friend-content-input disable-select' type='text' readonly='readonly' name= 'user' value='".$user."'/>";
        }
        echo "&nbsp;<input class='friend-content-submit' type='submit' name= 'submit' value='Remove' style='outline: 0; margin-left: 1.8rem; padding-top: 1rem; font-size: 0; background: url(images/icons/delete_24.svg) no-repeat; height: 24px; width: 24px; size: 110%;'><br/><br/>";
        } else {
        if($user === $_SESSION['log_username']) {
          echo "<input class='friend-content-input disable-select' type='text' readonly='readonly' name= 'user' value='".$user."' style='text-align:center;font-weight:bold;'/>";
        } else {
          echo "<input class='friend-content-input disable-select' type='text' readonly='readonly' name= 'user' value='".$user."' style='text-align:center;'/>";
        }
      }
      echo "</form>";
    }

    function getMembers($email, $right, $list, $mysqli){
        $rightAdmin = getMembersRight($rightType='mySurveys', $mysqli);
        $rightRW = getMembersRight($rightType='sharedSurveys', $mysqli);
        // get creator name
        echo "<h1 class='title-creator'>Creator:";
        foreach ($rightAdmin as $user => $listArray) {
          foreach ($listArray as &$value) {
            if($value === $list){
              showMembers(ucfirst($user), $userRight='mySurveys', $right, $list);
            }
          }
        }
        echo "</h1>";

        // get members name
        echo "<h1 class='title-members'>Members:<br/><br/></h1>";
        foreach ($rightRW as $user => $listArray) {
          foreach ($listArray as &$value) {
            if($value === $list && $user <> 'root'){
              showMembers(ucfirst($user), $userRight='sharedSurveys', $right, $list);
            }
          }
        }
    }
 ?>
