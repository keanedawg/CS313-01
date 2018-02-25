<?php
require('dbConnect.php');
$myDb = get_db();

$houseId = $_POST["house"];

$stmt = $myDb->prepare("UPDATE houses SET name = :thename, picture = :thepicture, address = :theaddress WHERE id = :theid ;");
$stmt->bindValue(':theid',        $houseId,          PDO::PARAM_INT);
$stmt->bindValue(':thename',      $_POST["name"],    PDO::PARAM_STR);
$stmt->bindValue(':thepicture',   $_POST["picture"], PDO::PARAM_STR);
$stmt->bindValue(':theaddress',   $_POST["address"], PDO::PARAM_STR);
$stmt->execute();


header("Location:house.php?house=$houseId");
exit;
?>