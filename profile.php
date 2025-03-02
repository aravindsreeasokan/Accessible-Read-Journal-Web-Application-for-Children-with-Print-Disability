<?php
session_start();
include("connection.php");

$ownername = $_SESSION['username'];
$query = "SELECT * FROM `login_tab` WHERE username = '$ownername'";
$result = mysqli_query($con, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $serialno = $row['roll_no'];
    $imgquery = "SELECT * FROM `student_details_tab` WHERE student_rollno ='$serialno'";
    $imageresult = mysqli_query($con, $imgquery);
    $imgrow = mysqli_fetch_assoc($imageresult);
} else {
    header("Location: logout.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['interests'])) {
    $interestQueryExist = "SELECT interest FROM `student_details_tab` WHERE student_rollno='$serialno'";
    $checkQuery = mysqli_query($con, $interestQueryExist);
    
    if ($checkQuery && $rowExist = mysqli_fetch_assoc($checkQuery)) {
        $currentInterests = $rowExist['interest'];
        $interestsArray = $_POST['interests'];
        $interestsString = implode(',', $interestsArray);
        
        if (!empty($currentInterests)) {
            $interestsString = $currentInterests . ',' . $interestsString;
        }
        
            $updateInterestQuery = "UPDATE `student_details_tab` SET interest = '$interestsString' WHERE student_rollno = '$serialno'";
            if (mysqli_query($con, $updateInterestQuery)) {
                header("Location: " . $_SERVER['PHP_SELF']);
                exit(); 
                echo '<script>alert("Interests updated successfully");
                       
                    </script>';
            } else {
                echo '<script>alert("Failed to update interests");</script>'; 
            }
        
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="profilestylesheet.css" rel="stylesheet"/>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Profile</title>
</head>
<body>
    <?php include("usernav.php"); ?>

    <div class="profile-container">
        <h4>Profile</h4>
        <?php
        if ($imgrow && !empty($imgrow['student_img'])) {
            echo '<img src="students_images/' . $imgrow['student_img'] . '" alt="profile" class="profile-photo">';
        } else {
            echo '<img src="default-profile.png" alt="profile" class="profile-photo">';
        }
        ?>

        <div class="profile-details">
            <p><strong>Name:</strong> <?php echo $row['username']; ?></p>
            <p><strong>Phone No:</strong> <?php echo $row['phoneno']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Place:</strong> <?php echo isset($imgrow['location']) ? $imgrow['location'] : 'Not available'; ?></p>
            <p><strong>Interests:</strong> <?php echo isset($imgrow['interest']) ? $imgrow['interest'] : 'Not specified'; ?> <button id="delete" class="btn btn-danger btn-sm">Delete Interest</button></p>   
        </div>

        <form action="" method="POST">
            <div class="form-group">
                <h5>Select Your Book Interests</h5>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <input type="checkbox" class="btn-check" id="btncheck1" name="interests[]" value="Fiction" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btncheck1">Fiction</label>

                    <input type="checkbox" class="btn-check" id="btncheck2" name="interests[]" value="Politics" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btncheck2">Politics</label>

                    <input type="checkbox" class="btn-check" id="btncheck3" name="interests[]" value="Science" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btncheck3">Science</label>

                    <input type="checkbox" class="btn-check" id="btncheck4" name="interests[]" value="Biography" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btncheck4">Biography</label>

                    <input type="checkbox" class="btn-check" id="btncheck5" name="interests[]" value="Ancient" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btncheck5">Ancient</label>

                    <input type="checkbox" class="btn-check" id="btncheck6" name="interests[]" value="Novel" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btncheck6">Novel</label>

                    <input type="checkbox" class="btn-check" id="btncheck7" name="interests[]" value="History" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btncheck7">History</label>

                    <input type="checkbox" class="btn-check" id="btncheck8" name="interests[]" value="Education" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btncheck8">Education</label>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" name="sub" value="Save Interests" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#delete').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: "delete-interest.php",
            type: "POST",
            data: { }, 
            success: function(response) {
                alert(response); 
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error sending request: " + xhr.responseText);
            }
        });
    });
});
</script>
