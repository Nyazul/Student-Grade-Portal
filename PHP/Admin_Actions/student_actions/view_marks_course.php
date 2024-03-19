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
    <title>Course Marks</title>
    <link rel="stylesheet" href="../../../STYLE/nav.css">
    <link rel="stylesheet" href="../../../STYLE/A_S_view_marks_course.css">
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
                $course = $_POST["selectedcourse"];
                $query1 = "SELECT name FROM course_metadata WHERE course = $1";
                $result1 = pg_query_params($db, $query1, [$course]);
                $coursename = pg_fetch_assoc($result1);

                $query2 = "SELECT * FROM " . $course . " ORDER BY usid ASC";
                $result2 = pg_query($db, $query2);

                if ($result2) {
                    $rows = pg_fetch_all($result2);
                    $subjects = array_keys($rows[0]);
                } else {
                    // Query execution error
                    echo "Error: Unable to fetch marks.";
                }
            } else {
                //Having no data in $row means the $_SESSION["user_id"] was empty implying indirect access
                header("Location: ../../../login.html");
                exit();
            }
        } else {
            // Query execution error
            echo "Error hi: " . pg_last_error($db);
        }
        pg_close($db);
        ?>
        <ul>
            <li class="nav_menu_options" id="menu_dashboard"><a href="../../admin_dashboard.php">Dashboard</a></li>
            <li class="nav_menu_options" id="menu_student"><a href="../student.php">Student</a></li>
            <li class="nav_menu_options" id="menu_teacher"><a href="../teacher.php">Teacher</a></li>
            <li class="nav_menu_options" id="menu_admin"><a href="../admin.php">Admin</a></li>
            <li class="nav_menu_options" id="menu_course"><a href="../course.php">Course</a></li>
            <li class="nav_menu_options" id="menu_notices"><a href="../notices.php">Notices</a></li>
            <li class="nav_menu_options" id="menu_feedback"><a href="../feedback.php">Feedback</a></li>
            <li id="update_info" class="nav_menu_options"><a href="../../update_info.php">Update Info</a></li>
            <li id="logout" class="nav_menu_options"><a href="../../logout.php">Log Out</a></li>
        </ul>
    </nav>
    <div id="body">
        <center>
            <p id="clg_title">K K Wagh Arts, Commerce, Science and Computer Science College
                <?php echo "(" . $_SESSION['user_type'] . " account)"; ?>
            </p>
        </center>
        <center>
            <?php
            echo "<h2>" . $coursename["name"] . " Results</h2>";
            if (!empty($rows)) {
                echo "<table id='markstable'>";
                echo "<tr>";
                foreach ($subjects as $subject) {
                    echo "<th>" . $subject . "</th>";
                }
                echo "</tr>";
                foreach ($rows as $row) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No marks available.";
            }
            ?>
        </center>
    </div>
</body>

</html>