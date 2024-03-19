<?php
session_start();
$db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

if (!$db) {
    echo "Error: Unable to connect to the database.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

    $targetid = trim($_POST["targetid"]);
    if (strlen($targetid) != 9) {
        echo "Error: Student ID should be 9 characters long.";
        exit();
    }

    // Fetching student information
    $query_student = "SELECT * FROM student WHERE usid = $1";
    $result_student = pg_query_params($db, $query_student, array($targetid));
    $student = pg_fetch_assoc($result_student);
    $course = "course" . $student["courseid"];

    // Fetching target student marks
    $query_marks = "SELECT * FROM $course WHERE usid = $1";
    $result_marks = pg_query_params($db, $query_marks, array($targetid));
    $targetsmarks = pg_fetch_assoc($result_marks);


    // After fetching student information
    if ($result_student && $result_marks) {
        if (!empty($targetsmarks) && !empty($student)) {
            $_SESSION["targetid"] = $targetid;
            $_SESSION["targetcourse"] = $course;
            header("Location: ./updating_marks.php");
            pg_close($db);
            exit();
        } else {
            unset($_SESSION["targetid"]);
            header("Location: ./update_marks.php?IDNotExist=true");
            pg_close($db);
            exit();
        }
    } else {
        // Query execution error
        echo "Error: Unable to fetch student information or target student marks.";
        echo "Error: " . pg_last_error($db);
        unset($_SESSION["targetid"]);
        header("Location: ./update_marks.php?IDNotExist=true");
        pg_close($db);
        exit();
    }
    pg_close($db);
}
?>

<html>

<head>
    <title>Update_marks</title>
    <link rel="stylesheet" href="../../../STYLE/nav.css">
    <style>
        p {
            font-size: large;
            font-weight: bold;
            margin-top: 4vh;
            margin-bottom: 15px;
        }

        input {
            margin: 0px;
            padding: 0px;
            background-color: rgba(216, 216, 216, 0.726);
        }

        form {
            height: 30vh;
            width: 30%;
            background-color: white;
            margin: 15% 35% 5% 35%;
            padding-top: 10vh;
            border-radius: 30px;
        }

        body {
            background-color: lightgrey;
        }
    </style>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const marksupdated = urlParams.get('MarksUpdated');
        const idnotexist = urlParams.get('IDNotExist')

        if (marksupdated) {
            alert("Marks Updated Successfully");
        } else if (idnotexist) {
            alert("ID does not exist");
        }

        function validate_id(event) {
            const clickedButton = event.submitter;

            if (clickedButton.name === "submit") {
                console.log("Submit button clicked");
                const id = document.getElementById("targetid").value.trim();

                if (id.length != 9) {
                    alert("Length should be 9");
                    return false;
                }

            } else console.log("Invalid form submission");

            return true;
        }
    </script>
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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate_id(event)">
                <p>Enter Student ID</p>
                <input type="text" name="targetid" id="targetid"><br><br>
                <input type="submit" value="Submit" name="submit">
            </form>
        </center>
    </div>
</body>

</html>