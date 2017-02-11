<html>
<head><title>Cheap Books</title>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-dialog.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  <script src="js/bootstrap-dialog.js"></script>
</head>

<?php 
session_start();
if (!isset($_SESSION["user"]))
  header("Location: login.php");
  else
    header("Location: bookstore.php");
  ?>    


</div>
</div>
   
  
 
  </body>
</html>
