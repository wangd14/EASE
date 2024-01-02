<?php
session_start(); 
if($_SESSION['username'] == null) {
    header("Location: login.php");
}
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

$search_result = "";
$pageview = "";
$count = 0;
$icon = "";

if ($result->num_rows > 0) {
    $search_result = $search_result . "<h1>Results:</h1>";
    $search_result = $search_result . "<tr><th>Uploader</th><th>Class</th><th>Exam</th><th>Description</th><th>View file</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        $url = 'uploads/' . $row['file_name'];
        $search_result = $search_result . "<tr><td>" .$row["uploader"] . "</td><td>". $row["class_name"] . "</td><td>" . $row["exam_name"] . "</td><td>" . $row['exam_description'] . "</td><td><a href ='$url' target = '_blank'> View</a></td></tr>";
        $pageview = $pageview . "<pageview class='page hidden pageview" . $count . "'>";
        $pageview = $pageview . "<div class='pageview'><div class='pageview-left'><iframe id='file-preview' src='";
        $pageview = $pageview . "uploads/" . $row['file_name'] . "#pagemode=none' frameborder='0'></iframe>";
        $pageview = $pageview . "</div><div class='pageview-right'><div><h3>Uploader:</h3>";
        $pageview = $pageview . "<Uploader>" . $row["uploader"] . "</Uploader></div>";
        $pageview = $pageview . "<div><h3>Class name:</h3><Class>" . $row["class_name"] . "</Class></div>";
        $pageview = $pageview . "<div><h3>Exam name:</h3><Exam>" . $row["exam_name"] . "</Exam></div>";
        $pageview = $pageview . "<div><h3>Description:</h3><Description>" . $row['exam_description'] . "</Description></div></div></div></pageview>";
        $icon = $icon . '<li><button class="icon pageview_icon" id="' . $count;
        $icon = $icon . '"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="m657 788 42-42-99-99.466Q614 625 621 602.12q7-22.88 7-48.62 0-71.5-48.708-120Q530.583 385 461 385q-70 0-120.5 48.5t-50.5 120q0 71.5 50.5 120.5T461 723q27 0 51.5-8t45.5-26l99 99ZM461 663q-46 0-78.5-31T350 553.5q0-47.5 32.5-78T461 445q46 0 76.5 30.5t30.5 78q0 47.5-30.5 78.5T461 663ZM140 896q-24 0-42-18t-18-42V316q0-24 18-42t42-18h680q24.75 0 42.375 18T880 316v520q0 24-17.625 42T820 896H140Zm0-60V316v520Zm0 0h680V316H140v520Z"/></svg><p class="icon_text">';
        $icon = $icon . $row["exam_name"] . '</p></button></li>';
        $count++;
    }
} else {
    $search_result = "<h1>No Results Yet.</h1>";
}
mysqli_close($conn);
?>



<?php
    include('includes/init.inc.php');
    include('includes/functions.inc.php');
?>

<title>I/O - EASE</title>

<?php include('includes/head.inc.php');?>

<home class="page hidden">
    <div class="profile_section">
        <div class="profile_picture">
            <h1><?php 
                echo $_SESSION['username'];
            ?></h1>
        </div>
            
        <div class="profile_stats">
            <div class="profile_username">
                <h3>username: </h3>
                <username><?php 
                    echo $_SESSION['username'];
                ?></username>
            </div>
            <div class="profile_points">
                <h3>points:</h3>
                <points><?php
                    echo $_SESSION['points'];
                ?></points>
            </div>
        </div>

        <div class="logout">
            <a href="actions/logout.php">Logout</a>
        </div>
    </div>
    <div class="dashboard">
            This is your Dashboard.
    </div>
</home>

<upload class="page hidden">
    <h1>Exam/Solution Upload</h1>
    <form id="uploadForm" action="actions/upload.php" method="post" enctype="multipart/form-data">
        <div class="flex-row">
            <div class="file_input">
                <iframe id="file-preview" src="uploads/preview.pdf#toolbar=0" frameborder="0"></iframe>
                <input type="file" name="file_name" id="file">
                <label class="file" for="file">Select file</label>
                <p id="file-name">file info shows up here</p>
            </div>
            <div class="text_input">
                <label for="class_name">Class name:</label>
                <input type="text" name="class_name" id="class_name" autocomplete="off" required>

                <label for="exam_name">Exam name:</label>
                <input type="text" name="exam_name" id="exam_name" autocomplete="off" required>

                <label for="exam_description">Description:</label>
                <textarea name="exam_description" id="exam_description">Write a description for this exam.</textarea>
            </div>
        </div>
            
        <button type="submit" name="submit">Upload</button>
    </form>
</upload>

<search class="page">
    <div class="center_section">
        <div class="search_container">
            <form action="" method="post">
                <button type="button" class="search_select"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#657789" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></button>
                <label for="class_name"></label>
                <input type="text" name="class_name" id= "class_name" placeholder="Searching by class" required>
            </form>
        </div>

        <table id="search_result">
            <?php echo $search_result; ?>
        </table>
    </div>
</search>

