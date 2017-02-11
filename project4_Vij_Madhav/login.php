<?php
require_once("includes/config.php");
//now we can use our config file
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

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cheapbook";
    $user = "";
    $pass = "";

    if(isset($_POST['login'])){
      if(isset($_POST['uname'])){
        $user=$_POST['uname'];
      }
      if(isset($_POST['psw'])){
        $pass = md5($_POST['psw']);
      }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
    $conn->set_charset("utf8");
    $user = stripslashes($user);
    $pass = stripslashes($pass);

    $user = mysqli_real_escape_string($conn, $user);
    $pass = mysqli_real_escape_string($conn, $pass);

    $sql_u = "SELECT username FROM customers WHERE username='$user'";
    $sql = "SELECT username FROM customers WHERE (username='$user' and password='$pass')";
    $result_u = $conn->query($sql_u);
    $result = $conn->query($sql);

    if ($result_u->num_rows == 0) {
        echo "<br/><br/><br/><div style='text-align:center' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span>"."Username Does Not Exist, please Register"."</div>";
    }
    else if ($result->num_rows == 0) {
        echo "<br/><br/><br/><div style='text-align:center' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span>"."Invalid Username/Password"."</div>";
    }
    else if($result->num_rows> 0)
    {
      $row = $result->fetch_assoc();
      session_start();
      $_SESSION["user"]= $row["username"];
      header("Location: bookstore.php");
        }
    else {
          echo "0 results";
        }
    $conn->close();
  }
?>

<div class="container">
<form class="login card" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>
    <legend class="lg_legend">Login</legend>
    <div class="row">
  <div class="imgcontainer col-md-4">
    <img src="images/login_avatar.png" alt="Avatar" class="avatar">
  </div>
  <div class="container  col-md-8">
    <label><b>Username</b></label><br/>
    <input type="text" placeholder="Enter Username" name="uname" required="required">
<br/>
    <label><b>Password</b></label><br/>
    <input type="password" placeholder="Enter Password" name="psw">
<br/>       
    <a href="register.php"><input type="button" name="register" class="rgn_btn" value="Register"></a>
    <button type="submit" class="lgn_btn" name="login" style="vertical-align:middle"><span>Login</span></button>
    </div>
  </div>
  </fieldset>
  </form>
  </div>
</div>

</body>
</html>

<?php
include(ROOT_PATH . "includes/footer.php");
?>
