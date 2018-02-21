<?php
session_start();
require('dbConnect.php');
$myDb = get_db();

if (!isset($_SESSION["username"])) {
    header("Location: main.php");
    exit();
}

$stmt = $myDb->prepare("SELECT id, name FROM employees;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $myDb->prepare("SELECT id, name FROM employees;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome <?php echo $_SESSION["username"];?></title>
    <link rel="stylesheet" href="basic.css">
</head>
<body>
    <?php 
        require 'header.php';
        require 'sidebar.php';
    ?>
    <div class="main">
        <h1>Welcome <?php echo $_SESSION["username"];?></h1>
        <h3>Delete House</h3>
        <form>
            <select name="house">
                <?php
                    foreach($complexes as $complex) {
                        $complexId = $complex["id"];
                        $complexName = $complex["name"];
                        echo "<option value=$complexId>$complexName</option>";
                    }
                ?>
            </select><br>
            <input class="submit-delete" type="submit" value="Delete">
        </form>
        <hr>
        <form>
            <select name="employee_review">
                <?php
                    foreach($complexes as $complex) {
                        $complexId = $complex["id"];
                        $complexName = $complex["name"];
                        echo "<option value=$complexId>$complexName</option>";
                    }
                ?>
            </select><br>
            <input class="submit-delete" type="submit" value="Delete">
        </form>
        <hr>
        <form>
            <select name="employee">
                <?php
                    foreach($complexes as $complex) {
                        $complexId = $complex["id"];
                        $complexName = $complex["name"];
                        echo "<option value=$complexId>$complexName</option>";
                    }
                ?>
            </select><br>
            <input class="submit-delete" type="submit" value="Delete">
        </form>
        <hr>
    </div>
</body>
</html>