<info class="page hidden">
    <div class="head">
        <div>
            <h1>Welcome to the</h1>
            <h2>EASE</h2>
            <h3>Information Center</h3>
        </div>
        <h4>About Us</h4>
    </div>
    <div class="info_detail">
        <h1>This project is the final project for the ITWS 1100 class at RPI, or Rensselear Polytechnic Institute, with the goal of bringing ease of availability of back exams and study resources mainly to students at RPI but also other students. Project contributors are Andrei, David, and Ruikang.</h1>
    </div>
</info>

<help class="page hidden">
    <div class="head">
        <div>
            <h1>Welcome to the</h1>
            <h2>EASE</h2>
            <h3>Help Center</h3>
        </div>
        <h4>What can we help you find?</h4>
    </div>
        
    <div class="help_detail">
        <input type="text" placeholder="Search..">

        <h1>FAQ:</h1>
        <h2>Q: How do I get access to all the backtests?</h2>
        <h2>A: Sign up and make an account and you will be given access to countless resources from all the subjects you are studying.</h2>
        <h2>Q: How can I upload a backtest?</h2>
        <h2>A: After signing up, you can upload a backtest through the upload section of our webpage. From there you are required to input the file, the name of the class, and the exam name.</h2>
        <h2>Q: How do I know these resources are reliable?</h2>
        <h2>A: Our verified backtests have been filtered through by quality control team and we can guarentee that these resources are correct and effective. You can also still access those that haven't been verified but remember that they haven't gone through our systems quality tests.</h2>
        <h2>Q: Will my grades improve if I use this?</h2>
        <h2>A: Well that depends on you! Although we provide the top notch resources from many different subjects and courses, you still must put the effort in to affectively use them.</h2>
    </div>
</help>

<div id="page_container">
    <?php echo $pageview; ?>
</div>


<sidebar>
    <div class="top_section spacer">
        <button class="expand_icon"><svg class="expand_icon_svg" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M480 711 240 471l56-56 184 184 184-184 56 56-240 240Z"/></svg></button>
        <button class="home icon home_icon"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M240 856h147.692V620.615h184.616V856H720V496L480 314.462 240 496v360Zm-40 40V476l280-211.539L760 476v420H532.308V660.616H427.692V896H200Zm280-310.769Z"/></svg><p class="icon_text">Home</p></button>
        <button class="upload icon upload_icon"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M240 896q-33 0-56.5-23.5T160 816V696h80v120h480V696h80v120q0 33-23.5 56.5T720 896H240Zm200-160V410L336 514l-56-58 200-200 200 200-56 58-104-104v326h-80Z"/></svg><p class="icon_text">Upload</p></button>
        <button class="search icon search_icon active"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M784 936 532 684q-30 24-69 38t-83 14q-109 0-184.5-75.5T120 476q0-109 75.5-184.5T380 216q109 0 184.5 75.5T640 476q0 44-14 83t-38 69l252 252-56 56ZM380 656q75 0 127.5-52.5T560 476q0-75-52.5-127.5T380 296q-75 0-127.5 52.5T200 476q0 75 52.5 127.5T380 656Z"/></svg><p class="icon_text">Search</p></button>
    </div>
    <div class="middle_section spacer">
        <ul class="middle_section_list">
            <?php echo $icon; ?>
        </ul>
    </div>  
    <div class="bottom_section spacer">
        <button class="info icon info_icon"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M440 776h80V536h-80v240Zm40-320q17 0 28.5-11.5T520 416q0-17-11.5-28.5T480 376q-17 0-28.5 11.5T440 416q0 17 11.5 28.5T480 456Zm0 520q-83 0-156-31.5T197 859q-54-54-85.5-127T80 576q0-83 31.5-156T197 293q54-54 127-85.5T480 176q83 0 156 31.5T763 293q54 54 85.5 127T880 576q0 83-31.5 156T763 859q-54 54-127 85.5T480 976Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg><p class="icon_text">Info</p></button>
        <button class="help icon help_icon"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M478 816q21 0 35.5-14.5T528 766q0-21-14.5-35.5T478 716q-21 0-35.5 14.5T428 766q0 21 14.5 35.5T478 816Zm-36-154h74q0-33 7.5-52t42.5-52q26-26 41-49.5t15-56.5q0-56-41-86t-97-30q-57 0-92.5 30T342 438l66 26q5-18 22.5-39t53.5-21q32 0 48 17.5t16 38.5q0 20-12 37.5T506 530q-44 39-54 59t-10 73Zm38 314q-83 0-156-31.5T197 859q-54-54-85.5-127T80 576q0-83 31.5-156T197 293q54-54 127-85.5T480 176q83 0 156 31.5T763 293q54 54 85.5 127T880 576q0 83-31.5 156T763 859q-54 54-127 85.5T480 976Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg><p class="icon_text">Help</p></button>
        <button class="exit icon exit_icon" onclick="window.location.href='../index.html';"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24"><path d="M200 936q-33 0-56.5-23.5T120 856V696h80v160h560V296H200v160h-80V296q0-33 23.5-56.5T200 216h560q33 0 56.5 23.5T840 296v560q0 33-23.5 56.5T760 936H200Zm220-160-56-58 102-102H120v-80h346L364 434l56-58 200 200-200 200Z"/></svg><p class="icon_text">Exit</p></button>
    </div>

    <menubody></menubody>
</sidebar>

<?php include('includes/foot.inc.php'); ?>