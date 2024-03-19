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
    <title>Menu Student</title>
    <link rel="stylesheet" href="../../STYLE/nav.css">
    <link rel="stylesheet" href="../../STYLE/admin_student.css">
    <script src="../JS/admin_dashboard.js"></script>
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
                header("Location: ../../login.html");
                exit();
            }
        } else {
            // Query execution error
            echo "Error hi: " . pg_last_error($db);
        }
        pg_close($db);
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
            <h1 style="font-size: 5vw;">Student Actions</h1>
            <ul>
                <li class="menu_options" id="student_view_marks"><a href="./student_actions/view_marks.php">View Marks</a></li>
                <li class="menu_options" id="student_update_marks"><a href="./student_actions/update_marks.php">Update Marks</a></li>
                <li class="menu_options" id="student_add_student"><a href="./student_actions/add_student.php">Add Student</a></li>
                <li class="menu_options" id="student_remove_student"><a href="./student_actions/remove_student.php">Remove Student</a></li>
                <li class="menu_options" id="student_change_student_info"><a href="./student_actions/change_student_info.php">Change Student Info</a></li>
            </ul>
        </center>
    </div>
</body>

</html>