<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "volunteer";

// Create DB connection
$conn = new mysqli($servername, $username, $password, $database);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM HumProject WHERE is_approved = 0";
$result = $conn->query($sql);

// Check if there are any pending posts
if ($result->num_rows === 0) {
    // If no pending posts, redirect to Admin-NO.html
    header("Location: Admin-NO.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" type="image/x-icon" href="assets/Untitled.jpg">
    <link rel="stylesheet" href="css/Admin-Human.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="Assets/volunteer.png" alt="Logo">
        </div>
        <nav>
            <ul class="menu">
                <li><a href="AdminHuman.php"  class="active">Human</a></li>
                <li><a href="AdminEnvironment.php">Environment</a></li>
                <li><a href="AdminAnimal.php">Animals</a></li>
                <form action="logout.php"><button>Logout</button></form>
            </ul>
        </nav>
    </header>
    <section class="projects">
        <div class="two">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "volunteer";

            // Create DB connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check DB connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM HumProject WHERE is_approved = 0";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div id="event-' . $row['id'] . '" class="block1">
                        <div class="project-card">
                            <h2>' . htmlspecialchars($row['title']) . '</h2>
                            <img src="' . htmlspecialchars($row['picture']) . '" alt="Project Image">
                            <p>' . htmlspecialchars($row['description']) . '</p>
                            <div class="project-details">
                                <p><strong>Venue:</strong> ' . htmlspecialchars($row['venue']) . '</p>
                                <p><strong>Date:</strong> ' . htmlspecialchars($row['date']) . '</p>
                                <p><strong>Time:</strong> ' . htmlspecialchars($row['time']) . '</p>
                            </div>
                            <a href="tel:+94771234567" class="button">Contact Us</a>
                            <a href="' . htmlspecialchars($row['website']) . '" class="more-details">More Details >></a>
                            <a href="mailto:' . htmlspecialchars($row['email']) . '" class="email">Email: ' . htmlspecialchars($row['email']) . '</a>
                        </div>
                        <div class="tf">
                            <form method="post" action="process_event_human.php">
                                <input type="hidden" name="event_id" value="' . $row['id'] . '">
                                <button type="submit" name="action" value="accept">Accept</button>
                                <button type="submit" name="action" value="reject">Reject</button>
                            </form>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No pending events found.</p>";
            }

            $conn->close();
            ?>
        </div>
    </section>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="Assets/volunteer.png" alt="Hands On Heart Logo">
                
            </div>
            <div class="footer-links">
                <a href="AdminHuman.php">Human</a>
                <a href="AdminEnvironment.php">Environment</a>
                <a href="AdminAnimal.php">Animals</a>
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
        <p>© 2024 | Volunteer | All rights reserved.</p>
    </div>
</body>
</html>