<?php
session_start();
$db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

if (!$db) {
    echo "Error: Unable to connect to the database.";
    exit();
}
?>

<html>

<head>
    <title>Menu Update Info</title>
    <link rel="stylesheet" href="../../STYLE/nav.css">
    <link rel="stylesheet" href="../../STYLE/student_update_info.css">
</head>

<body>
    <nav>
        <?php
        $user_id = strval($_SESSION["user_id"]);
        $query = "SELECT * FROM student WHERE usid = $1";
        $result = pg_query_params($db, $query, [$user_id]);

        if ($result) {
            $row = pg_fetch_assoc($result);

            $name = $row["name"];
            $password = $row["password"];
            $mail = $row["mail"];
            $mobile = $row["mobile"];

            if ($row) {
                echo "<h1 id='nav_user_name'>" . strtoupper($name) . "</h1>";
            } else {
                //Having no data in $row means the $_SESSION["user_id"] was empty implying indirect access
                header("Location: ../../login.html");
                exit();
            }
        } else {
            // Query execution error
            echo "Error : " . pg_last_error($db);
        }
        pg_close($db);
        ?>
        <ul>
            <li class="nav_menu_options" id="menu_dashboard"><a href="../student_dashboard.php">Dashboard</a></li>
            <li class="nav_menu_options" id="menu_view_result"><a href="./view_result.php">View Result</a></li>
            <li class="nav_menu_options" id="menu_download_result"><a href="./download_result.php">Download Result</a></li>
            <li class="nav_menu_options" id="menu_notices"><a href="./notices.php">Notices</a></li>
            <li class="nav_menu_options" id="menu_feedback"><a href="./feedback.php">Feedback</a></li>
            <li id="update_info" class="nav_menu_options"><a href="./update_info.php">Update Info</a></li>
            <li id="logout" class="nav_menu_options"><a href="../logout.php">Log Out</a></li>
        </ul>
    </nav>
    <div id="body">
        <center>
            <p id="clg_title">K K Wagh Arts, Commerce, Science and Computer Science College
                <?php echo "(" . $_SESSION['user_type'] . " account)"; ?>
            </p>
        </center>
        <center id="content">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <p>Password</p>
                <input type="password" name="password" id="password" value="<?php echo $password; ?>">
                <p>Mail</p>
                <input type="text" name="mail" id="mail" value="<?php echo $mail; ?>">
                <p>Mobile</p>
                <input type="text" name="mobile" id="mobile" value="<?php echo $mobile; ?>"><br><br>
                <input type="submit" name="change" value="Change Info">
            </form>
        </center>
    </div>
</body>

</html>

<?php
session_start();

$db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

if (!$db) {
    echo "Error: Unable to connect to the database.";
    exit();
}

$id = $_SESSION["user_id"];
$tablename = $_SESSION["user_type"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];

$query = "UPDATE $tablename SET password = $1, mail = $2, mobile = $3 WHERE usid = $4";
$result = pg_query_params($db, $query, array($password, $mail, $mobile, $id));

if ($result) {
    header("location: ../student_dashboard.php?InfoChanged=true");
    exit();
} else {
    if (isset($_POST["change"])) {
        // Query execution error
        echo "Error hiee: " . pg_last_error($db);
    }
}

pg_close($db);

?>