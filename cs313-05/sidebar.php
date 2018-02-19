<?php
$stmt = $myDb->prepare('SELECT * FROM houses
LEFT JOIN (SELECT house_id, trunc(avg(score), 1) FROM house_reviews GROUP BY house_id) AS r
ON houses.id = r.house_id;');
$stmt->execute();
$complexes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="left">
    <?php
    foreach ($complexes as $complex)
    {
        $complexID = $complex["id"];
        echo "<a href=\"house.php?house=$complexID\"><div class=\"house-row\">";
        $name = $complex["name"];
        $score = $complex["trunc"];
        echo "<p class=\"house-row-title\">$name</p>";
        echo "<p class=\"house-row-address\">$score</p>";
        echo "</div></a>";
    }
    ?>
</div>

