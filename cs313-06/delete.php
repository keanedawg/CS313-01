<?php
session_start();
require('dbConnect.php');
$myDb = get_db();

if (!isset($_SESSION["username"])) {
    header("Location: main.php");
    exit();
}

if (isset($_SESSION["house"])) {
    $stmt = $myDb->prepare("DELETE FROM houses WHERE id = :theid ;");
}
else if (isset($_SESSION["house_review"])) {
    $stmt = $myDb->prepare("DELETE FROM house_reviews WHERE id = :theid ;");
}
else if (isset($_SESSION["employee"])) {
    $stmt = $myDb->prepare("DELETE FROM employee WHERE id = :theid ;");
}
else if (isset($_SESSION["employee_review"])) {
    $stmt = $myDb->prepare("DELETE FROM employee_review WHERE id = :theid ;");
}


?>