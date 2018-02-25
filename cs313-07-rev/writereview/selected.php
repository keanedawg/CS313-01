<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
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
    How would you rate it overall? <br>
    (1 circle = the worst, 5 circles = the best) <br>

    <div class="rating">
        <span><input required type="radio" name="score" id="str5" value="5"><label for="str5"></label></span>
        <span><input required type="radio" name="score" id="str4" value="4"><label for="str4"></label></span>
        <span><input required type="radio" name="score" id="str3" value="3"><label for="str3"></label></span>
        <span><input required type="radio" name="score" id="str2" value="2"><label for="str2"></label></span>
        <span><input required type="radio" name="score" id="str1" value="1"><label for="str1"></label></span>
    </div>  
    
    <br>
    <br>
    <input required type="hidden" name="houseid" value="<?php echo $house["id"]; ?>">
    <p>Please explain your rating: </p>
    <textarea required name="commentary" form="review"></textarea>
    
    
    <?php
        echo '<h4>(Optional) How would you rate their staff?</h4>';
        if (!empty($employees)) { 
            foreach ($employees as $employee)
            {
                $name = $employee["name"];
                $id = $employee["id"];
                echo "$name (choose 1 - 5):";
                echo '<div class="something">
                    <span><input type="radio" name="rating[' . $id . '][]" value="1"></span>
                    <span><input type="radio" name="rating[' . $id . '][]" value="2"></span>
                    <span><input type="radio" name="rating[' . $id . '][]" value="3"></span>
                    <span><input type="radio" name="rating[' . $id . '][]" value="4"></span>
                    <span><input type="radio" name="rating[' . $id . '][]" value="5"></span>
                </div> <br>';
            }
        }
        else {
            echo 'There are no employees created for this house. You can make one  
                  <a class="createemployee" href="createemployee.php" target="_blank">here.</a><br>';
        }
    ?>   
    <input class="submit-review" type="submit" value="Submit">
</form>