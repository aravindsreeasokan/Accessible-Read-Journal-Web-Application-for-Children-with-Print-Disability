<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">  </script>
<?php
    
    include("connection.php");
    $searchresult = $_POST['searchdata'];
    $searchresult = strtolower(mysqli_real_escape_string($con, $searchresult));
    $searchquery = "SELECT * FROM `book_details_tab` WHERE 
                            (book_name LIKE '%$searchresult%' OR 
                            author_name LIKE '%$searchresult%' OR 
                            category LIKE '%$searchresult%' OR 
                            language LIKE '%$searchresult%' OR 
                            price LIKE '%$searchresult%' OR 
                            place LIKE '%$searchresult%') 
                             ORDER BY RAND()";
                        
    $result = mysqli_query($con, $searchquery);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
    
            echo "<div class='card'>
            <form method='POST' action=''>
                    <div class='image-container'>
                        <img src='image/".$row['book_img']."' alt='Product Image'>
                    </div>
                <div class='caption'>
                    <p class='rate'>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </p>
                    <p class='product_name'>".$row['book_name']."</p>
                    <p class='category'>Category: ".$row['category']."</p>
                    <p class='author_name'>Owned By: ".$row['owners_name']."</p>   
                    <p class='language'>Location: ".$row['Place']."</p>
                    <p class='price'>Price: ".$row['price']."</p>
                </div>
                <input type='hidden' id='serialno' name='pid' value=".$row['serial_no'].">
                <input type='hidden' id='name' name='bookname' value=".$row['book_name'].">
                <input type='hidden' id='owner' name='ownername' value=".$row['owners_name'].">
                <button type='submit' id='rentbook' class='add' name='rent'>Send aja Request</button>
            </form>
            </div>";
        }
    } else {
        echo "<div class='notfound'><p>NO RESULT</p></div>";
    }
?>
 <script>
        $(document).ready(function() {
            $('#rentbook').click(function(event) {
                alert("button clicked");
                event.preventDefault();
                var serialno = $.trim($('#serialno').val());
                var name = $('#name').val();
                var owner = $('#owner').val();
                alert(serialno);
                alert(name);
                alert(owner);
                $.load("load-grid.php", { searialno:serialno,bookname:name,ownername:owner });
            });
        });
    </script>
