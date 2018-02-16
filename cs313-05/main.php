<?php
session_start();

$dbUrl = getenv('DATABASE_URL');
$message = "";
$db = Null;


if (empty($dbUrl)) {
	try
	{
		$host = "localhost";
		$user = 'viewer';
		$password = '123456';
		$db = new PDO('pgsql:host=localhost;dbname=password', $user, $password);
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch (PDOException $ex)
	{
	  echo 'Error!: ' . $ex->getMessage();
	  die();
	}
	$message = "connected to local DB!";
}
else{

	$dbopts = parse_url($dbUrl);

	$dbHost = $dbopts["host"];
	$dbPort = $dbopts["port"];
	$dbUser = $dbopts["user"];
	$dbPassword = $dbopts["pass"];
	$dbName = ltrim($dbopts["path"],'/');

	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
	$message = "successfully connected on heroku!";
}
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
?>


<h1>Rate My Housing</h1>
<i>The best way to find good housing</i>