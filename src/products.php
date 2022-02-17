<?php
session_start();
if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = array();
}
require("config.php");

$amt = 0;
foreach ($_SESSION["cart"] as $prod) {
	foreach ($products as $key => $val) {
		if ($products[$key]["id"] == $prod["id"]) {
			$product = $products[$key];
			break;
		}
	}
	$amt += ($product["price"] * $prod["quantity"]);
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>
		Products
	</title>
	<link href="css/style.css" type="text/css" rel="stylesheet">
</head>

<body>
	<?php include "header.php"; ?>
	<div id="main">
		<div id="products">
			<?php foreach ($products as $prod) { ?>
				<div id="<?php echo $prod["id"]; ?>" class="product">
					<img src="images/<?php echo $prod["image"]; ?>">
					<h3 class="title"><a href="#"><?php echo $prod["name"]; ?></a></h3>
					<span>Price: $<?php echo $prod["price"]; ?></span>
					<a class="add-to-cart" href="addToCart.php?id=<?php echo $prod["id"]; ?>&action=add">Add To Cart</a>
				</div>
			<?php } ?>

		</div>
		<div id="cartList">
			<?php if (count($_SESSION["cart"]) > 0) { ?>
				<h2>Your Cart Items</h2><span id="tamt">Total Amount : $<?php echo $amt; ?></span><a href="addToCart.php?id=&action=empty" id="emptyCart">Empty Cart</a>
				<?php foreach ($_SESSION["cart"] as $prod) {
					foreach ($products as $key => $val) {
						if ($products[$key]["id"] == $prod["id"]) {
							$product = $products[$key];
							break;
						}
					} ?>
					<div id="product-<?php echo $prod["id"]; ?>" class="product">
						<img src="images/<?php echo $product["image"]; ?>">
						<a href="addToCart.php?id=<?php echo $prod["id"]; ?>&action=remove" class="removeBtn" title="Remove">&#10005;</a>
						<h3 class="title"><a href="#"><?php echo $product["name"]; ?></a></h3>
						<span>Price: $<?php echo $product["price"]; ?></span><br>
						<span>
							Quantity : <?php echo $prod["quantity"]; ?>
						</span>
						<br><span>Amount :$<?php echo ($product["price"] * $prod["quantity"]); ?></span>
						<div>
							<form action="updateQuantity.php" method="post">
								<input type="number" name="qty-<?php echo $prod['id']; ?>" id="">
								<input type="hidden" name="Prodid" value="<?php echo $prod['id']; ?>">
								<input type="submit" value="Add" name="submit">
							</form>
						</div>
					</div>
				<?php }
			} else { ?><h2>Empty Cart</h2><?php
									} ?>
		</div>
	</div>
	<?php include "footer.php"; ?>
</body>

</html>