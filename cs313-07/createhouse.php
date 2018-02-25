<?php
require('dbConnect.php');
$myDb = get_db();
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
        <h1>Create a new house</h1>
        <form action="./submitHouse.php" method="post">
            Name: <input required type="text" name="name">
            <br>
            Address: <input required type="text" name="address">
            <br>
            Picture Address (optional): <input type="text" name="picture"> 
            <br>
            <br>
            <input class="submit-review" type="submit" value="Create House!">
        </form>
    </div>
    </div>
</body>
</html>