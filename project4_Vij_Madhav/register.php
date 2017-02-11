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
     <script type="text/javascript" src="assets/js/register.js" ></script>
     <script src="assets/bootstrap/js/bootstrap.min.js"></script>

      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
     
      <link href="assets/css/style.css" rel="stylesheet" type="text/css">
      <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>images/icon.png">
      <title>Cheap Books</title>

    </head>
<body class="texture" onload="document.register.uname.focus();">
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
    $email = "";
    $phone = "";
    $add = "";
    $pass = "";

    if(isset($_POST['register'])){
      if(isset($_POST['uname'])){
        $user=$_POST['uname'];
      }
      if(isset($_POST['email'])){
        $email = $_POST['email'];
      }
      if(isset($_POST['phone'])){
        $phone = $_POST['phone'];
      }
      if(isset($_POST['add'])){
        $address = $_POST['add'];
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
      $email = stripslashes($email);
      $phone = stripslashes($phone);
      $address = stripslashes($address);
      $pass = stripslashes($pass);


      $user = mysqli_real_escape_string($conn, $user);
      $email = mysqli_real_escape_string($conn, $email);
      $phone = mysqli_real_escape_string($conn, $phone);
      $address = mysqli_real_escape_string($conn, $address);
      $pass = mysqli_real_escape_string($conn, $pass);
      $basketid = uniqid();

    $sql_u = "SELECT username FROM customers WHERE username='$user'";
    $sql_e = "SELECT email FROM customers WHERE email='$email'";
    $result_u = $conn->query($sql_u);
    $result_e = $conn->query($sql_e);

    if ($result_u->num_rows > 0) {
        echo "<br/><br/><br/><div style='text-align:center' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span>"."Username Already Taken"."</div>";
    }
    else if ($result_e->num_rows > 0) {
        echo "<br/><br/><br/><div style='text-align:center' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span>"."You are already registered, Please Login"."</div>";
    }
    else
    {
        $sql = "INSERT INTO customers (username, password, address, phone, email) VALUES ('$user', '$pass', '$address', '$phone', '$email')";
        $result = $conn->query($sql);
        $sql1 = "INSERT INTO shoppingbasket (basketID, username) VALUES('$basketid', '$user')";
        $result1 = $conn->query($sql1);
        if($result && $result1)
        {
            header("Location: login.php");
            exit;
        }
        else {
          echo "0 results";
        }
    }
    $conn->close();
  }
?>
  
<div class="container">
<form class="register card" onsubmit="return checkall();" name="register" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>
    <legend class="rg_legend">Register</legend>
    <div class="row reg">
  <div class="imgcontainer col-md-4">
    <img src="images/register_avatar.png" alt="Avatar" class="avatar">
  </div>
  <div class="container  col-md-8">
  <div class="alert alert-info" role="alert" style="padding: 3px; text-align: center">All Fields are Mandatory</div>
    <label><b>Username</b></label>&nbsp;&nbsp;&nbsp;<span id="name_err"></span><br/>
    <input type="text" placeholder="Enter Username" name="uname" id="uname" onblur="checkname();">
<br/>
    <label><b>Password</b></label>&nbsp;&nbsp;&nbsp;<span id="pass_err"></span><br/>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" onblur="checkpass();">
<br/>
    <label><b>Confirm Password</b></label>&nbsp;&nbsp;&nbsp;<span id="pass2_err"></span><br/>
    <input type="password" placeholder="Re-enter Password" name="psw_match" id="psw_match" onblur="checkpass2();">
<br/>
    <label><b>Email </b></label>&nbsp;&nbsp;&nbsp;<span id="email_err"></span><br/>
    <input type="email" placeholder="Enter Email" name="email" id="email" onblur="checkemail();">
<br/>
    <label><b>Mobile Number</b>&nbsp;&nbsp;&nbsp;<span id="phone_err"></span></label><br/>
    <input type="text" placeholder="Enter Mobile Number" name="phone" id="phone" onblur="checkphone();">
<br/>
    <label><b>Address</b></label>&nbsp;&nbsp;&nbsp;<span id="add_err"></span><br/>
    <textarea rows="3" cols="40" placeholder="Enter Your Complete Address" name="add" id="add" onblur="checkadd();"></textarea>
<br/>       
    <a href="login.php"><input type="button" name="login" class="lgn_btn1" value="Exsisting User?"></a>
    <button type="submit" class="rgn_btn1" name="register" style="vertical-align:middle"><span>Register</span></button>
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
