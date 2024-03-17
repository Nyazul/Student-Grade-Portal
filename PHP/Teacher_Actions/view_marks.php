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
    <title>Menu View Marks</title>
    <link rel="stylesheet" href="../../STYLE/nav.css">
    <link rel="stylesheet" href="../../STYLE/teacher_view_marks.css">
</head>

<body>
    <nav>
        <?php
        $user_id = strval($_SESSION["user_id"]);
        $query = "SELECT * FROM teacher WHERE utid = $1";
        $result = pg_query_params($db, $query, [$user_id]);


        if ($result) {
            $row = pg_fetch_assoc($result);

            if ($row) {
                echo "<h1 id='nav_user_name'>" . strtoupper($row["name"]) . "</h1>";
                $courseid = $row["courseid"];
                $query = "SELECT * FROM course" . $courseid . " ORDER BY usid ASC";
                $result = pg_query($db, $query);

                $coursename = "course" . $courseid;
                $query1 = "SELECT name FROM course_metadata WHERE course = $1";
                $result1 = pg_query_params($db, $query1, [$coursename]);
                $coursename = pg_fetch_assoc($result1);

                if ($result) {
                    $rows = pg_fetch_all($result);
                    $subjects = array_keys($rows[0]);
                } else {
                    // Query execution error
                    echo "Error: Unable to fetch marks.";
                }
            } else {
                //Having no data in $row means the $_SESSION["user_id"] was empty implying indirect access
                header("Location: ../../login.html");
                exit();
            }
        } else {
            // Query execution error
            echo "Error: " . pg_last_error($db);
        }
        pg_close($db);
        ?>
        <ul>
            <li class="nav_menu_options" id="menu_dashboard"><a href="../teacher_dashboard.php">Dashboard</a></li>
            <li class="nav_menu_options" id="menu_update_marks"><a href="./update_marks.php">Update Marks</a></li>
            <li class="nav_menu_options" id="menu_view_marks"><a href="./view_marks.php">View Marks</a></li>
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