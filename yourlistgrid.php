<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Document</title>
</head>
<body>

    <?php
    function yourlistgrid($serialno, $name, $image, $owner, $category, $language, $place, $price) {
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
                    <p class='author_name'>Owned By: $owner</p>
                    <p class='language'>Location: $place</p>
                    <p class='price'>Price: $price</p>
                </div>
                <div id='request'>
                    <input type='hidden' id='serialno' name='pid' value='$serialno'>
                    <input type='hidden' id='category' name='category' value='$category'>
                    <input type='hidden' id='place' name='place' value='$place'>
                    <input type='hidden' id='price' name='price' value='$price'>
                    <input type='hidden' id='owner' name='ownername' value='$owner'>
                    <button type='submit' class='edit'>Edit listing</button>
                </div>
            </form>
        </div>";
        echo $element;
    }
    ?>

    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Update Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    <!-- info from contact-info will be displayed-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.edit').click(function(event) {
                event.preventDefault();
                var serialno = $(this).closest('form').find('#serialno').val();
                var name = $(this).closest('form').find('#name').val();
                var owner = $(this).closest('form').find('#owner').val();
                var place = $(this).closest('form').find('#place').val();
                var price = $(this).closest('form').find('#price').val();
                $.ajax({
                    url: 'edit-info.php',
                    method: 'POST',
                    data: { ownername: owner, serialno: serialno, bookname: name, place: place, price: price },
                    success: function(response) {
                        $('#modal-body-content').html(response);
                        $('#contactModal').modal('show');

                    }
                });
            });
        });
    </script>
</body>
</html>
