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
        <h1>Create a new employee</h1>
        <form action="./submitEmployee.php" method="POST">
            Name: <input required type="text" name="name"> 
            <br>
            Select House:
            <select required name="houseid">
                <?php
                    foreach ($complexes as $complex) {
                        $complexId = $complex["id"];
                        $complexName = $complex["name"];
                        echo "<option value=$complexId>$complexName</option>";
                    }
                ?>
            </select> 
            <br>
            <input class="submit-review" type="submit" value="Create Employee!">
        </form>
    </div>
    </div>
</body>
</html>