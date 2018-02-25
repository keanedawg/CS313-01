<?php 
    session_start();
    require('dbConnect.php');
    $myDb = get_db();

    $username = $_POST["name"];
    $password = $_POST["password"];

    try {
        $stmt = $myDb->prepare("SELECT * FROM users WHERE username=:thename;");
        $stmt->bindValue(':thename', $username, PDO::PARAM_STR);
        $stmt->execute();
        $dbuser = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        echo 'EXCEPTION!';
    }


    var_dump($_POST);

    var_dump($dbuser);

    if (password_verify($password, $dbuser["password"])) {
        $_SESSION["userid"] = $dbuser["id"];
        $_SESSION["username"] = $username;
        header("Location: adminHousing.php");
        die();
    }
    else {
        echo "not good";
        // Some sort of error message
    }
?>