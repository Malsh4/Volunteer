<?php
$host = 'localhost'; 
$user = 'root';      
$pass = '';          
$db = 'volunteer';   

// Create DB connection
$conn = new mysqli($host, $user, $pass, $db);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    $stmt = $conn->prepare("SELECT * FROM userlogin WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['Password2'])) {
            header("Location: HumanForm.html"); 
            exit();
        } else {
            echo "<script>
            alert('Invalid password!');
            window.location.href = 'login.html';
            </script>";
        }
    } else {
        echo "<script>
        alert('Email not registered!');
        window.location.href = 'login.html';
        </script>";
    }
}
$conn->close();
?>

