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
    <?php 
        require 'header.php';
        require 'sidebar.php';
    ?>
    <div class="main">
        <h1>Create a new house</h1>
        <form action="./submitemployee.php" method="get">
            Name: <input required type="text" name="address">
            <br>
            Address: <input required type="text" name="address">
            <br>
            Picture Address: <input required type="text" name="address"> 
            <br>
            <br>
            <input class="submit-review" type="submit" value="Create House!">
        </form>
    </div>
</body>
</html>