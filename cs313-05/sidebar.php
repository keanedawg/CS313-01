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
        if ($score > 4.0) {
            echo "<p style=\"color:rgb(116, 195, 101)\" class=\"house-row-score\">$score</p>";
        }
        else if ($score > 2.2) {
            echo "<p style=\"color:rgb(239, 204, 0)\" class=\"house-row-score\">$score</p>";
        }
        else if (empty($score)) {
            echo "<p class=\"house-row-empty\">no ratings</p>";
        }
        else {
            echo "<p style=\"color:rgb(132, 27, 45)\" class=\"house-row-score\">$score</p>";
        }
        echo "</div></a>";
    }
    ?>
</div>

