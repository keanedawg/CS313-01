<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    // Check Radio-box
    $(".rating input:radio").attr("checked", false);

    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });

    $('input:radio').change(
      function(){
        var userRating = this.value;
    }); 
});
</script>

<h1>Rate your experience at <?php echo $house["name"]; ?></h1>
<form id="review" action="./submitreview.php" method="POST">
    Would you recommend it? <br>
    <span class="yes">yes</span> <input required value=true name="recommended" type="radio">
    <span class="no">no</span>  <input value=false name="recommended" type="radio">
    
    <br>
    How would you rate it overall?<input required name="score" type="text">
    <div class="rating">
        <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label></span>
        <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
        <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
        <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
        <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
    </div>  
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