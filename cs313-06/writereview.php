<?php
require('dbConnect.php');
$myDb = get_db();

$houseId = $_GET["house"];

$stmt = $myDb->prepare("SELECT name, id FROM houses WHERE id = :theid ;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$house = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $myDb->prepare("SELECT name, id FROM employees WHERE house_id = :theid;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rate My Housing</title>
    <link rel="stylesheet" href="basic.css">
</head>
<body>
    <?php 
        require 'header.php';
        require 'sidebar.php';
    ?>
    <div class="main">
        <?php 
            // It's easier to handle the separate cases if I break my code this way
            if (empty($houseId)) {
                require "writereview/empty.php";
            }
            else {
                require "writereview/selected.php";
            }
        ?>
    </div>
</body>
</html>

