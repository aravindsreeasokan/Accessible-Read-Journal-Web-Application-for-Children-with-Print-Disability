<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link  type="text/css" href="homestylesheet.css" rel="stylesheet"/>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<head>
    <title>Home</title>
</head>
<?php 
    include_once 'adminnav.php';
    ?>
<body>
<section id='welcome'>
<div class='content'>
    <h1>Welcome to BookBridge</h1>
    <p>Explore a diverse collection of books tailored for engaging reading experiences. Whether you seek captivating stories, informative resources, or educational materials, we offer a comprehensive selection to enrich your reading journey.</p>
    <p>As an administrator, you have the tools to manage our book catalog and view detailed reports. Track book rentals, monitor user activity, and facilitate a seamless reading environment. Join us in fostering a love for reading and supporting our community.</p>
    <a href='insert_book.php' class='btn'>List Book</a>
</div>

</section>


</body>
</html>