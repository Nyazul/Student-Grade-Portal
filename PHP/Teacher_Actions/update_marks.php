<?php
session_start();
$db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

if (!$db) {
    echo "Error: Unable to connect to the database.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    // Validate and sanitize input
    $targetid = trim($_POST["targetid"]);
    if (strlen($targetid) != 9) {
        echo "Error: Student ID should be 9 characters long.";
        exit();
    }

    // Fetching teacher information
    $id = $_SESSION["user_id"];
    $query_teacher = "SELECT * FROM teacher WHERE utid = $1";
    $result_teacher = pg_query_params($db, $query_teacher, array($id));
    $teacher = pg_fetch_assoc($result_teacher);
    $course = "course" . $teacher["courseid"];

    // Fetching target student information
    $query_target = "SELECT * FROM $course WHERE usid = $1"; // Corrected query
    $result_target = pg_query_params($db, $query_target, array($targetid));
    $targetstudent = pg_fetch_assoc($result_target);

    if ($result_teacher && $result_target) {
        if (!empty($targetstudent)) {
            $_SESSION["targetid"] = $targetid;
            header("Location: ./updating_marks.php");
            exit();
        } else {
            unset($_SESSION["targetid"]);
            header("Location: ./update_marks.php?IDNotExist=true");
            exit();
        }
    } else {
        // Query execution error
        echo "Error: " . pg_last_error($db);
    }

    pg_close($db);
}
?>

<html>

<head>
    <title>Menu Update Marks</title>
    <link rel="stylesheet" href="../../STYLE/nav.css">
    <link rel="stylesheet" href="../../STYLE/teacher_update_marks.css">
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
        if (isset($_SESSION["user_id"])) {
            $user_id = strval($_SESSION["user_id"]);
            $query = "SELECT name FROM teacher WHERE utid = $1";
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
        } else {
            // Redirect if user is not logged in
            header("Location: ../../login.html");
            exit();
        }
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