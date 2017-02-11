<?php
require_once("includes/config.php");
//now we can use our config file
include(ROOT_PATH . "includes/footer.php");

session_start();
if (!isset($_SESSION["user"]))
  header("Location: login.php");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cheapbook";
    $user = $_SESSION["user"];
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } 
    $conn->set_charset("utf8");//for special characters present in DB
    if(isset($_SESSION["shopping_cart"]))
      $count= count($_SESSION["shopping_cart"]);
     else $count=0;
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
     
     <script src="<?php echo BASE_URL; ?>assets/bootstrap/js/bootstrap.min.js"></script>


      <link href="<?php echo BASE_URL; ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
     
      <link href="<?php echo BASE_URL; ?>assets/css/style.css" rel="stylesheet" type="text/css">
      <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>images/icon.png">
      <title>Cheap Books</title>

    </head>
    <body>
      <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
          <a class="navbar-brand" href="#">
          <img alt="Brand" src="images/icon.png" class="logo">
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <h1 id="setleft" class="text-muted ">Welcome to CheapBooks, <?php echo ucfirst($_SESSION["user"]); ?></h1>
        <div class="navbar-right">
          <a href="bookstore.php" class="btn btn-md btn-success">Continue Shopping</a>
          <input type="button" name="logout" value="Logout" class="btn btn-danger" onclick="window.location='logout.php';">
        </div>
        </ul>
        </div>
      </div>
      </nav>



	<div class="container">
	<div class="panel panel-info table-responsive">
		<div class="page-header">
		<h1>Shopping Basket</h1>
		</div>
   		<div class="panel-heading">Items you added: </div>
   		<form method="POST">
   		<table class="table">
   			<tr>
   				<th>Book Title</th>
   				<th>Book ISBN</th>
   				<th>Price</th>
   				<th>Quantity</th>
   			</tr>
   			<?php

if(!empty($_SESSION["shopping_cart"]))
{
	$total=0;
	
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
	 	$total= $total+ $values["item_price"];
		
		?>
	
<tr>
<td><?php echo $values['item_title']?></td>
<td><?php echo $values['item_isbn'] ?></td>
<td><?php echo $values["item_price"] ?></td>
<td><?php echo $values["item_quantity"] ?></td>
</tr>
<?php
	}
	?>
		</table>
		<div class="panel-body"><span id="price">Toatal Price: <?php  echo number_format($total,2);?></span><button name="btnCheckOut" id="btn_rgt" type="submit">Buy Now</button></div>
   		</form>
	</div>
<?php 
$basketid="";
if(isset($_POST['btnCheckOut'])){
    if(!empty($_SESSION['shopping_cart'])){
        
        $basketid= uniqid();
        $basketId_sql = "INSERT into shoppingbasket(basketID, username) VALUES ('".$basketid."','".$_SESSION['user']."')";
        $result_sql = $conn->query($basketId_sql);


        foreach ($_SESSION['shopping_cart'] as $keys => $values) {
            # code...
            $sqlbasketid = "SELECT * FROM shoppingbasket WHERE username = '".$_SESSION['user']."'";
            $resultbasketid = $conn->query($sqlbasketid);
            while($rowbasketid = $resultbasketid->fetch_assoc()){
                $_SESSION['basketID'] = $rowbasketid['basketID'];
            }

            $sqlstock = "SELECT * FROM `stocks` WHERE isbn LIKE '".$values['item_isbn']."'";
            $resultstock = $conn->query($sqlstock);

            while($rowstock=$resultstock->fetch_assoc()){
                if($values['item_quantity']<=$rowstock['number']){

                    //UPdate contains table
                    $sqlcontain = "INSERT into contains VALUES('".$values['item_isbn']."','".$_SESSION['basketID']."','".$values['item_quantity']."')";
                    $resultcontain = $conn->query($sqlcontain);

                    $sqlshippingorder = "INSERT into `shippingorder` VALUES('".$values['item_isbn']."','".$rowstock['warehouseCode']."','".$_SESSION['user']."','".$values['item_quantity']."')";
                    $resultshippingorder = $conn->query($sqlshippingorder);

                    $update_total = $rowstock['number']-$values['item_quantity'];
                    $sqlstockupdate = "UPDATE stocks s SET s.number = '".$update_total."' WHERE s.warehouseCode ='".$rowstock['warehouseCode']."' AND s.isbn = '".$values['item_isbn']."'";
                    $resultstockupdate = $conn->query($sqlstockupdate);
                }
            }
        }
    }    

    $temp =$_SESSION['user'];
    session_unset();

    $_SESSION['user'] = $temp;
    echo "<br/><br/><br/><div style='text-align:center' class='alert alert-success' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span>"."Items will be dilevered, soon"."</div>";        
}
    $conn->close();
    }?> 

</body>