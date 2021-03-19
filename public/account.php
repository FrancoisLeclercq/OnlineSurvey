<?php
  include_once "../private/connection.php";
  include_once "../private/functions.php";
  checkLogin($mysqli);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Online Survey - Account</title>
    <meta name="Description" content="Online Survey - Account">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- import CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/keyframes.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/mediaQueries.css">
    <!-- include favicon -->
    <link rel="shortcut icon" href="images/icon/favicon.ico">
  </head>
  <body>
    <!-- Navbar -->
    <?php
      include_once "includes/navbar.php";
    ?>
    <!-- title -->
    <h1 class='title' style="margin-bottom: 5rem;">Your Account</h1>
    <!-- formulaire change information -->
    <form id="change-information" action="../private/editUser.php" class="formulaire" method="post">
      <label class="label" for="change_firstname" style="margin-left: -9.9rem; margin-bottom: -1rem;">First name</label>
      <label class="label" for="change_lastname" style="margin-left: 11.05rem; margin-bottom: -1rem;">Last name</label>
      <br/><input class="formInput change-firstname" type="text" name="change_firstname" value="<?php echo $_SESSION['log_firstname']; ?>" style="width:15rem;">
      <input class="formInput change-lastname" type="text" name="change_lastname" value="<?php echo $_SESSION['log_lastname']; ?>" style="width:15rem;">
      <br/><br/><label class="label" for="change_username" style="margin-left: -10.35rem; margin-bottom: -1rem;">Username</label>
      <label class="label" for="change_password" style="margin-left: 11.3rem; margin-bottom: -1rem;">Password</label>
      <br/><input class="formInput change-username" type="text" name="change_username" value="<?php echo $_SESSION['log_username']; ?>" style="width:15rem;">
      <input class="formInput change-password" type="password" name="change_password" pattern=".{6,}" value="<?php echo $_SESSION['log_password']; ?>" style="width:15rem;">
      <br/><br/><label class="label" for="change_email" style="margin-left: -24.5rem; margin-bottom: -0.2rem;">Email address</label>
      <br/><input class="formInput change-email" type="email" name="change_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $_SESSION['log_email']; ?>" style="width:31.5rem;">
      <input class="myButton2 change-submit" type="submit" name="change_submit" value="Update my information" style="width:22rem; margin-top: 2.5rem;">
    </form>


    <!-- delete account check -->
    <button class="myButton2" id="delete-account" type="submit" name="change_submit" style="width: 22rem; margin-top:3.1rem;">Delete my account</button>
    <div id='check-deleting' class="delete-acc">
      <p class="delete-acc2">Are you sure you want to delete your account?</p>
      <p class="delete-acc3">All your data, including your personal information and surveys, will be deleted.</p>
      <button id="yes-deleting" class="myButton2" type="button" name="button" style="position: center; width: 23rem; margin-left: 3.35rem; background-color: red; margin-top: 6rem !important;">YES, DELETE MY ACCOUNT</button>
      <button id="no-deleting" class="myButton2" type="button" name="button" style="width: 23rem; margin-left: 3.35rem; margin-top: 2rem !important;">CANCEL</button>
    </div>
    <div id="popup-delete"></div>
    <?php
    if(isset($_GET["error"])){
      if($_GET["error"]){
        echo "<script>alert(\"This user name is already taken !\");</script>";
      }
    }
    ?>
    <!-- import scripts -->
    <script src="js/jquery.js" charset="utf-8"></script>
    <script src="js/master.js" charset="utf-8"></script>

    <!-- script for deleting account -->
    <script type="text/javascript">
      const buttonDelete = document.getElementById('delete-account');
      const buttonNo = document.getElementById('no-deleting');
      const buttonYes = document.getElementById('yes-deleting');
      const checkDeleteForm = document.getElementById('check-deleting');
       // if user click on button 'delete account'
       buttonDelete.addEventListener('click', () => {
          checkDeleteForm.style.display = 'block';
       });
       // if user click NO
       buttonNo.addEventListener('click', () => {
          checkDeleteForm.style.display = 'none';
       });
       // if user click YES
       buttonYes.addEventListener('click', () => {
          checkDeleteForm.style.display = 'none';
          location.replace("../private/deleteAccount.php?delete_acc=true");
       });
    </script>

    <?php
    if(isset($_GET['delete_error'])){
        echo "<script>error in deleting your account</script>";
    }
    ?>
  </body>
</html>
