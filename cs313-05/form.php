<?php
session_start();

$dbUrl = getenv('DATABASE_URL');
$message = "";
$db = Null;


if (empty($dbUrl)) {
	try
	{
		$host = "localhost";
		$user = 'web_user';
		$password = 'fake-password';
		$db = new PDO('pgsql:host=localhost;dbname=scripture', $user, $password);
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

<form id="scriptures" action="results.php" method="post">
  Book <input type="text" name="book"> <br>
  Chapter <input type="text" name="chapter"> <br>
  Verse <input type="text" name="verse"> <br>
  <textarea name="content" form="scriptures">Enter text here...</textarea>
  <?php
  try{
		$statement = $db->prepare('SELECT TOPIC_NAME FROM TOPICS');
		$statement->execute();
		while ($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
		  echo '<input type="checkbox" form="scriptures" name="topic[]" value="'. $row['topic_name'] . '">'.$row['topic_name'];
		}
	}catch (PDOException $ex)
	{
	  echo 'Error!: ' . $ex->getMessage();
	  die();
	}
  ?>
  <input type="submit">
</form>



