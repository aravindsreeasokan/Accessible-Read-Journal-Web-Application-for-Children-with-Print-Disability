<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Book Image</title>
</head>
<body>
    <h2>Upload an Image of the Book to Get Its Title</h2>
    <form action="img_recong.php" method="POST" enctype="multipart/form-data">
        <label for="book_image">Choose a book image:</label>
        <input type="file" name="book_image" id="book_image" accept="image/*" required>
        <br><br>
        <input type="submit" value="Upload and Find Title">
    </form>
</body>
</html>
