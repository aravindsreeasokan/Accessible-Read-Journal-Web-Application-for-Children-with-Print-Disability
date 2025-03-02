<?php
function chat($serialno, $name, $image, $mentorname, $studentname, $rollno)
{
    $element = "
        <div class='card'>
            <form method='POST' action=''>
                <div class='see_review'>
                    <input type='hidden' id='serialno' name='serialno' value='$serialno'>
                    <input type='hidden' id='bookname' name='bookname' value='$name'>
                    <button name='see' class='see' type='button'><i class='bx bx-comment-dots'></i></button>
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