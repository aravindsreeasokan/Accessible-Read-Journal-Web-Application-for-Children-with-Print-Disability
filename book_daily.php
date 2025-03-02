<?php
session_start();
include("connection.php");

$username = $_SESSION['username'];

// Fetch user's books from the shelf
$query = "SELECT * FROM read_tab WHERE readers_name='$username'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Book Shelf</title>
</head>
<body>
    <?php include("nav.php"); ?>

    <div class="container mt-4">
        <h2>Your Book Shelf</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Book Name</th>
                        <th>Serial Number</th>
                        <th>Review Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['book_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['serial_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['read_status']); ?></td>
                            <td>
                                <a href="daily_review_form.php?book_name=<?php echo urlencode($row['book_name']); ?>&serial_no=<?php echo urlencode($row['serial_no']); ?>&mentor_name=<?php echo urlencode($row['mentor_name']); ?>" class="btn btn-primary">Add/Edit Review</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No books on your shelf.</p>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
