<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved</title>
    <link rel="icon" type="image/x-icon" href="assets/Untitled.jpg">
    <link rel="stylesheet" href="css/Admin-NO.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="Assets/volunteer.png" alt="HandsOnHeart Logo">
        </div>
        <nav>
            <ul class="menu">
                <li><a href="index.php">Human</a></li>
                <li><a href="Environment.php">Environment</a></li>
                <li><a href="Animal.php">Animals</a></li>
                <form action="logout.php"><button>Logout</button></form>
            </ul>
        </nav>
    </header>
    
    <div class="content">
    <?php
        if (isset($_SESSION['successMessage']) && !empty($_SESSION['successMessage'])) {
            echo '<div style="margin-top: 20px; padding: 15px; border: 1px solid #4CAF50; background-color: #dff0d8; color: #3c763d; border-radius: 5px; font-family: Arial, sans-serif;">
                <strong>NOTE: </strong> ' . $_SESSION['successMessage'] . '
            </div>';
            unset($_SESSION['successMessage']); // Clear message after displaying
        }
        if (isset($_SESSION['errorMessage']) && !empty($_SESSION['errorMessage'])) {
            echo '<div style="margin-top: 20px; padding: 15px; border: 1px solid #f44336; background-color: #fbe9e7; color: #d32f2f; border-radius: 5px; font-family: Arial, sans-serif;">
                    <strong>Error!</strong> ' . $_SESSION['errorMessage'] . '
                </div>';
            unset($_SESSION['errorMessage']); // Clear message after displaying
        }
        ?>
        <h2>It will appear on the home page within 24 hours.</h2>
        <img src="Assets/Saved.png" alt="Saved Image">
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="Assets/volunteer.png" alt="Hands On Heart Logo">
            </div>
            <div class="footer-links">
                <a href="index.php">Human</a>
                <a href="EnviroForm.php">Environment</a>
                <a href="Animal.php">Animals</a>
            </div>
            <div class="footer-contact">
                <p style="font-size: 23px; font-weight: bold;">Contact Us</p>
                <p><img src="Assets/email.png" alt="Email Icon"> CINECWebDev@gamil.com</p>
                <p><img src="Assets/phone.png" alt="Phone Icon"> 077-1245678</p>
                <p><img src="Assets/location.png" alt="Location Icon"> CINEC Campus, Malabe.</p>
            </div>
        </div>
    </footer>

    <div class="footer-bottom">
        <p>© 2024 | volunteer | All rights reserved.</p>
    </div>
</body>
</html>
