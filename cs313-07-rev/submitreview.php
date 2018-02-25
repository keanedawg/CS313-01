<?php
    require('dbConnect.php');
    $myDb = get_db();

    $houseId = $_POST["houseid"];


    var_dump($_POST);

    // Just in case no houseid is put in.
    if (empty($houseId)) {
        header("Location:house.php");
        exit;
    }

    /* get house review parameters (all required) */
    $score = $_POST["score"];
    $recommended = $_POST["recommended"];
    $commentary = $_POST["commentary"];
    

    // Begin Transaction
    $myDb->beginTransaction ();
    try {
        $stmt = $myDb->prepare("INSERT INTO house_reviews (score, recommended, commentary, house_id) 
                            VALUES (:score, :recommended, :commentary, :theid)");
        $stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
        $stmt->bindValue(':score', $score, PDO::PARAM_INT);
        $stmt->bindValue(':recommended', $recommended, PDO::PARAM_BOOL);
        $stmt->bindValue(':commentary', $commentary, PDO::PARAM_STR);
        $stmt->execute();

        $stmt = $myDb->prepare("INSERT INTO employee_reviews (score, employee_id) VALUES (:rating, :empid)");
        foreach ($_POST["emp"] as $index=>$empId) {
            $rating = $_POST["rating"][$index];
            if (empty($rating)) {
                continue;
            }
            $stmt->bindValue(':rating', $rating, PDO::PARAM_INT);
            $stmt->bindValue(':empid', $empId, PDO::PARAM_INT);
            $stmt->execute();
        }
        $myDb->commit();
    }
    catch (PDOException $e) {
        $myDb->rollBack();
    }

    header("Location:house.php?house=$houseId");
    exit;
?>