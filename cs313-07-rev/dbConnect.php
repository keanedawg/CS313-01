<?php
function get_db() {
	$dbUrl = getenv('DATABASE_URL');
	if (empty($dbUrl)) {
		$dbUser = "reader_viewer";
		$dbPassword = "123456";
		$dbPort = "5433";
		$dbHost = "localhost";
		$dbName = "house_ratings";
	} else {
		$dbopts = parse_url($dbUrl);
		$dbHost = $dbopts["host"];
		$dbPort = $dbopts["port"];
		$dbUser = $dbopts["user"];
		$dbPassword = $dbopts["pass"];
		$dbName = ltrim($dbopts["path"],'/');
	}
	try {
     $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
	}
	catch (PDOException $ex) {
	 print "<p>error!: $ex->getMessage()  </p>\n\n";
     print var_dump($ex);
     die();
	}
    return $db;
}
?>