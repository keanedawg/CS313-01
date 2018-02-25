<?php
session_start();
require('dbConnect.php');
$myDb = get_db();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$stmt = $myDb->prepare("SELECT id, name FROM employees;");
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $myDb->prepare("SELECT house_reviews.id, name, house_id, score, commentary FROM house_reviews
INNER JOIN (SELECT id, name FROM houses) AS foo
ON house_reviews.house_id = foo.id;");
$stmt->execute();
$hreviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $myDb->prepare("SELECT name, employee_reviews.id, score, employee_id FROM employee_reviews
INNER JOIN (SELECT id, name FROM employees) AS foo
ON employee_reviews.employee_id = foo.id;");
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
    <div class="block-top"></div>
    <?php require 'header.php'; ?>
    <div class="display-columns">
    <?php require 'sidebar.php';?>
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
            House Reviews
            <select name="house_review">
                <?php
                    foreach($hreviews as $hreview) {
                        $rId = $hreview["id"];
                        $rName = $hreview["name"];
                        $rScore = $hreview["score"];
                        $rCommentary = $hreview["commentary"];
                        echo "<option value=$rId>$rName - $rScore stars - $rCommentary</option>";
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
            Employee Reviews
            <select name="employee_review">
                <?php
                    foreach($ereviews as $ereview) {
                        $erevId = $ereview["id"];
                        $erevScore = $ereview["score"];
                        $erevName = $ereview["name"];
                        echo "<option value=$erevId>$erevName - $erevScore</option>";
                    }
                ?>
            </select><br>
            <input class="submit-delete" type="submit" value="Delete">
        </form>
    </div>
    </div>
</body>
</html>