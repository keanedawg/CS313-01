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
    <h1>Rate your experience at <?php echo $house["name"]; ?></h1>
        <form id="review" action="./submitreview.php" method="POST">
            Would you recommend it?<input name="recommended" type="checkbox"><br>
            How would you rate it overall?<input name="score" type="text"><br>   
            <input type="hidden" name="houseid" value="<?php echo $house["id"]; ?>">
            <p>Please explain your rating: </p>
            <textarea name="commentary" form="review"></textarea>
            <h2>(Optional) How would you rate their staff?</h2>
            <?php
                foreach ($employees as $employee)
                {
                    $name = $employee["name"];
                    $id = $employee["id"];
                    echo "$name : <input name=\"emp$id\" type=\"text\"><br>";
                }
            ?>   
            <input class="submit-review" type="submit" value="Submit">
        </form>
    </div>
</body>
</html>

