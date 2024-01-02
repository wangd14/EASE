<?php
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
$class_name = $_POST['class_name'];

$sql = "SELECT * FROM `uploads` WHERE class_name LIKE '$class_name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1> Results:</h1>";
    echo "<table>";
    echo "<tr><th>User</th><th>Class</th><th>Exam</th><th>Description</th><th>View file</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $url = '../uploads/' . $row['file_name'];
        echo "<tr><td>" .$row["uploader"] . "</td><td>". $row["class_name"] . "</td><td>" . $row["exam_name"] . "</td><td>" . $row['exam_description'] . "</td><td><a href ='$url' target = '_blank'> View</a></td></tr>";
    }
    echo "</table>";
}
else {
    echo "No results.";
}
mysqli_close($conn);
?>