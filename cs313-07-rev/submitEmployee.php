<?php
    require('dbConnect.php');
    $myDb = get_db();

    $name = $_POST["name"];
    $houseid = $_POST["houseid"];

    // Just in case no name is put in.
    if (empty($name)) {
        header("Location:main.php");
        exit;
    }

    // Set up employee insert
    $stmt = $myDb->prepare("INSERT INTO employees (name, house_id) 
                            VALUES (:name, :houseid)");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':houseid', $houseid, PDO::PARAM_INT);
    $stmt->execute();

    header("Location:house.php?house=$houseid");
    exit;
?>