<?php
require('dbConnect.php');
$myDb = get_db();

$houseId = $_GET["house"];

$stmt = $myDb->prepare("SELECT name, picture, address FROM houses WHERE id = :theid ;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$house = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Rate My Housing</title>
    <link rel="stylesheet" href="basic.css">
</head>
<body>
    <div class="block-top"></div>
    <?php require 'header.php'; ?>
    <div class="display-columns">
    <?php require 'sidebar.php';?>
    <div class="main">
        <h1>Edit  house</h1>
        <form action="./submitHouse.php" method="post">
            <?php
                echo "Name: <input required value= type=\"text\" name=\"name\">
                    <br>
                    Address: <input required value= type=\"text\" name=\"address\">
                    <br>
                    Picture Address (optional): <input value= type=\"text\" name=\"picture\"> 
                    <br>
                    <br>";
            ?>
            <input class="submit-review" type="submit" value="Submit Revision">
        </form>
    </div>
    </div>
</body>
</html>