<?php
session_start();
require('dbConnect.php');
$myDb = get_db();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$stmt = $myDb->prepare("SELECT id, name FROM employees;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $myDb->prepare("SELECT id, house_id, commentary FROM house_reviews;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$hreviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $myDb->prepare("SELECT * FROM employee_reviews;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$ereviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <form action="delete.php" method="GET">
            <select name="house">
                <?php
                    foreach ($complexes as $complex) {
                        $complexId = $complex["id"];
                        $complexName = $complex["name"];
                        echo "<option value=$complexId>$complexName</option>";
                    }
                ?>
            </select><br>
            <input class="submit-delete" type="submit" value="Delete">
        </form>
        <hr>
        <h3>Delete House Review</h3>
        <form action="delete.php" method="GET">
            houseid - commentary
            <select name="house_review">
                <?php
                    foreach($hreviews as $hreview) {
                        $rId = $hreview["id"];
                        $rHid = $hreview["house_id"];
                        $rCommentary = $hreview["commentary"];
                        echo "<option value=$rId>$rHid - $rCommentary</option>";
                    }
                ?>
            </select><br>
            <input class="submit-delete" type="submit" value="Delete">
        </form>
        <hr>
        <h3>Delete Employee</h3>
        <form action="delete.php" method="GET"> 
            Name
            <select name="employee">
                <?php
                    foreach($employees as $employee) {
                        $empId = $employee["id"];
                        $empName = $employee["name"];
                        echo "<option value=$empId>$empName</option>";
                    }
                ?>
            </select><br>
            <input class="submit-delete" type="submit" value="Delete">
        </form>
        <hr>
        <h3>Delete Employee Review</h3>
        <form action="delete.php" method="GET">
            employeeId - Review Score
            <select name="employee_review">
                <?php
                    foreach($ereviews as $ereview) {
                        $erevId = $ereview["id"];
                        $erevEmpId = $ereview["employee_id"];
                        $erevScore = $ereview["score"];
                        echo "<option value=$erevId>$erevEmpId - $erevScore</option>";
                    }
                ?>
            </select><br>
            <input class="submit-delete" type="submit" value="Delete">
        </form>
    </div>
</body>
</html>