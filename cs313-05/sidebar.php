<?php
$stmt = $myDb->prepare('SELECT name, address, id FROM houses');
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
        $address = $complex["address"];
        echo "<p class=\"house-row-title\">$name</p>";
        echo "<p class=\"house-row-address\">$address</p>";
        echo "</div></a>";
    }
    ?>
</div>

