<?php
session_start();
$db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

if (!$db) {
    echo "Error: Unable to connect to the database.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    // Validate and sanitize input data
    $course_id = pg_escape_string($db, $_POST["cid"]);
    $table_name = "course" . $course_id;

    // Check if COURSE id already exists
    $query1 = "SELECT * FROM course_metadata WHERE course = $1";
    $result1 = pg_query_params($db, $query1, [$table_name]);

    if ($result1) {
        $row1 = pg_fetch_assoc($result1);

        if (empty($row1)) {
            header("Location: ./remove_course.php?DoesNotExist=true");
            exit();
        } else {
            // Insert new student
            $query2 = "DELETE FROM course_metadata WHERE course = $1";
            $result2 = pg_query_params($db, $query2, [$table_name]);

            $query3 = "DROP TABLE $table_name";
            $result3 = pg_query($db, $query3);

            if ($result2 && $result3) {
                header("Location: ./remove_course.php?RemoveSuccess=true");
                exit();
            } else {
                // Query execution error
                echo "Error: Unable to remove course.";
                exit();
            }
        }
    } else {
        // Query execution error
        echo "Error: " . pg_last_error($db);
    }
}

?>

<html>

<head>
    <title>Remove Course</title>
    <link rel="stylesheet" href="../../../STYLE/nav.css">
    <style>
        p {
            font-size: large;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 15px;
        }

        input {
            margin: 0px;
            padding: 0px;
        }

        form {
            height: 35%;
            width: 30%;
            background-color: white;
            margin: 5% 35% 5% 35%;
            padding-top: 12vh;
            border-radius: 30px;
        }

        body {
            background-color: rgba(142, 219, 255, 0.507);
        }
    </style>
    <script>
        function alertInfo() {
            const urlParams = new URLSearchParams(window.location.search);
            const removesuccess = urlParams.get('RemoveSuccess');
            const doesnotexist = urlParams.get('DoesNotExist');

            if (removesuccess) {
                alert("Course Removed Successfully");
            }
            if (doesnotexist) {
                alert("Cannot Remove Course, Does Not Exist");
            }
            return true;
        }
    </script>
</head>

<body onload="return alertInfo()">
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
        <center id="content">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <p>Enter Course ID</p>
                <input type="text" name="cid" id="cid" pattern="129[0-9]{3}" required>
                <br><br><input type="submit" value="Remove" name="submit">
            </form>
        </center>
    </div>
</body>

</html>