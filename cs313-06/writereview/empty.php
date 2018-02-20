<h1>Select an apartment to rate</h1>
<form action="./writereview.php" method="get">
    <select required name="house">
        <?php
            foreach ($complexes as $complex) {
                $complexId = $complex["id"];
                $complexName = $complex["name"];
                echo "<option value=$complexId>$complexName</option>";
            }
        ?>
    </select> 
    <br>
    <input class="submit-review" type="submit" value="Review it">
</form>