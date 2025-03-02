<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once("count.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="navigationstyle.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Navigation</title>
    <style>
        button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
           
      padding-right: 10px;
        }

        button:hover {
            color: #ccc; /* Optional hover effect */
        }

        button:focus {
            outline: none; /* Remove focus outline */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid"> 
  <button onclick="history.back()"><i class='bx bx-arrow-back'></i></button>
    <a class="navbar-brand text-light" href="userhome.php">BookBridge</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-light" aria-current="page" href="rent_a_book.php">Read a Book</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" aria-current="page" href="your_book_shelf.php">Book Shelf</a>
        </li>
        <li class="nav-item">
          <?php
          if (isset($_SESSION['username'])) {
              echo '<a class="nav-link" href="studentbook-selection.php"><i class="bx bxs-chat"></i><div class="count">' . $_SESSION["count"] . '</div></a>';
          }
          ?>
        </li>
        <?php 
          if (isset($_SESSION['username'])) {                                                   
              echo '
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Profile
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="profile.php">' . $_SESSION['username'] . '</a></li>
                  <li><a class="dropdown-item" href="studentbook-selection.php">Chat with Mentor</a></li>
                  <li><a class="dropdown-item" href="attend_exam.php">Exams</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                </ul>
              </li>';
          } else {
              echo '<li class="nav-item"><a class="nav-link" href="login.php"><i class="bx bx-log-in"></i> Login</a></li>';
          }
        ?>      
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
