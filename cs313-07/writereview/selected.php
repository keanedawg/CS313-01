<h1>Rate your experience at <?php echo $house["name"]; ?></h1>
<form id="review" action="./submitreview.php" method="POST">
    Would you recommend it? <br>
    <span class="yes">yes</span> <input required value=true name="recommended" type="radio">
    <span class="no">no</span>  <input value=false name="recommended" type="radio">
    
    <br>
    How would you rate it overall (choose 1 - 5)?<input required name="score" type="text"><br>   
    <input required type="hidden" name="houseid" value="<?php echo $house["id"]; ?>">
    <p>Please explain your rating: </p>
    <textarea required name="commentary" form="review"></textarea>
    
    
    <?php
        echo '<h2>(Optional) How would you rate their staff?</h2>';
        if (!empty($employees)) { 
            foreach ($employees as $employee)
            {
                $name = $employee["name"];
                $id = $employee["id"];
                echo "<input type=\"hidden\" name=\"emp[]\" value=\"$id\">";
                echo "$name (choose 1 - 5): <input name=\"rating[]\ type=\"text\"><br>";
            }
        }
        else {
            echo 'There are no employees created for this house. You can make one  
                  <a class="createemployee" href="createemployee.php" target="_blank">here.</a><br>';
        }
    ?>   
    <input class="submit-review" type="submit" value="Submit">
</form>