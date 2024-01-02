<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$database = "iit";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $database);

$current_status = "";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $user;
        $_SESSION['points'] = $conn->query("SELECT * FROM `users` WHERE username LIKE '$user'")->fetch_column(3);
        session_write_close();
        header("Location: io.php");
        exit();
    } else {
        $current_status = "Error";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - EASE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../resources/homepage.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../resources/homepage.js"></script>
</head>
<body>
    <div id="section1">
        <div class="login">
            <h1>Sign Up</h1>
            <form action="register.php" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
                <br><br>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
                <br><br>
                <button type="submit" name="register">Register</button>
            </form>
            <br>
            <p>Already have an account? <a href="login.php">Click here to log in</a></p>
        </div>
        <div>
            <?php echo $current_status ?>
        </div>
    </div>

    <header>
        <a class="logo">EASE</a>
        <nav>
            <ul class="nav_link">
                <li><a class="home" href='../index.html'>Home</a></li>
                <li><a class="about" href='../index.html#section2'>About</a></li>
            </ul>
        </nav>
        <button onclick="window.location.href='login.php';">Log In</button>
        <button onclick="window.location.href='#';">Sign Up</button>
        <!--div class="profile_container">
            <img class="profile_pic" src="resources/undraw_drink_coffee_0asa.svg" alt="profile_pic" width="60" height="60">
        </div-->
        
    </header>
</body>
</html>
