<?php
require('dbConnect.php');
$myDb = get_db();


$houseId = $_GET["house"];

$stmt = $myDb->prepare("SELECT * FROM houses WHERE id = :theid ;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$house = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $myDb->prepare("SELECT * FROM house_reviews WHERE house_id = :theid ;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $myDb->prepare("SELECT * FROM employees
LEFT JOIN (SELECT employee_id, trunc(avg( score ), 1) FROM employee_reviews GROUP BY employee_id) AS foo
ON employees.id = foo.employee_id WHERE employees.house_id = :theid;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $house["name"]; ?></title>
    <link rel="stylesheet" href="basic.css">
</head>
<body>

<?php 
    require 'header.php';
    require 'sidebar.php';
?>

<div class="main">
<h2 class="house-main-title"><?php echo $house["name"]; ?></h2>
<img src="<?php echo $house["picture"]; ?>">
<p><?php echo $house["address"]; ?></p>
<h3>Employee Reviews</h3>
<ul>
<?php
    if (empty($employees)) {
        echo "<p>No Employee Reviews Currently :(</p>";
    }
    foreach ($employees as $employee)
    {
        $name = $employee["name"];
        $avg = $employee["trunc"];
        echo "<li>$name - ";
        if (empty($employee["trunc"])) {
            echo "N/A</li>";
        }
        else {
            echo "$avg</li>";
        }
    }
?>
</ul>

<h3>House Reviews:</h3>
	<ul>
    <?php
    if (empty($reviews)) {
        echo "<p>No House Reviews Currently :(</p>";
    }
    else {
        echo "<hr size=2>";
    }
    foreach ($reviews as $review)
    {
        $score = $review["score"];
        $commentary = $review["commentary"];
        $recommended = $review["recommended"];
        echo "<p>Anon gave it a <b>$score</b> and ";
        echo "would";
        if ($recommended) {
            echo " <b>recommend</b>";
        }
        else {
            echo " <b>not recommend</b>";
        }
        echo " it to a friend.</p>";
        
        echo "<h3>Anon says: </h3>";
        echo "<p>$commentary</p>";
        echo "<hr size=2>";
    }
        echo "<a href=\"writereview.php?house=$houseId\"><div class=\"rate-house-button\">Rate It!</div></a>";
    ?>
    </ul>
</div>
</main>
</body>
</html>
