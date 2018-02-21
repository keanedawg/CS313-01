<!-- Not actually used, just a template for creating new pages -->

<?php
require('dbConnect.php');
$myDb = get_db();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" href="basic.css">
</head>
<body>
    <?php 
        require 'header.php';
        require 'sidebar.php';
    ?>
    <div class="main">
        <h1>Login</h1>
        <form action="./submitLogin.php" method="POST">
            User: <input required type="text" name="name"> 
            <br>
            Password:
            <input required type="password" name="password">  
            <br>
            <input class="submit-review" type="submit" value="Login">
        </form>
    </div>
</body>
</html>