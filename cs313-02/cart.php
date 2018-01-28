<?php
    // Start the session
    session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Refresh: 5");
    include('header.php');
?>

<h1>Cart</h1>

<?php
  if (count($_SESSION['myproducts']) == 0) {
      echo "<p>Your cart is empty</p>";
  }  
  else {
      echo "<p>You have:</p>";
      foreach ($_SESSION['myproducts'] as $value) {
          echo "<div class=\"product\">
                <h3>$value</h3>
                </div>";
      }
  }
?>



<a href="browse.php">Browse</a>
<a href="checkout.php">Checkout</a>

<?php
   include('footer.php')
?>