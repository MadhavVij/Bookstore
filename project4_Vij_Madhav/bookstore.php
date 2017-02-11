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
    $isbn="";
    $quantity="";
    if(isset($_GET['quantity'])){
      $quantity=$_GET['quantity'];
    }
    if(isset($_GET['isbn'])){
      $isbn=$_GET['isbn'];
    }
    if($isbn!="" && $quantity!=""){
      $sql1 = "SELECT title, price from book where isbn LIKE '%{$isbn}%'";
      $result1 = $conn->query($sql1);
    
    if((null!=$result1) && ($result1->num_rows > 0)){
        $row1 = $result1->fetch_assoc();
        $row1['price']  = $row1['price']*$quantity;
        if(isset($_SESSION["shopping_cart"]))
            {
              
              $count=count($_SESSION["shopping_cart"]);
              $item_array=array(
                'item_isbn' => $_GET['isbn'],
                'item_title' => $row1['title'],
                'item_price' => $row1['price'],
                'item_quantity' => $_GET['quantity']
              
              );
              $_SESSION["shopping_cart"][$count]=$item_array;
                
              }else
              {
                
                $item_array=array(
                'item_isbn' => $_GET['isbn'],
                'item_title' => $row1['title'],
                'item_price' => $row1['price'],
                'item_quantity' => $_GET['quantity']
                
                );
                $_SESSION["shopping_cart"][0]=$item_array;
              }
}}
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
     <script type="text/javascript" src="assets/js/search.js"></script>

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
          <a href="checkout.php" class="btn btn-md btn-success"><span class="glyphicon glyphicon-shopping-cart">Cart (<?php echo $count;?>)</span></a>
          <input type="button" name="logout" value="Logout" class="btn btn-danger" onclick="window.location='logout.php';">
        </div>
        </ul>
        </div>
      </div>
      </nav>

  	<div class="container" id='search1'>
  	<div class="page-header">
  	<div class="well">
  		<h1>Search Results</h1>
  		<form action="" method="GET" role="form">
  		<center>
  		<div class="form-group has-feedback">
  		<input id="query" name="query" type="search" class="field card" placeholder="Enter Your Search">
  		<span class="glyphicon glyphicon-search form-control-feedback glyph text-muted" aria-hidden="true"></span>
		</div>
		</center>
		<br/><br/>
		<div class="form-group">
    <button id="author" name="author" type="submit" class="btn btn-default" value="author">Search By Author</button>
    <button id="title" name="title" type="submit" class="btn btn-default" value="title" >Search By Book Title</button>
		<br/><br/><br/>
		</div>
  		</form>
  	</div>
  	</div>

  	<?php
  	$query = "";
  	$type = "";
    $isbn="";

  	if(isset($_GET['query'])){

	$query=$_GET['query'];


    if(isset($_GET['author']))
    {
    	$type = "author";
    }

    else if (isset($_GET['title'])) {
    	$type = "title";
    }



    $query = stripslashes($query);
    $query = mysqli_real_escape_string($conn, $query);

  	//query

  	if($query!='' && $type=='author'){
  		$sql= "SELECT book.title as title, book.isbn as isbn, stocks.number as stock FROM book, author, writtenby, stocks WHERE book.isbn = writtenby.isbn AND writtenby.ssn = author.ssn AND stocks.isbn=writtenby.isbn AND author.name like '%{$query}%' AND stocks.number!=0";
  		$result = $conn->query($sql);
  	}

  	else if ($query!='' && $type=='title') {
  		$sql= "SELECT book.title as title, book.isbn as isbn, stocks.number as stock FROM book, stocks WHERE book.isbn=stocks.isbn AND book.title like '%{$query}%' AND stocks.number!=0";
  		$result = $conn->query($sql);
  	}

    
  	//Fetching result

     if (null!=$result &&  $result->num_rows > 0) {
     	?>
    <div class="container">
   	<div class="panel panel-info table-responsive">
   		<div class="panel-heading">Books you are searching...</div>
      <div class="panel-body"><span id="quant_err"></span><br/></div>
   		<table class="table">
   			<tr>
   				<th></th>
   				<th>Book Title</th>
   				<th>Book ISBN</th>
   				<th>Stocks Left</th>
   				<th></th>
   			</tr>
  	
     	<?php
     while($row = $result->fetch_assoc()) {	 
     	?>

   			<tr><form method="GET" action="">
   				<td><span class="glyphicon glyphicon-book"></span></td>
   				<td><?php echo($row["title"])?></td>
   				<td><?php echo($row["isbn"])?></td>
   				<td><?php echo($row["stock"])?></td>
          <td>Quantity: <input type="number" min="1" max="<?php echo($row["stock"])?>" name="quantity" id="<?php echo($row['isbn']); ?>" onblur="checkQuant(<?php echo($row["stock"])?>)"></td>
   				<td><a class="btn btn-info link <?php echo($row['isbn']); ?>" onclick="return func(this,<?php echo($row["stock"])?>)" href="bookstore.php?query=<?php echo $query;?>&<?php echo $type; ?>=<?php echo $type; ?>"><span class="glyphicon glyphicon-shopping-cart">Add To Cart</span></a></td>
   				</form>
   			</tr>
   		</table>
   	</div>

<?php
}}
else{
	echo "<br/><br/><div style='text-align:center' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span>"."&nbsp;&nbsp;&nbsp;Sorry, We do not have any books, you are looking for<br/>Please check back later!</div>";
}
$conn->close();
}
?>
</div>
</div>
</body>
</html>