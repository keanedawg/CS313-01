<?php
    // Start the session
    session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    include('header.php');
?>

<!-- Only the address is displayed. It's simpler to handle confusing formatting this way -->
<h1>Thank you!</h1>
<h2>Your order will be shipped to <?php echo htmlspecialchars($_POST["street"]); ?>!</h2>

<?php
    echo "<p>You bought:</p><ul>";
    foreach ($_SESSION['myproducts'] as $value) {
        echo "<li>$value</li>";
    }
    echo "</ul>";
session_destroy(); 
?>

<a href="browse.php">Return to Shopping</a>

<?php
   include('footer.php')
?>