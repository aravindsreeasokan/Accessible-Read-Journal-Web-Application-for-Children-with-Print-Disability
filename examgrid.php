<?php

function grid($serialno, $name, $image, $category, $language,$author)
{
    $element = "
        <div class='card'>
            <form method='POST' action='set_question.php'>
                <div class='image-container'>
                    <img src='image/$image' alt='Product Image'>
                </div>
                <div class='caption'>
                    <p class='rate'>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </p>
                    <p class='product_name'>$name</p>
                    <p class='category'>Category: $category</p>
                    <p class='language'>Language: $language</p>
                    
                </div>
                <div id='request'>
                    <input type='hidden' id='serialno' name='serialno' value='$serialno'>
                    <input type='hidden' id='name' name='bookname' value='$name'>
                    <input type='hidden' id='author' name='authorname' value='$author'>
                    <button type='submit' id='rentbook' class='add' name='rent'>Set Question</button>
                </div>
            </form>
        </div>";
    echo $element;
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--<script>
$(document).ready(function() {
    $('.add').click(function(event) {
        event.preventDefault();
        var serialno = $(this).closest('form').find('#serialno').val();
        var name = $(this).closest('form').find('#name').val();
        var mentorname = $(this).closest('form').find('#mentorname').val();
       // alert(serialno);
         // alert(name);
        //alert(mentorname);
        $.ajax({
            url: "read-insert.php",
            type: "POST",
            data: { serialno: serialno, bookname: name,mentorname:mentorname},
            success: function(data) {
                alert(data);
            },
            error: function(xhr, status, error) {
                alert("Error sending request: " + xhr.responseText);
            }
        });
    });
});
</script>-->
