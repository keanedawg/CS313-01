<?php
    // Start the session
    session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    include('header.php');
?>
<h1>Useless Junk</h1>
<h6>You have <?php echo count($_SESSION['myproducts']); ?> item(s) in your cart</h6>
<a href="cart.php">See Cart</a>
<a href="checkout.php">Checkout</a>

<br>
<br>
<br>

<form action="browse.php" method="get">
    Search: <input type="text" name="search" value="<?php echo $_GET["search"] ?>">
    <input type="submit" value="Search!">
</form>

<?php
  for ($x = 0; $x < $productCount; $x++) {
    $found = strpos(strtolower($products[$x]), strtolower($_GET["search"]));
    if (!isset($_GET["search"]) || empty($_GET["search"]) || $found !== false ) {
        echo '<div class="product">
        <h2>' . ucfirst($products[$x]) . '</h2>
        <h3> $' . number_format($prices[$x], 2) . '</h3>
        <form action="addToCart.php" method="get">
        <input type="hidden" name="product" value="' . $products[$x] . '"></input>
        <input type="submit" value="add to cart"></input>
        </form>
        </div>';
    }
  }
?>

<?php
   include('footer.php')
?>