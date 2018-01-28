<?php
   session_start();
?>

<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (isset($_SESSION['myproducts'])) {
    $_SESSION['myproducts'][] = $_GET['product'];
}
else {
    $_SESSION['myproducts'] = array();
    $_SESSION['myproducts'][] = $_GET['product'];
}

print_r($_SESSION['myproducts']);

// Useful for debugging
// session_destroy();

header("Location: http://localhost/cs313-02/browse.php");
die();
?>