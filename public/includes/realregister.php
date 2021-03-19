<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Online Survey - Register</title>
  <meta name="Description" content="Online Survey - Register">
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
<nav class="navbar bg-dark" style="padding-bottom: 0.6rem;">
  <a class="navbar-brand" href="index.php">
    &nbsp;&nbsp;<img src="images/logo.png" alt="OnlineSurvey" style="height: 2.5rem; margin-left: -0.65rem; margin-top: 0.15rem;">
  </a>
</nav>
<div id="register">
  <h1 class='title' style="margin-top: 6.6rem !important; margin-bottom: 4rem !important;">Register</h1>
  <form class="formulaire" action="../private/addUser.php" method="post">
    <label class="label" style="margin-left: -10rem; margin-bottom: -1rem;">First name</label>
    <label class="label" style="margin-left: 11.2rem; margin-bottom: -1rem;">Last name</label>
    <br/><input class="formInput" type="text" name="firstname" value="" autocomplete="off" placeholder="John&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" style="width:15rem;">
    <input class="formInput" type="text" name="lastname" value="" autocomplete="off" placeholder="Smith&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" style="width:15rem;">
    <br/><br/><label class="label" style="margin-left: -8.2rem; margin-bottom: -1rem;">Username</label>
    <label class="label" style="margin-left: 11.4rem; margin-bottom: -1rem;">Email address</label>
    <br/><input class="formInput" type="text" name="username" value="" autocomplete="off" placeholder="JohnSmith42&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" style="width:15rem;">
    <input class="formInput" type="email" name="email" value="" autocomplete="off" placeholder="johnsmith42@example.com&nbsp;" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" style="width:15rem;">
    <br/><br/><label class="label" for="change_password" style="margin-left: -6.6rem; margin-bottom: -1rem;">Password</label>
    <label class="label" for="change_password" style="margin-left: 11.8rem; margin-bottom: -1rem;">Retype password</label>
    <label class="error" for="password" style="display:none;">You can't set empty password!</label>
    <br/><input class="formInput" type="password" name="password" placeholder="••••••••&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" pattern=".{6,}" value="" autocomplete="off" style="width:15rem;">
    <label class="error" for="verification" style="display:none;">New passwords are different!</label>
    <input class="formInput" type="password" name="verification" placeholder="••••••••&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" value="" pattern=".{6,}" autocomplete="off" style="width:15rem;">
    <input class="myButton Login" type="button" name="submit" value="Create user" style="margin-top: 2rem !important;">
    <a href="login.php" class="myButton R LR" style="margin-top: 2.6rem !important; padding-top: 0.4rem;">Already have an account?</a>
  </form>
  <script src="js/register.js" charset="utf-8"></script>
</div>
</body>