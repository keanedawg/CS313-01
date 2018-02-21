<?php
session_start();
require('dbConnect.php');
$myDb = get_db();

if (!isset($_SESSION["username"])) {
    header("Location: main.php");
    exit();
}


?>