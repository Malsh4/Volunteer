<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Environment Projects</title>
    <link rel="icon" type="image/x-icon" href="assets/Untitled.jpg">
    <link rel="stylesheet" href="css/Human.css">
   
</head>

<body>

    <div class="main">
        <header>
            <div class="logo">
                <img src="Assets/volunteer.png" alt="HandsOnHeart Logo">
            </div>
            <nav>
                <ul class="menu">
                    <li><a href="index.php">Human</a></li>
                    <li><a href="Environment.php" class="active">Environment</a></li>
                    <li><a href="Animal.php">Animals</a></li>
                </ul>
            </nav>
            <div class="search-container">
                <input type="text" placeholder="Search text">
                <button><img src="Assets/icon.png" alt="Search"></button>
            </div>
            <div class="new-button">
                <button><a href="login.html">New +</a></button>
            </div>
        </header>
        <div class="event-cards">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "volunteer";

            // Create DB connection
            $conn = mysqli_connect($servername, $username, $password, $database);

            // Check DB connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Query to fetch only approved events from the 'EnvProject' table
            $sql = "SELECT * FROM EnvProject WHERE is_approved = 1";
            $result = mysqli_query($conn, $sql);

            // Check if there are results and fetch them
            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    // Ensure data is properly escaped to prevent XSS
                    $title = htmlspecialchars($row['title']);
                    $organization = htmlspecialchars($row['organization']);
                    $website = htmlspecialchars($row['website']);
                    $description = htmlspecialchars($row['description']);
                    $venue = htmlspecialchars($row['venue']);
                    $date = htmlspecialchars($row['date']);
                    $time = htmlspecialchars($row['time']);
                    $email = htmlspecialchars($row['email']);
                    $contact = htmlspecialchars($row['contact']);
                    $picture = htmlspecialchars($row['picture']); // Assume this is a URL or path to an image

                    echo '<div class="card">
                            <div class="card-image">
                                <img src="' . $picture . '" alt="' . $title . '">
                            </div>
                            <h2 class="card-title">' . $title . '</h2>
                            <p class="card-description">' . $description . '</p>
                            <div class="card-info">
                                <p><strong>Organization:</strong> ' . $organization . '</p>
                                <p><strong>Venue:</strong> ' . $venue . '</p>
                                <p><strong>Date:</strong> ' . $date . '</p>
                                <p><strong>Time:</strong> ' . $time . '</p>
                                <p><strong>Contact:</strong> ' . $contact . '</p>
                            </div>
                            <a href="mailto:' . $email . '" class="contact-button">Contact Us</a>
                            <p class="email-info">Email: ' . $email . '</p>
                            <a href="' . $website . '" class="more-details" target="_blank">More Details ></a>
                        </div>';
                }
            } else {
                header("Location: UserNO.html");
            }

            // Close connection after all operations are complete
            mysqli_close($conn);
            ?>
        </div>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="Assets/volunteer.png" alt="Volunteer">                
            </div>
            <div class="footer-links">
                <a href="index.php">Human</a>
                <a href="Environment.php">Environment</a>
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
        <p>© 2024 | Volunteer | All rights reserved.</p>
    </div>
</div>
</div>

</body>
</html>