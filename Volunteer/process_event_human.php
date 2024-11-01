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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = intval($_POST['event_id']);
    $action = $_POST['action'];

    if ($action == 'accept') {
        $sql = "UPDATE HumProject SET is_approved = 1 WHERE id = $event_id";
    } elseif ($action == 'reject') {
        $sql = "DELETE FROM HumProject WHERE id = $event_id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: AdminHuman.php"); // Redirect back to the admin page
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
