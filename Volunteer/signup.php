<?php
$host = 'localhost';
$user = 'root';   
$pass = '';        
$db = 'volunteer';     

$conn = new mysqli($host, $user, $pass, $db);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password != $confirm_password) {
        echo "<script>
        alert('Passwords do not match!');
        window.location.href = 'signup.html';
        </script>";
    } else {
        // Check if email already exists
        $checkEmailQuery = $conn->prepare("SELECT * FROM userlogin WHERE Email = ?");
        $checkEmailQuery->bind_param("s", $email);
        $checkEmailQuery->execute();
        $result = $checkEmailQuery->get_result();

        if ($result->num_rows > 0) {
            // Email already exists
            echo "<script>
            alert('This email is already registered!');
            window.location.href = 'signup.html';
            </script>";
        } else {
            // If email does not exist, proceed to hash the password and insert the new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO userlogin (Email, Password2) VALUES (?, ?)");

            if ($stmt === false) {
                // Output error information
                die('Error with the SQL query: ' . $conn->error);
            }

            // Bind parameters and execute
            $stmt->bind_param("ss", $email, $hashed_password);
            if ($stmt->execute()) {
                header("Location: login.html"); // Redirect to login page
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
}
$conn->close();
?>
