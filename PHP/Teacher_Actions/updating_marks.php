<?php
session_start();
$db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

if (!$db) {
    echo "Error: Unable to connect to the database.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

    $targetid = $_SESSION["targetid"];

    $query_student = "SELECT * FROM student WHERE usid = $1";
    $result_student = pg_query_params($db, $query_student, array($targetid));
    $targetstudent = pg_fetch_assoc($result_student);

    $course = "course" . $targetstudent["courseid"];
    $query_marks = "SELECT * FROM $course WHERE usid = $1";
    $result_marks = pg_query_params($db, $query_marks, array($targetid));
    $studentmarks = pg_fetch_assoc($result_marks);
    unset($studentmarks["usid"]);

    foreach ($studentmarks as $subject => $marks) {
        $input_marks = $_POST[$subject]; // Get the marks from the POST data
        // Update query with parameterized query and correct parameters
        $query_update = "UPDATE $course SET $subject = $1 WHERE usid = $2";
        $result_update = pg_query_params($db, $query_update, array($input_marks, $targetid));
    }
    pg_close($db);

    header("Location: ./update_marks.php?MarksUpdated=true");
    exit();
}
?>

<html>

<head>
    <title>Menu Update Marks</title>
    <link rel="stylesheet" href="../../STYLE/nav.css">
    <link rel="stylesheet" href="../../STYLE/teacher_updating_marks.css">
    <script>
        function validate_updation(event) {
            const clickedButton = event.submitter;

            if (clickedButton.name === "update") {
                console.log("Update button clicked");

                const textInputs = document.querySelectorAll('input[type="text"]');

                for (let i = 0; i < textInputs.length; i++) {
                    const inputValue = textInputs[i].value.trim();

                    if (inputValue === "" || isNaN(inputValue)) {
                        alert("Input must be a non-empty number");
                        return false;
                    }

                    if (Number(inputValue) < 0 || Number(inputValue) > 100) {
                        alert("Input must be a number between 0 and 100");
                        return false;
                    }
                }

            } else console.log("Invalid form submission");

            return confirm("Are you sure you want to update marks?");
        }
    </script>


</head>

<body>
    <nav>
        <?php
        if (isset($_SESSION["user_id"])) {
            //Teacher info
            $user_id = strval($_SESSION["user_id"]);
            $query = "SELECT * FROM teacher WHERE utid = $1";
            $result = pg_query_params($db, $query, [$user_id]);

            //Target student info
            $targetid = $_SESSION["targetid"];
            $query = "SELECT * FROM student WHERE usid = $1";
            $result1 = pg_query_params($db, $query, array($targetid));
            $targetstudent = pg_fetch_assoc($result1);

            //Target Student Course info
            $course = "course" . $targetstudent["courseid"];
            $query2 = "SELECT * FROM $course WHERE usid = $1";
            $result2 = pg_query_params($db, $query2, [$targetid]);
            $studentmarks = pg_fetch_assoc($result2);
            unset($studentmarks["usid"]);

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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate_updation(event)">
                <?php
                echo "<h2>Student ID : " . $targetstudent["usid"] . "<br>Name : " . $targetstudent["name"] . "</h2>";
                echo "<table id=markstable>";
                echo "<tr><th>Subject</th><th>Marks</th></tr>";
                foreach ($studentmarks as $subject => $marks) {
                    echo "<tr><td>" . $subject . "</td><td><input type='text' name='" . $subject  . "' value='" . $marks . "' pattern='[0-9]+' required></td></tr>";
                }
                echo "</table>";
                ?>
                <br><input type="submit" value="Update" name="submit">
            </form>
        </center>
    </div>
</body>

</html>