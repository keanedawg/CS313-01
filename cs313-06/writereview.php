<?php
require('dbConnect.php');
$myDb = get_db();

$houseId = $_GET["house"];

$stmt = $myDb->prepare("SELECT name, id FROM houses WHERE id = :theid ;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$house = $stmt->fetch(PDO::FETCH_ASSOC);


$stmt = $myDb->prepare("SELECT * FROM employees WHERE house_id = :theid;");
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
    <h1>foo</h1>
        <form>
            Would you recommend it?<input type="checkbox"><br>
            How would you rate it overall?<input type="text"><br>
        </form>
    </div>
</body>
</html>

