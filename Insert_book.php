<?php
    session_start();
    include_once('adminnav.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="Insert_book.css" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Document</title>
</head>
<body>
    <div class="insertation">
        <h1>Enter Book Details</h1>
        
        <form name="insert_details" method="POST" action="" enctype="multipart/form-data">
            <input type="text" placeholder="Book Name" name="bookname" required>
            <input type="text" placeholder="Book Author" name="bookauthor" required>
            <input type="file" name="images" required>
            <select name="bookcategory" placeholder="Select book category">
                <option value="novel">Novel</option>
                <option value="fiction">Fiction</option>
                <option value="non-fiction">Non-Fiction</option>
                <option value="mystery-thriller">Mystery/Thriller</option>
                <option value="science-fiction">Science Fiction</option>
                <option value="fantasy">Fantasy</option>
                <option value="historical-fiction">Historical Fiction</option>
                <option value="romance">Romance</option>
                <option value="horror">Horror</option>
                <option value="adventure">Adventure</option>
                <option value="biography-autobiography">Biography/Autobiography</option>
                <option value="memoir">Memoir</option>
                <option value="self-help">Self-Help</option>
                <option value="health-wellness">Health & Wellness</option>
                <option value="history">History</option>
                <option value="true-crime">True Crime</option>
                <option value="travel">Travel</option>
                <option value="science">Science</option>
                <option value="philosophy">Philosophy</option>
                <option value="religion-spirituality">Religion & Spirituality</option>
                <option value="education">Education</option>
                <option value="business-economics">Business & Economics</option>
                <option value="childrens-books">Children’s Books</option>
                <option value="young-adult">Young Adult (YA)</option>
                <option value="graphic-novels-comics">Graphic Novels & Comics</option>
                <option value="poetry">Poetry</option>
                <option value="drama">Drama</option>
                <option value="cookbooks">Cookbooks</option>
                <option value="politics">Politics</option>
                <option value="academic-educational">Academic & Educational</option>
                <option value="reference">Reference</option>
                <option value="art-photography">Art & Photography</option>
                <option value="hobbies-crafts">Hobbies & Crafts</option>
                <option value="sports-recreation">Sports & Recreation</option>
            </select>
            <input type="text" placeholder="Book Language" name="booklanguage" required>
            <input type="number" placeholder="No of Copies" name="bookcopies" min="1" default="1" required>
            <input type="submit" name="submit">
        </form>
    </div>
    <?php
        include("connection.php");

        if(isset($_POST['submit'])){
            $bookname = $_POST['bookname'];
            $bookauthor = $_POST['bookauthor'];
            $bookcategory = $_POST['bookcategory'];
            $booklanguage = $_POST['booklanguage'];
            $bookcopies = $_POST['bookcopies'];

            if(isset($_FILES['images'])) {
                $file_name = $_FILES['images']['name']; // name of the file
                $tempname = $_FILES['images']['tmp_name']; // location of the file when user uploads it
                $folder = 'image/' . $file_name; // destination folder for the image

                // Check if the book already exists in the system (matching by book name and author)
                $checkQuery = "SELECT * FROM book_details_tab WHERE book_name='$bookname' AND author_name='$bookauthor'";
                $checkResult = mysqli_query($con, $checkQuery);

                if(mysqli_num_rows($checkResult) > 0) {
                    // Book exists, update the number of copies
                    $existingBook = mysqli_fetch_assoc($checkResult);
                    $newCopies = $existingBook['no_of_copies'] + $bookcopies;

                    $updateQuery = "UPDATE book_details_tab 
                                    SET no_of_copies='$newCopies', book_img='$file_name' 
                                    WHERE book_name='$bookname' AND author_name='$bookauthor'";

                    if (mysqli_query($con, $updateQuery)) {
                        echo "<script>alert('Book already exists. Number of copies updated successfully.')</script>";
                    } else {
                        echo "Failed to update book details: " . mysqli_error($con);
                    }

                } else {
                    // Book does not exist, insert a new record
                    if (move_uploaded_file($tempname, $folder)) {
                        $insertQuery = "INSERT INTO book_details_tab 
                                        (book_name, book_img, author_name, category, language, no_of_copies) 
                                        VALUES ('$bookname', '$file_name', '$bookauthor', '$bookcategory', '$booklanguage', '$bookcopies')";

                        if (mysqli_query($con, $insertQuery)) {
                            echo "<script>alert('Book details inserted successfully')</script>";
                        } else {
                            echo "Failed to insert book details: " . mysqli_error($con);
                        }
                    } else {
                        echo "Failed to upload image.";
                    }
                }
            } else {
                echo "Please upload a valid image.";
            }
        }
    ?>
</body>
</html>
