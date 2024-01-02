<?php
session_start();
$servername = "localhost";
$database = "iit";
$username = "root";
$password = "";
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check the connection
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}
$target_dir = "../uploads/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if (isset($_FILES['file_name'])) {
    $target_file = $target_dir . basename($_FILES['file_name']['name']);

    if (move_uploaded_file($_FILES['file_name']['tmp_name'], $target_file)) {
        echo "The file " . basename($_FILES['file_name']['name']) . " has been uploaded.";
        $class_name = $_POST['class_name'];
        $exam_name = $_POST['exam_name'];
        $file_name = $_FILES['file_name']['name'];
        $description = $_POST['exam_description'];
        $uploader = $_SESSION['username'];
        $sql = "INSERT INTO uploads (file_name, class_name, exam_name, exam_description, uploader) VALUES ('$file_name', '$class_name', '$exam_name', '$description', '$uploader')";
        if (mysqli_query($conn, $sql)) {
            header("Location: ../io.php");
    } else {
        echo "Error";
    }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "No file was uploaded.";
}


mysqli_close($conn);
?>
