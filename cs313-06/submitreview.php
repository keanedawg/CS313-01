<?php
    require('dbConnect.php');
    $myDb = get_db();

    $houseId = $_POST["houseid"];

    // Just in case no houseid is put in.
    if (empty($houseId)) {
        header("Location:house.php");
        exit;
    }

    /* get house review parameters (all required) */
    $score = $_POST["score"];
    $recommended = $_POST["recommended"];
    $commentary = $_POST["commentary"];



    // This is maybe a bit hackish. I'm using a query to find the employee POST parameters
    $stmt = $myDb->prepare("SELECT name, id FROM employees WHERE house_id = :theid;");
    $stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo $houseId;
    // echo "<br>$score<br>$recommended<br>$commentary";

    // Set up house insert
    $stmt = $myDb->prepare("INSERT INTO house_reviews (score, recommended, commentary, house_id) 
                            VALUES (:score, :recommended, :commentary, :theid)");
    $stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
    $stmt->bindValue(':score', $score, PDO::PARAM_INT);
    $stmt->bindValue(':recommended', $recommended, PDO::PARAM_BOOL);
    $stmt->bindValue(':commentary', $commentary, PDO::PARAM_STR);
    $stmt->execute();


    header("Location:house.php?house=$houseId");
    exit;
?>