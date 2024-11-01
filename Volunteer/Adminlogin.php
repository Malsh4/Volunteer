<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "volunteer";  

// Create DB connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);
 
$sql = "SELECT * FROM adminlogin WHERE Email='$email' AND BINARY Password1='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login successful
    session_start();
    $row = $result->fetch_assoc();
    $_SESSION['admin_id'] = $row['AID'];
    $_SESSION['admin_name'] = $row['Name'];
    header("Location: AdminHuman.php"); // Redirect to the admin page
} else {
    // Login failed
    echo "<script>alert('Incorrect email or password.'); window.location.href = 'Adminlogin.html';</script>";
}

$conn->close();
?>
