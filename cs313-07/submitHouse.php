<?php
    require('dbConnect.php');
    $myDb = get_db();

    /* get house review parameters (all required) */
    $name = $_POST["name"];
    $address = $_POST["address"];
    $picture = $_POST["picture"];

    // Just in case no houseid is put in.
    if (empty($name)) {
        header("Location:main.php");
        exit;
    }

    // Set up house insert
    $stmt = $myDb->prepare("INSERT INTO houses (name, address, picture) 
                            VALUES (:housename, :houseaddress, :picture)");
    $stmt->bindValue(':housename', $name, PDO::PARAM_STR);
    $stmt->bindValue(':houseaddress', $address, PDO::PARAM_STR);
    $stmt->bindValue(':picture', $picture, PDO::PARAM_STR);
    $stmt->execute();


    header("Location:main.php");
    exit;
?>