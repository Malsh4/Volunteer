<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "volunteer";

$conn = new mysqli($servername, $username, $password, $database);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$successMessage = '';
$errorMessage = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $age = $conn->real_escape_string($_POST['age']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $brand = $conn->real_escape_string($_POST['brand']);
    $location = $conn->real_escape_string($_POST['location']);
    $name = $conn->real_escape_string($_POST['name']);
    $date = $conn->real_escape_string($_POST['date']);
    $con = $conn->real_escape_string($_POST['con']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);

    // File upload handling
    $target_dir = "upload-img/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check for upload errors
    if ($_FILES["picture"]["error"] !== UPLOAD_ERR_OK) {
        $errorMessage .= "Error uploading the file: " . $_FILES["picture"]["error"] . ". ";
        $uploadOk = 0;
    } else {
        $check = getimagesize($_FILES["picture"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $errorMessage .= "File is not an image. ";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $errorMessage .= "Sorry, file already exists. ";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["picture"]["size"] > 500000) {
        $errorMessage .= "Sorry, your file is too large. ";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $errorMessage .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
        $uploadOk = 0;
    }

    // Attempt to upload file if no errors
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            $successMessage .= "The file " . htmlspecialchars(basename($_FILES["picture"]["name"])) . " has been uploaded. ";
        } else {
            $errorMessage .= "Sorry, there was an error uploading your file. ";
        }
    } else {
        $errorMessage .= "Sorry, your file was not uploaded. ";
    }

    // Insert data into the database if file upload was successful
    if ($uploadOk == 1) {
        $sql = "INSERT INTO aniproject (title, age, gender, brand, location, name, date, con, email, contact, picture)
                VALUES ('$title', '$age', '$gender', '$brand', '$location', '$name', '$date', '$con', '$email', '$contact', '$target_file')";

        if (mysqli_query($conn, $sql)) {
            $successMessage .= '<div style="margin-top: 20px; padding: 15px; border: 1px solid #4CAF50; background-color: #dff0d8; color: #3c763d; border-radius: 5px; font-family: Arial, sans-serif;">
                    <strong>Success!</strong> New record created successfully.
                </div>';
        } else {
            $errorMessage .= "Error: " . mysqli_error($conn) . " ";
        }
    }

    // Store messages in session
    $_SESSION['successMessage'] = $successMessage;
    $_SESSION['errorMessage'] = $errorMessage;
    
    // Redirect to the saved page
    header("Location: Saved.php");
    exit();
}

$conn->close();
?>
