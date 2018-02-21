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
    <ul>
        <li><a href="writereview.php"><u>Click Here to write your own review!<u></a><br></li>
        <li><a href="createhouse.php"><u>Click Here to add a new house!<u></a><br></li>
        <li><a href="createemployee.php"><u>Click Here to add a new employee!<u></a><br></li>
        <li><a href="adminHousing.php"><u>Click Here to do administrative stuff.<u></a><br></li>
    </ul>
</div>
</body>
</html>

