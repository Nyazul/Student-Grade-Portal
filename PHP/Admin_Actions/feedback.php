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
    <title>Menu Feedback</title>
    <link rel="stylesheet" href="../../STYLE/nav.css">
    <link rel="stylesheet" href="../../STYLE/admin_feedback.css">
</head>

<body>
    <nav>
        <?php
        $user_id = strval($_SESSION["user_id"]);
        $query = "SELECT name FROM admin WHERE uaid = $1";
        $result = pg_query_params($db, $query, [$user_id]);

        if ($result) {
            $row = pg_fetch_assoc($result);

            if ($row) {
                echo "<h1 id='nav_user_name'>" . strtoupper($row["name"]) . "</h1>";
            } else {
                //Having no data in $row means the $_SESSION["user_id"] was empty implying indirect access
                header("Location: ../login.html");
                exit();
            }
        } else {
            // Query execution error
            echo "Error hi: " . pg_last_error($db);
        }
        ?>
        <ul>
            <li class="nav_menu_options" id="menu_dashboard"><a href="../admin_dashboard.php">Dashboard</a></li>
            <li class="nav_menu_options" id="menu_student"><a href="./student.php">Student</a></li>
            <li class="nav_menu_options" id="menu_teacher"><a href="./teacher.php">Teacher</a></li>
            <li class="nav_menu_options" id="menu_admin"><a href="./admin.php">Admin</a></li>
            <li class="nav_menu_options" id="menu_course"><a href="./course.php">Course</a></li>
            <li class="nav_menu_options" id="menu_notices"><a href="./notices.php">Notices</a></li>
            <li class="nav_menu_options" id="menu_feedback"><a href="./feedback.php">Feedback</a></li>
            <li id="update_info" class="nav_menu_options"><a href="../update_info.php">Update Info</a></li>
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
            <?php
            $query1 = "SELECT * FROM feedback ORDER BY time DESC";
            $result1 = pg_query($db, $query1);

            if ($result1) {
                while ($row = pg_fetch_assoc($result1)) {
                    echo "<div class=feedbackbox>";
                        echo "<h2 class=feedbackhead>" . $row['head'] . "</h2>";
                        echo "<p class=submitterinfo>Submitted by " . $row['usertype'] . " : " . $row['userid'] . "</p>";
                        echo "<p class=feedbacktime>" . $row['time'] . "</p>";
                        echo "<p classfeedbackebody>" . $row['body'] . "</p>";
                    echo "</div>";          
                }
            } else {
                // Query execution error
                echo "Error: Unable to fetch feedback.";
            }
            pg_close($db);
            ?>
        </center>
    </div>
</body>

</html>