<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ownername = $_POST['ownername'];
    $serialno = $_POST['serialno'];

    include("connection.php");
    $query = "SELECT * FROM book_details_tab WHERE serial_no = '$serialno' ";
    $result = mysqli_query($con, $query);
    $listing = mysqli_fetch_assoc($result);

    if ($listing) {
        $name = $listing['book_name'];
        $category = $listing['category'];
        $place = $listing['Place'];
        $price = $listing['price'];
        $no_of_copies=$listing['no_of_copies'];
        echo "
        <form method='POST' action=''>
            <input type='hidden' name='serialno' id='serialno' value='$serialno'>
            <input type='hidden' name='ownername' id='owner' value='$ownername'>
            <div class='mb-3'>
                <label for='name' class='form-label'>Book Name</label>
                <input type='text' class='form-control' name='name' id='name'value='$name' required>
            </div>
            <div class='mb-3'>
                <label for='category' class='form-label'>Category</label>
                <input type='text' class='form-control' name='category'id='category' value='$category' required>
            </div>
            <div class='mb-3'>
                <label for='place' class='form-label'>Location</label>
                <input type='text' class='form-control' name='place' id='place' value='$place' required>
            </div>
            <div class='mb-3'>
                <label for='price' class='form-label'>Price</label>
                <input type='text' class='form-control' name='price' id='price' value='$price' required>
            </div>
            <div class='mb-3'>
                <label for='price' class='form-label'>No of Copies</label>
                <input type='text' class='form-control' name='copies' id='copies' value='$no_of_copies' required>
            </div>
            <button type='submit' id='update' class='btn btn-primary'>Update</button>
        </form>";
    } else {
        echo "<p>No listing found for the given serial number and owner name.</p>";
    }
}
?>
<script>
        $(document).ready(function() {
            $('#update').click(function() {
                var serialno = $(this).closest('form').find('#serialno').val();
                var name = $(this).closest('form').find('#name').val();
                var owner = $(this).closest('form').find('#owner').val();
                var place = $(this).closest('form').find('#place').val();
                var price = $(this).closest('form').find('#price').val();
                var copies = $(this).closest('form').find('#copies').val();
                var category = $(this).closest('form').find('#category').val();
                
                $.ajax({
                    url: 'update-listing.php',
                    method: 'POST',
                    data: { ownername: owner,serialno : serialno  ,name : name ,place:place, price:price, copies:copies, category:category },
                    success: function(data) {    
                         alert(data);
                                
                    }
                });
            });
        });
    </script>
    
