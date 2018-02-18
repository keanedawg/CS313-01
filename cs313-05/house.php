<?php
session_start();
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
LEFT JOIN (SELECT employee_id, avg(score) FROM employee_reviews GROUP BY employee_id) AS foo
ON employees.id = foo.employee_id WHERE employees.house_id = 1;");

$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $house["name"]; ?></title>
</head>
<body>
<h1>Rate My Housing</h1>
<i>The best way to find good housing</i><br>


<a href="main.php">go back</a> 
<h2><?php echo $house["name"]; ?></h2>
<img src="<?php echo $house["picture"]; ?>">
<p><?php echo $house["address"]; ?></p>
<p>Employees:</p>
<ul>
<?php
    echo "<hr size=2>";
    foreach ($employees as $employee)
    {
        $name = $employee["name"];
        $avg = $employee["avg"];
        echo "<li>$name - $avg</li>";
    }
?>
</ul>


<h3>Reviews</h3>
	<ul>
    <?php
    echo "<hr size=2>";
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
    ?>
	</ul>
</body>
</html>
