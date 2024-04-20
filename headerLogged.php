<?php
    session_start(); 
    include 'connect.php';
?>

<link rel="stylesheet" href="css/indexstyle.css"/>
  
<header>
    <a href="" class="logo">
        <i class='bx bxs-site'></i>Curious KeyPie
    </a>

    <ul class="navbar">
        <li><a href="http://localhost/f3Orate/indexLogged.php" class="home-active">Home </a></li>
        <li><a href="http://127.0.0.1:5500/about.html">About Us</a></li>
        <li><a href="#contact">Contact Us </a></li>
    </ul>

    <?php
    if (isset($_SESSION['username'])) {
        echo '<a href="#" class="btn">' . $_SESSION['username'] . '</a>'; 
        echo '<a href="login.php" class="btn"> Log Out</a>';
       
    }
    ?>
</header>


