<?php
$stmt = $myDb->prepare('SELECT
                            h.id, h.name,
                            r.avg_score
                        FROM houses h
                        LEFT JOIN (
                            SELECT house_id, trunc(avg(score), 1) avg_score
                            FROM house_reviews 
                            GROUP BY house_id
                        ) AS r
                        ON h.id = r.house_id;');
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
        $score = $complex["avg_score"];
        echo "<p class=\"house-row-title\">$name</p>";
        echo "<p class=\"house-row-address\">$score</p>";
        echo "</div></a>";
    }
    ?>
</div>

