<?php
require('dbConnect.php');
$myDb = get_db();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rate My Housing</title>
    <link rel="stylesheet" href="basic.css">
</head>
<body>

<?php require 'header.php'; ?>
<?php require 'sidebar.php'; ?>

<div class="main"> 
    <h1>Welcome, click on any of the houses to get started!</h1>
    <a href="writereview.php"><u>Click Here to write your own review!<u></a>
</div>
</body>
</html>

