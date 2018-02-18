<?php
$stmt = $myDb->prepare('SELECT name, address, id FROM houses');
$stmt->execute();
$complexes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="left">
	<ul>
    <?php
    foreach ($complexes as $complex)
    {
        $name = $complex["name"];
        $address = $complex["address"];
        echo "<li><p>$name</p></li>";
        echo "<li><p>$address</p></li>";
    }
    ?>
	</ul>
</div>

