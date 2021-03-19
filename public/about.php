<?php
  include_once "../private/connection.php";
  include_once "../private/functions.php";
  checkLogin($mysqli);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Online Survey - About</title>
    <meta name="Description" content="Online Survey - About">
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
    <!-- Navbar  -->
    <?php
      include_once "includes/navbar.php";
     ?>
     <h1 class='title' style="margin-bottom: 2rem;">Online Survey - About</h1><br><br><br>
     <div class="help-content background-fade" style="width: 92.5%; margin-left: 70px; border-radius: 0.5rem;">
       <p class='help-text-content color-text' style="font-family: 'YouTube Sans Light' !important; font-weight: lighter; margin-bottom: -0.3rem; margin-top: -0.3rem;">
        Online Survey - Make your life easier, form your feedback better!<br><br>
		Developed by Big Brother, Online Surevy is a tool that allows you to collect data from users with forms or personalized surveys. The information is then collected and automatically linked to a spreadsheet. 
        <br>The worksheet is filled in with answers to the form or survey.
        An email invite system is also available to use for free!<br><br>
        On the home page, you have access to survey creation, listing and editing those that already exist.
        <br><br>
        If you have more questions, feel free to contact our customer service, <b><a href="mailto:onlinesurvey@bigbrother.com" style="font-size:20px;font-family:'YouTube Sans';line-height:21px;color:#FFBA26;text-decoration:none;">onlinesurvey@bigbrother.com</a></b> - see you soon!
        <br><br><br>
        Developped by: François Leclercq & Oscar Di Lenarda<br><br><b><a href="terms.php" style="font-size:20px;font-family:'YouTube Sans';line-height:21px;color:#FFBA26;text-decoration:none;">Read our Terms and Conditions</a></b>
       </p>
     </div>
     <!-- import scripts -->
    <script src="js/jquery.js" charset="utf-8"></script>
    <script src="js/master.js" charset="utf-8"></script>
    <!-- import footer -->
    <?php
      include_once "includes/footer.php";
    ?>
  </body>
</html>
