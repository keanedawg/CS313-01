<?php
    require('dbConnect.php');
    $myDb = get_db();

    $houseId = $_POST["houseid"];

    // This is maybe a bit hackish. I'm using a query to find employee POST parameters
    $stmt = $myDb->prepare("SELECT name, id FROM employees WHERE house_id = :theid;");
    $stmt->bindValue(':theid', $houseId, PDO::PARAM_INT);
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo $houseId;

?>