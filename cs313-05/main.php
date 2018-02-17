<?php
session_start();
require('dbConnect.php');
$myDb = get_db();


// $movieId = $_GET["movieId"];
// $stmt->bindValue(':theid', $movieId, PDO::PARAM_INT);

$stmt = $myDb->prepare('SELECT * FROM houses');
$stmt->execute();
$houses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html>
<head>
	<title>Rate My Housing</title>
</head>
<body>
<h1>Rate My Housing</h1>
<i>The best way to find good housing</i>
	<ul>
    <?php
    foreach ($houses as $house)
    {
        $name = $house["name"];
        echo "<li><p>$name</p></li>";
    }
    ?>
	</ul>
</body>
</html>

