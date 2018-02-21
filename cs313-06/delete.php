<?php
session_start();
require('dbConnect.php');
$myDb = get_db();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION["house"])) {
    $stmt = $myDb->prepare("DELETE FROM houses WHERE id = :theid ;");
    $id = $_SESSION["house"];
}
else if (isset($_SESSION["house_review"])) {
    $stmt = $myDb->prepare("DELETE FROM house_reviews WHERE id = :theid ;");
    $id = $_SESSION["house_review"];
}
else if (isset($_SESSION["employee"])) {
    $stmt = $myDb->prepare("DELETE FROM employee WHERE id = :theid ;");
    $id = $_SESSION["employee"];
}
else if (isset($_SESSION["employee_review"])) {
    $stmt = $myDb->prepare("DELETE FROM employee_review WHERE id = :theid ;");
    $id = $_SESSION["employee_review"];
}
else {
    header("Location:adminHousing.php");
    exit(); 
}
$stmt->bindValue(':theid', $id, PDO::PARAM_INT);
$stmt->execute();


header("Location:adminHousing.php");
exit();
?>