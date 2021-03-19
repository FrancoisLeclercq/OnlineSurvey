<?php
    include_once "../private/connection.php";
    include_once "../private/functions.php";
    checkLogin($mysqli);
    $survey = str_replace("_"," ",$_GET['survey']);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Analyzing: <?php echo $survey; ?></title>
    <meta name="Description" content="Online Survey - Analyze">
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
    <!-- title -->
    <h1 id="current-list-name" class="title" style="z-index: 0; padding-left: 5rem; padding-right: 5rem;"><?php echo "Results: ".$survey; ?></h1>
    <div class="d-flex justify-content-around todo-content">
      <div class="current-card d-flex flex-column background-survey" style="margin-top: -1rem;">
      <script src='https://d3js.org/d3.v5.min.js'></script>
      <script src='js/piechart.js'></script>
      <script src='js/piechart2.js'></script>
        <?php
          getAllCardFromAnalyze($survey, $mysqli);
        ?>
      </div>
    </div>
    <!-- import footer -->
    <?php
      include_once "includes/footer.php";
     ?>
  </body>
</html>