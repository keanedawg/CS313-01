<h1>Rate your experience at <?php echo $house["name"]; ?></h1>
<form id="review" action="./submitreview.php" method="POST">
    Would you recommend it?<input required name="recommended" type="checkbox"><br>
    How would you rate it overall?<input required name="score" type="text"><br>   
    <input required type="hidden" name="houseid" value="<?php echo $house["id"]; ?>">
    <p>Please explain your rating: </p>
    <textarea required name="commentary" form="review"></textarea>
    <h2>(Optional) How would you rate their staff?</h2>
    <?php
        foreach ($employees as $employee)
        {
            $name = $employee["name"];
            $id = $employee["id"];
            echo "$name : <input name=\"emp$id\" type=\"text\"><br>";
        }
    ?>   
    <input class="submit-review" type="submit" value="Submit">
</form>