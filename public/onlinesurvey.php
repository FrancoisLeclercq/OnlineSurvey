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
    /*
    if(isset($_POST['title']) and isset($_POST['content']) and isset($_POST['image'])){
      echo "<script>alert('Script done')</script>";
    }*/
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Online Survey</title>
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
     <!-- list of user -->
      <div class="friend-div" style="z-index: 999;">
          <button id="show-more" class="myButton" style="width: 12.8rem; margin-left: 0.5rem; animation: FADE_IN 0s;">Members list</button>
          <button id="quit-friend-list" class="myButton" style="width: 6rem; margin-left: 0.5rem; display:none;">Back</button>
      </div>
     <!-- title -->
     <h1 id="current-list-name" class="title" style="z-index: 0; padding-left: 5rem; padding-right: 5rem;"><?php echo $_SESSION["current_list"]; ?></h1>
    <div class="d-flex justify-content-around todo-content">
      <!-- All current cards -->
      <div class="current-card d-flex flex-column background-survey" style="margin-top: -1rem;">
        <!-- <h1 class="title-bis background-fade title-fixed" style="background-color: rgba(255,255,255,0.2);">Current Survey</h1> -->
        <?php
          getAllFields($_SESSION["current_list"], $status="current", $mysqli);
        ?>
      </div>
      <!-- Adding a new card -->
      <div class="create-card d-flex flex-column background-add" style="width: 25rem; margin-left: -5rem; margin-top: -1rem;">
        
        <style>  
        @font-face {
          font-family: Nunito;
          src: url("images/Nunito-Regular.ttf");
        }</style>

        <button class="add" id="button-add-field" style="width: 9.5rem; margin-bottom: 0.5rem;"><img src="images/icons/add-field.svg" alt="add-field" class="add" style="margin-top: -0.5rem; margin-left: -0.4rem;"><a class="add-font" style="font-weight: bold; font-size: 1.3rem; color: rgba(255,255,255,0.8);">&nbsp;&nbsp;&nbsp;&nbsp;Add field</a></button>

        <form method="post" id="field-form" action="../private/addField.php" enctype="multipart/form-data">
          <!-- <input type="file" name="image" id="image-add" accept="image/png, image/jpeg" style="width: 20rem;"> -->
          <input type="file" class="custom-file-input" name="image" id="adding-image" accept="image/png, image/jpeg" style="margin-top: -0.15rem; height: 2.3rem;">
          <button id="button-add-image" class="add" style="width: 10.3rem; margin-top: 0.05rem;"><img src="images/icons/add-image.svg" alt="add-image" style="margin-top: -0.5rem; margin-left: -0.4rem;"><a class="add-font" style="font-weight: bold; font-size: 1.3rem; color: rgba(255,255,255,0.8); width: 10.3rem;">&nbsp;&nbsp;&nbsp;&nbsp;Add image</a></button><br/><br/>
          
          <input id="title-add" class="create-card-item" type="text" name="title" value="" placeholder="Enter question here&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" style="width: 20.4rem; line-height: 2.6rem; padding-left: 0.5rem; padding-right: 0.5rem; margin-left: 0.25rem; font-size: 21px;">
          
          <div id="field-answers">
          </div>
                    
          <input class="custom-file-input display-item" name="text" id="adding-text" style="width: 16rem !important; height: 2.4rem !important; margin-top: 0.1rem !important;">
          <button id="button-add-text" class="add display-item" style="margin-bottom: 0.75rem; width: 16rem;"><img src="images/icons/add-text.svg" alt="add-text" style="margin-top: -0.5rem; margin-left: -0.4rem;"><a class="add-font" style="font-weight: bold; font-size: 1.3rem; color: rgba(255,255,255,0.8); width: 16rem;">&nbsp;&nbsp;&nbsp;&nbsp;Simple text question</a></button><br/>
        
          <input class="custom-file-input display-item" name="radio" id="adding-radio" style="width: 17.4rem !important; height: 2.4rem !important; margin-top: 0.1rem !important;">
          <button id="button-add-radio" class="add display-item" style="margin-bottom: 0.75rem; width: 17.4rem;"><img src="images/icons/radio_36.svg" alt="add-radio" style="margin-top: -0.5rem; margin-left: -0.4rem;"><a class="add-font" style="font-weight: bold; font-size: 1.3rem; color: rgba(255,255,255,0.8); width: 17.4rem;">&nbsp;&nbsp;&nbsp;&nbsp;Single-choice question</a></button><br/>
          
          <input class="custom-file-input display-item" name="checkbox" id="adding-checkbox" style="width: 16.6rem !important; height: 2.4rem !important; margin-top: 0.1rem !important;">
          <button id="button-add-checkbox" class="add display-item" style="margin-bottom: 1rem; width: 16.6rem;"><img src="images/icons/checkbox_36.svg" alt="add-checkbox" style="margin-top: -0.5rem; margin-left: -0.4rem;"><a class="add-font" style="font-weight: bold; font-size: 1.3rem; color: rgba(255,255,255,0.8); width: 16.6rem;">&nbsp;&nbsp;&nbsp;&nbsp;Multi-choice question</a></button><br/>
          
          <input type="submit" name="add-field" class="create-card-item" id="submit-field" style="margin-top: -3rem;" value="Add question to survey">
        </form>

        <script type="text/javascript">
          $(document).on('click', '#button-add-field', function(){
            $("#button-add-field").css('display','none');
            $("#field-form").css('display','block');
            $("#submit-field").css('display','none');
          });
          $(document).on('click', '#adding-text', function(){
            $(".display-text").css('display','block');
            $("#submit-field").css('display','block');
            $(".display-item").css('display','none'); // hide add categories

            $("#field-answers").append('<textarea id="content-add" class="create-card-item" rows="4" cols="50" name="content" value="" placeholder="Write something here if you want a placeholder in the answer (hints, instructions, etc.)" style="width: 20.4rem; padding-left: 0.5rem; padding-right: 0.5rem; margin-left: 0.25rem; font-size: 21px; margin-bottom: 0;"></textarea>');
            });
          $(document).on('click', '#adding-radio', function(){
            $(".display-radio").css('display','block');
            $(".display-item").css('display','none'); // hide add categories

            $("#field-answers").append('<input class="custom-file-input" name="one-radio" id="adding-one-radio" style="width: 3rem !important; margin-left: 18.5rem; margin-bottom: -2.4rem !important; height: 2.4rem !important; margin-top: 0.1rem !important;">');
            $("#field-answers").append('<button id="button-add-one-radio" class="add" style="width: 3rem; margin-left: 18.5rem;"><img src="images/icons/add-field.svg" alt="add-field" style=""></button><br/>');
            $("#field-answers").append('<p style="margin-top: -4.7rem;"></p><br/>'); // center elements up
          });
          $(document).on('click', '#adding-checkbox', function(){
            $(".display-checkbox").css('display','block');
            $(".display-item").css('display','none'); // hide add categories

            $("#field-answers").append('<input class="custom-file-input" name="one-radio" id="adding-one-checkbox" style="width: 3rem !important; margin-left: 18.5rem; margin-bottom: -2.4rem !important; height: 2.4rem !important; margin-top: 0.1rem !important;">');
            $("#field-answers").append('<button id="button-add-one-radio" class="add" style="width: 3rem; margin-left: 18.5rem;"><img src="images/icons/add-field.svg" alt="add-field" style=""></button><br/>');
            $("#field-answers").append('<p style="margin-top: -4.7rem;"></p><br/>'); // center elements up
          });

          var radioInc = 0;
          var checkboxInc = 0;

          $(document).on('click', '#adding-one-radio', function(){
            var radiotext = prompt("Enter radio name:", "");
            if(radiotext != "" && radiotext != null) {
              radioInc += 1; // same or different name attribute ?
              $("#field-answers").append('<input type="radio" style="margin-left: 0.3rem;" value="'+radiotext+'" id="'+radioInc+'" name="radio'+radioInc+'"/><label for="'+radiotext+'" style="color: white; font-size: 20px; font-family: YouTube Sans Light;">&nbsp;&nbsp;'+radiotext+'</label><br/>');
              
              var radioId = "#"+radioInc;
              $(radioId).click();
              $("#submit-field").css('display','block');
            } else if(radiotext != null) {
              alert("Please type in something for your radio answer");
              $('#adding-one-radio').click();
            }
          });
          $(document).on('click', '#adding-one-checkbox', function(){
            var checkboxtext = prompt("Enter checkbox name:", "");
            if(checkboxtext != "" && checkboxtext != null) {
              checkboxInc += 1; // same or different name attribute ?
              $("#field-answers").append('<input type="checkbox" style="margin-left: 0.3rem;" value="'+checkboxtext+'" id="'+checkboxInc+'" name="checkbox'+checkboxInc+'"/><label for="'+checkboxtext+'" style="color: white; font-size: 20px; font-family: YouTube Sans Light;">&nbsp;&nbsp;'+checkboxtext+'</label><br/>');
              
              var checkboxId = "#"+checkboxInc;
              $(checkboxId).click();
              $("#submit-field").css('display','block');
            } else if(checkboxtext != null) {
              alert("Please type in something for your checkbox answer");
              $('#adding-one-checkbox').click();
            }
          });
        </script>

        <!-- Invite member -->
        <br/><h1 class="title-bis">Invite member to<br/>take this survey</h1>
        <input id="content-new-user" class="invite-user add" name="comment" placeholder="johnsmith42@example.com" style="width: 20.4rem; margin-left: 0.25rem;"></input>
        <div id="switch-new-user" class="custom-control custom-switch" style="display: none;">
          <input type="checkbox" class="custom-control-input" checked id="customSwitch2">
          <label class="custom-control-label color-text" for="customSwitch2">Read / Read-Write</label>
        </div>
        <button id="button-new-user" type="submit" name="button" style="outline: 0; background: url(images/icons/email.svg) no-repeat 0.5rem 0.3rem; background-color: #ffba26; width: 6rem; margin-left: 7.55rem; padding-left: 2.2rem; line-height: 1.11rem !important; height: 2.05rem; font-size: 22px;" class="button-list">Invite</button><br/><br/>
        <!-- delete the todo list -->
        <button id="button-delete-project" type="submit" name="button" style="outline: 0; background: url(images/icons/delete_36.svg) no-repeat 0.05rem 0.05rem; background-color: #dd2222; width: 11.25rem; margin-left: 4.85rem;" class="button-list"><a href="view.php" style="text-decoration: none; color: black; margin-left: -0.5rem;">Delete survey</a></button>
      </div>
    </div>

    <!-- MEMBER LIST  -->
    <div class="black-fade" id="friend-list">
      <div class="friend-list">
        <h1 class='title-ters'>Participants:</h1>
        <?php
          // get all survey members
          getMembers($_SESSION['log_email'], $_SESSION['right'], str_replace(' ','_',$_SESSION['current_list']), $mysqli);
         ?>
      </div>
    </div>

    <?php
      if(isset($_GET['error_friend'])){
        switch ($_GET['error_friend']) {
          case 1:
            echo "<script>alert(\"Can't remove right to this user !\")</script>";
            break;
          default:
            echo "<script>alert(\"There was an error !\")</script>";
            break;
        }
      }
      if(isset($_GET['success_friend'])){
        if($_GET['success_friend'] == 1){
          echo "<script>alert(\"Rights deleted successfuly !\")</script>";
        }
      }
    ?>
    <!-- friend button script -->
    <script type="text/javascript">
      if ($('#friend-list').css('display') === 'none') {
        document.getElementById('show-more').style.cursor = 'pointer';
        $(document).on('click', '#show-more', function(){
          $(".black-fade").css('display', 'block');
          $('#friend-list').css('display', 'block');
          $('#quit-friend-list').css('display', 'block');
          $('#show-more').css('display', 'none');
        });
      }
      document.getElementById('quit-friend-list').style.cursor = 'pointer';
      $(document).on('click', '#quit-friend-list', function(){
        $(".black-fade").css('display', 'none');
        $("#friend-list").css('display', 'none');
        $('#quit-friend-list').css('display', 'none');
        $('#show-more').css('display', 'block');
      });
    </script>
    <!-- import footer -->
    <?php
      include_once "includes/footer.php";
     ?>
  </body>
</html>