<?php
session_start();
require('dbConnect.php');
$myDb = get_db();


$houseId = $_GET["house"];

$stmt = $myDb->prepare("select * from houses where id = :theid ;");
$stmt->execute();
$house = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $myDb->prepare("select * from house_reviews WHERE house_id = :theid ;");
$stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
$stmt->execute();
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $house["name"]; ?></title>
</head>
<body>
<h1>Rate My Housing</h1>
<i>The best way to find good housing</i><br>
<h2><?php echo $house; ?></h2>

<a href="main.php">go back</a> 

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
