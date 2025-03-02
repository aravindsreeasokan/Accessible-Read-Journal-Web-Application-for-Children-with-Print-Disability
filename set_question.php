<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="set_question_style.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Add Question</title>
</head>
<body>
    <?php 
        session_start();
        include ('nav.php');
        include("connection.php"); 

        $mentorsname=$_SESSION['username'];
        $serialno = $_POST['serialno'];
        $bookname = $_POST['bookname'];
        $authorname = $_POST['authorname'];
        
        echo "<h2>Add Questions for Book: $bookname</h2>";
    ?>
    
    <div class="container">
        <form id="questionForm">
            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($serialno); ?>">
            
            <div class="mb-3">
                <label for="question_text" class="form-label">Question Text</label>
                <button id="summary" class="summ btn btn-secondary " type="button">Summary</button>      <button id="question" class="ques btn btn-secondary" type="button">Question</button>
                <input type="hidden" class="form-control" id="serialno" value="<?php echo htmlspecialchars($serialno); ?>">
                <input type="hidden" class="form-control" id="bookname" value="<?php echo htmlspecialchars($bookname); ?>">
                <input type="hidden" class="form-control" id="authorname" value="<?php echo htmlspecialchars($authorname); ?>">
                <input type="hidden" class="form-control" id="mentorname" value="<?php echo htmlspecialchars($mentorsname); ?>">
                
                <input type="text" class="form-control" id="question_text" name="question_text" required>
            
            </div>
            
            <div class="mb-3">
                <label for="option_1" class="form-label">Option 1</label>
                <input type="text" class="form-control" id="option_1" name="option_1" required>
            </div>
            
            <div class="mb-3">
                <label for="option_2" class="form-label">Option 2</label>
                <input type="text" class="form-control" id="option_2" name="option_2" required>
            </div>
            
            <div class="mb-3">
                <label for="option_3" class="form-label">Option 3</label>
                <input type="text" class="form-control" id="option_3" name="option_3" required>
            </div>
            
            <div class="mb-3">
                <label for="option_4" class="form-label">Option 4</label>
                <input type="text" class="form-control" id="option_4" name="option_4" required>
            </div>
            
            <div class="mb-3">
                <label for="correct_option" class="form-label">Correct Option</label>
                <select class="form-control" id="correct_option" name="correct_option" required>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                    <option value="4">Option 4</option>
                </select>
            </div>
            
            <button type="button" class="btn btn-primary" id="addQuestionBtn">Add Question</button>
        </form>

        <div id="responseMessage"></div>
    </div>

    <!-- Bootstrap Modal for displaying the summary -->
    <div class="modal fade" id="summaryModal" tabindex="-1" aria-labelledby="summaryModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="summaryModalLabel">Book Summary</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="summaryContent">
            <!-- Summary content will be dynamically inserted here -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap Modal for Question Recommendation -->
    <div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="questionModalLabel">Question Recommendation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="questionContent">
            <!-- Summary content will be dynamically inserted here -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>-->

    <script>
        $(document).ready(function() {
            // Handle "Summary" button click
            $('#summary').click(function(event) {
                event.preventDefault();
                alert("Please wait for 1 minute");
                var bookname = $('#bookname').val();
                var authorname = $('#authorname').val();

                $.ajax({
                    url: "bookreview3.php",  // New PHP script to run Node.js summary generator
                    type: "POST",
                    data: {
                        bookname: bookname,
                        authorname: authorname
                    },
                    success: function(data) {
                        // Insert the summary result in the modal and display the modal
                        $('#summaryContent').text(data);
                        $('#summaryModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        alert("Error generating summary: " + xhr.responseText);
                    }
                });
            });
            
            // Handle "Question" button click
            $('#question').click(function(event) {
                event.preventDefault();
                alert("Please wait for 1 minute");
                var bookname = $('#bookname').val();
                var authorname = $('#authorname').val();

                $.ajax({
                    url: "bookquestion.php",  // New PHP script to run Node.js summary generator
                    type: "POST",
                    data: {
                        bookname: bookname,
                        authorname: authorname
                    },
                    success: function(data) {
    // Insert the formatted question result in the modal and display the modal
                    $('#questionContent').html(data);  // Use .html() instead of .text() to render HTML
                    $('#questionModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        alert("Error generating summary: " + xhr.responseText);
                    }
                });
            });

            // Existing form submission for adding a question
            $('#addQuestionBtn').click(function(event) {
                event.preventDefault();
                
                // Get form data
                var serialno = $('#serialno').val();
                var bookname = $('#bookname').val();
                var question = $('#question_text').val();
                var option_1 = $('#option_1').val();
                var option_2 = $('#option_2').val();
                var option_3 = $('#option_3').val();
                var option_4 = $('#option_4').val();
                var correct_option = $('#correct_option').val();
                var mentorname= $('#mentorname').val();
                
                $.ajax({
                    url: "add_question.php",
                    type: "POST",
                    data: {
                        serialno: serialno,
                        bookname: bookname,
                        question: question,
                        option_1: option_1,
                        option_2: option_2,
                        option_3: option_3,
                        option_4: option_4,
                        correct_option: correct_option,
                        mentorname:mentorname    
                    },
                    success: function(response) {
                        $('#responseMessage').html(response);
                        alert(response);
                        $('#questionForm')[0].reset(); // Reset the form after successful submission
                    },
                    error: function(xhr, status, error) {
                        $('#responseMessage').html("Error adding question: " + xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
