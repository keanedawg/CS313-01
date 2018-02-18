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
    <link rel="stylesheet" href="basic.css">
</head>
<body>
<?php require 'header.php'; ?>

<div class="main">
    
    <h1>Welcome, click on any of the houses to get started!</h1>
</div>
</body>
</html>

