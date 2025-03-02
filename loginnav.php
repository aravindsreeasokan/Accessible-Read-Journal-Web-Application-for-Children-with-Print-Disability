
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
</head>
<body>
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand text-light" href="adminhome.php">BookBridge</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">

        
             <li class="nav-item"><a class="nav-link" href="login.php"><i class="bx bx-log-in"></i> Login</a></li>
        
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
