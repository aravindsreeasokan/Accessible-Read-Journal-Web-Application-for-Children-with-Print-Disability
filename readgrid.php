<?php
function grid($serialno, $name, $image, $category, $language, $mentorname, $studentname, $rollno)
{
    $element = "
        <div class='card'>
            <form method='POST' action=''>
                <div class='see_review'>
                    <input type='hidden' id='serialno' name='serialno' value='$serialno'>
                    <input type='hidden' id='bookname' name='bookname' value='$name'>
                    <button name='see' class='see' type='button'><i class='bx bxs-edit'></i></button>
                </div>
                <div class='image-container'>
                    <img src='image/$image' alt='image of $name'>
                </div>
                <div class='caption'>
                    <p class='rate'>
                        <button class='review' type='button'>Add Review</button>
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
                    <input type='hidden' id='mentorname' name='mentorname' value='$mentorname'>
                    <input type='hidden' id='name' name='mentorname' value='$name'>
                    <input type='hidden' id='studentname' name='studentname' value='$studentname'>
                    <input type='hidden' id='studentrollno' name='studentrollno' value='$rollno'>
                    <button type='submit' id='rentbook' class='add' name='rent'>Read</button>
                </div>
            </form>
        </div>";
    echo $element;
}
?>

<!-- Bootstrap Modal for Writing Reviews -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="reviewModalBody">
                <form id="reviewForm">
                    <input type="hidden" id="modalSerialno" name="serialno">
                    <input type="hidden" id="modalBookname" name="bookname">
                    <input type="hidden" id="modalMentorname" name="mentorname">
                    <input type="hidden" id="modalStudentname" name="studentname">
                    <input type="hidden" id="modalStudentrollno" name="studentrollno">
                    <div class="mb-3">
                        <label for="reviewText" class="form-label">Your Review</label>
                        <textarea class="form-control" id="reviewText" name="review" rows="5" placeholder="Write your review here..."></textarea>
                    </div>
                    <button type="button" id="reviewsubmit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal for Displaying Reviews -->
<div class="modal fade" id="scrollableModal" tabindex="-1" aria-labelledby="scrollableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableModalLabel">Reviews</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="scrollableModalBody">
                <!-- Content will be dynamically populated -->
            </div>
            <div class="modal-footer">
                <!-- Footer content if needed -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.add').click(function(event) {
        event.preventDefault();
        var serialno = $(this).closest('form').find('#serialno').val();
        var name = $(this).closest('form').find('#name').val();
        var mentorname = $(this).closest('form').find('#mentorname').val();
       //alert(serialno);
         //alert(name);
        //alert(mentorname);
        $.ajax({
            url: "read-insert.php",
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

    // Handle the "Add Review" button click event
    $('.review').click(function(event) {
        event.preventDefault();
        $('#reviewText').val('');
        var serialno = $(this).closest('form').find('#serialno').val();
        var name = $(this).closest('form').find('#bookname').val();
        var mentorname = $(this).closest('form').find('#mentorname').val();
        var studentname = $(this).closest('form').find('#studentname').val();
        var studentrollno = $(this).closest('form').find('#studentrollno').val();

        // Populate modal with book data
        $('#modalSerialno').val(serialno);
        $('#modalBookname').val(name);
        $('#modalMentorname').val(mentorname);
        $('#modalStudentname').val(studentname);
        $('#modalStudentrollno').val(studentrollno);

        // Show the modal
        $('#reviewModal').modal('show');
    });

    // Handle the "Submit Review" button click event
    $('#reviewsubmit').click(function(event) {
        event.preventDefault();

        var serialno = $('#modalSerialno').val();
        var name = $('#modalBookname').val();
        var studentname = $('#modalStudentname').val();
        var studentrollno = $('#modalStudentrollno').val();
        var review = $('#reviewText').val();

        // Send the review data via AJAX
        $.ajax({
            url: "review-insert.php",
            type: "POST",
            data: {
                serialno: serialno,
                bookname: name,
                studentname: studentname,
                studentrollno: studentrollno,
                review: review
            },
            success: function(data) {
                //alert(data);
                $('#reviewModal').modal('hide'); // Hide the modal after submission
            },
            error: function(xhr, status, error) {
                alert("Error sending request: " + xhr.responseText);
            }
        });
    });

    // Handle the "See Reviews" button click event
    $('.see').click(function(event) {
        event.preventDefault();
        var serialno = $(this).closest('form').find('#serialno').val();
        var bookname = $(this).closest('form').find('#bookname').val();
        
        $('#scrollableModal').modal('show');
        $.ajax({
            url: "review-display.php",
            type: "POST",
            data: {
                serialno: serialno,
                bookname: bookname
            },
            success: function(data) {
                $('#scrollableModalBody').html(data); // Use new ID for modal body
            },
            error: function(xhr, status, error) {
                alert("Error sending request: " + xhr.responseText);
            }
        });
    });
});
</script>
