<?php
session_start();
require('dbConnect.php');
$myDb = get_db();


$movieId = $_GET["movieID"];
// $stmt->bindValue(':theid', $movieId, PDO::PARAM_INT);

$stmt = $myDb->prepare('SELECT * FROM house_ratings');
$stmt->execute();
$houses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo "put something in here"; ?></title>
</head>
<body>
<h1>Rate My Housing</h1>
<i>The best way to find good housing</i>
	<ul>
    <?php
    foreach ($houses as $house)
    {
        $name = $house["score"];
        $address = $house["address"];
        $picture = $house["picture"];
        echo "<li><p>$name</p></li>";
        echo "<img src=\"$picture\">";
        echo "<li><p>$address</p></li>";
    }
    ?>
	</ul>
</body>
</html>
