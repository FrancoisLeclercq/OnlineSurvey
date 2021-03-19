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
<div id="register" style="display:none;">
  <h1 class='title'>Register</h1>
  <form class="formulaire" action="../private/addUser.php" method="post">
    <input class="formInput" type="text" name="username" value="" autocomplete="off" placeholder="Username">
    <input class="formInput" type="text" name="firstname" value="" autocomplete="off" placeholder="Firstname">
    <input class="formInput" type="text" name="lastname" value="" autocomplete="off" placeholder="Lastname">
    <input class="formInput" type="email" name="email" value="" autocomplete="off"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email Address">
    <label class="error" for="password" style="display:none;">You can't set empty password!</label>
    <input class="formInput" type="password" name="password" placeholder="Password" pattern=".{6,}" value="" autocomplete="off">
    <label class="error" for="verification" style="display:none;">New passwords are different!</label>
    <input class="formInput" type="password" name="verification" placeholder="Password again" value="" pattern=".{6,}" autocomplete="off">
    <input class="myButton Register" type="button" name="submit" value="Create user">
  </form>
  <script src="js/register.js" charset="utf-8"></script>
</div>
</body>