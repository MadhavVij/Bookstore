<?php
session_start();
session_destroy();
require_once("includes/config.php");
//now we can use our config file
include(ROOT_PATH . "includes/footer.php");
session_start();
if (!isset($_SESSION["user"]))
  header("Location: login.php");
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
     
     <script src="assets/bootstrap/js/bootstrap.min.js"></script>


      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
     
      <link href="assets/css/style.css" rel="stylesheet" type="text/css">
      <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>images/icon.png">
      <title>Cheap Books</title>

    </head>
<body class="texture">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img alt="Brand" src="images/icon.png" class="logo">
      </a>
    </div>
    <center><h1 class="text-muted">Welcome to CheapBooks</h1></center>
  </div>
</nav>
