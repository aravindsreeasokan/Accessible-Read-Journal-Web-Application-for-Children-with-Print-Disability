<?php

function grid($serialno, $name, $image, $author, $category, $language,$no_of_copies,$studentname,$studentmail,$rollno)
{
    $element = "
        <div class='card'>
            <form method='POST' action=''>
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
                    <p class='author_name'>Author:$author </p>
                    <p class='no_of_copies'>No of Copies: $no_of_copies</p>
                </div>
                <div id='request'>
                    <input type='hidden' id='serialno' name='pid' value='$serialno'>
                    <input type='hidden' id='name' name='bookname' value='$name'>
                    <input type='hidden' id='studentname' name='studentname' value='$studentname'>
                    <input type='hidden' id='mail' name='studentmail' value='$studentmail'>
                    <input type='hidden' id='rollno' name='student_rollno' value='$rollno'>
                    <button type='submit' id='rentbook' class='add' name='rent'>Recommend</button>
                </div>
            </form>
        </div>";
    echo $element;
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.add').click(function(event) {
        event.preventDefault();
        var serialno = $(this).closest('form').find('#serialno').val();
        var name = $(this).closest('form').find('#name').val();
        var studentname = $(this).closest('form').find('#studentname').val();
        var mail = $(this).closest('form').find('#mail').val();
        var rollno = $(this).closest('form').find('#rollno').val();
        // alert(serialno);
        // alert(name);
        // alert(owner);
        $.ajax({
            url: "insert-recommend.php",
            type: "POST",
            data: { serialno: serialno, bookname: name ,studentname:studentname,studentmail:mail,rollno:rollno},
            success: function(data) {
                alert(data);
            },
            error: function(xhr, status, error) {
                alert("Error sending request: " + xhr.responseText);
            }
        });
    });
});
</script>
