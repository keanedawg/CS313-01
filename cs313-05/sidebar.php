<?php
$stmt = $myDb->prepare('SELECT name, address, id FROM houses');
$stmt->execute();
$houses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="left">
	<ul>
    <?php
    foreach ($houses as $house)
    {
        $name = $house["name"];
        $address = $house["address"];
        echo "<li><p>$name</p></li>";
        echo "<li><p>$address</p></li>";
    }
    ?>
	</ul>
</div>

