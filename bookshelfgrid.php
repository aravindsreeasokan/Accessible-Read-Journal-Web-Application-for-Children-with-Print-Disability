<?php
function grid($serialno, $name, $image, $category, $language,$mentor)
{
    global $con;
    $username = $_SESSION['username'];
    echo "
        <div class='card'>
            <form method='GET' action='daily_review.php'>
                <button name='close' class='close' type='button'>
                        <i class='bx bx-x'></i>
                </button>
                <div class='card-content'>
                    <div class='image-container'>
                        <img src='image/$image' alt='$name'>
                    </div>
                    <div class='details'>
                        <p class='product_name'>$name</p>
                        <p class='category'>Category: $category</p>
                        <p class='language'>Language: $language</p>
                        <input type='hidden'  name='serialno'  value='$serialno'>
                        <input type='hidden' name='bookname'  value='$name'>
                        <button type='submit' id='updateStatus' class='review' name='update'>Daily Journal</button>
            </form>
                        <form method='POST' action=''>
                            <input type='hidden'  id='serialno'  value='$serialno'>
                            <input type='hidden' id='bookname'  value='$name'>
                            <input type='hidden' id='mentorname'  value='$mentor'>  
                            <button type='button' id='finished' class='finished_book' name='update'>Finished</button>
                        </form>
                        </div>
                </div>
            
        </div>
    ";
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.finished_book').click(function(event) {
        event.preventDefault();
        var serialno = $(this).closest('form').find('#serialno').val();
        var name = $(this).closest('form').find('#bookname').val();
        var mentorname = $(this).closest('form').find('#mentorname').val();
       //alert(serialno);
         // alert(name);
        //alert(mentorname);
        $.ajax({
            url: "finished.php",
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
    $('.close').click(function(event) {
        event.preventDefault();
        var serialno = $(this).closest('form').find('#serialno').val();
        var name = $(this).closest('form').find('#bookname').val();
        var mentorname = $(this).closest('form').find('#mentorname').val();
       //alert(serialno);
         // alert(name);
        //alert(mentorname);
        $.ajax({
            url: "delete_read_book.php",
            type: "POST",
            data: { serialno: serialno, bookname: name,mentorname:mentorname},
            success: function(data) {
                alert(data);
                location.reload(); 
            },
            error: function(xhr, status, error) {
                alert("Error sending request: " + xhr.responseText);
            }
        });
        
    });
});
</script>
