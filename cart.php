<?php 

session_start();
$connect = mysqli_connect("127.0.0.1", "root", "", "website");
 
if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
		$count = count($_SESSION["shopping_cart"]);
		$item_array = array(
		'item_id'		=>	$_GET["id"],
		'item_name'		=>	$_POST["hidden_name"],
		'item_price'		=>	$_POST["hidden_price"],
		'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
		echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
		'item_id'		=>	$_GET["id"],
		'item_name'		=>	$_POST["hidden_name"],
		'item_price'		=>	$_POST["hidden_price"],
		'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}
 
if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
		if($values["item_id"] == $_GET["id"])
		{
		unset($_SESSION["shopping_cart"][$keys]);
		echo '<script>alert("Item Removed")</script>';
		echo '<script>window.location="cart.php"</script>';
		}
		}
	}
}
 
?>
<!DOCTYPE html>
<html>
	<head>
        <title>Simplistic Threads</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <link href="style.css" rel="stylesheet">
    </head>
    
    <header>
        <img src="pictures/pink-lonely-chair-website-header-design2.jpg" width="100%" height="300px">
        </header>
	<body>
		<br />
		<div class="container2">
		<br />
		<br />
		<br />
		<h1 align="center">Shop Furniture</a></h1><br />
		<br /><br />
		<?php
		$query = "SELECT * FROM products ORDER BY id ASC";
		$result = mysqli_query($connect, $query);
		if(mysqli_num_rows($result) > 0)
		{
		while($row = mysqli_fetch_array($result))
		{
		?>

		
		<div class="row row-cols-1 row-cols-md-2 g-4">
  		<div class="col">
		<form method="post" action="cart.php?action=add&id=<?php echo $row["id"]; ?>">
		<div style="border:1px solid black; margin:15px; padding:16px; align:canter;" align="center">
		<img src="pictures/<?php echo $row["images"]; ?>" class="img-responsive" /><br />
 
		<h4 class="text-info"><?php echo $row["title"]; ?></h4>
 
		<h4 class="text-danger">R <?php echo $row["price"]; ?></h4>
 
		<input type="text" name="quantity" value="1" class="form-control" />
 
		<input type="hidden" name="hidden_name" value="<?php echo $row["title"]; ?>" />
 
		<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
 
		<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
 		
		</div>
		</form>
		</div>
	</div>
		<?php
		}
		}
		?>
		<div style="clear:both;"></div>
		<br />
		<h1 align="center">Order Details</h1>
		
		<table class="table table-bordered">
		<tr>
		<th width="35%">Item Name</th>
		<th width="10%">Quantity</th>
		<th width="20%">Price</th>
		<th width="15%">Total</th>
		<th width="5%">Action</th>
		</tr>
		<?php
		if(!empty($_SESSION["shopping_cart"]))
		{
		$total = 0;
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
		?>
		<tr>
		<td><?php echo $values["item_name"]; ?></td>
		<td><?php echo $values["item_quantity"]; ?></td>
		<td>R <?php echo $values["item_price"]; ?></td>
		<td>R <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
		<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
		</tr>
		<?php
		$total = $total + ($values["item_quantity"] * $values["item_price"]);
		}
		?>
		<tr>
		<td colspan="3" align="right">Total</td>
		<td align="right">R <?php echo number_format($total, 2); ?></td>
		<td></td>
		</tr>
		<?php
		}
		?>
		
		</table>
		<center>

		<a class="btn btn-primary" href="billing.php" role="button">Check out</a>
	</center>
		
		</div>
	</div>
	<br />
	</body>
</html>
