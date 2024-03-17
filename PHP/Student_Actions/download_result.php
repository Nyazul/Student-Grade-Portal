<!DOCTYPE html>
<html>

<head>
    <title>Menu Download Result</title>
    <link rel="stylesheet" href="../../STYLE/nav.css">
    <link rel="stylesheet" href="../../STYLE/student_download_result.css">
</head>

<body>
    <nav>
        <?php
        session_start();
        $db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

        if (!$db) {
            echo "Error: Unable to connect to the database.";
            exit();
        }

        $user_id = strval($_SESSION["user_id"]);
        $query = "SELECT name FROM student WHERE usid = $1";
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
        ?>
        <ul>
            <li class="nav_menu_options" id="menu_dashboard"><a href="../student_dashboard.php">Dashboard</a></li>
            <li class="nav_menu_options" id="menu_view_result"><a href="./view_result.php">View Result</a></li>
            <li class="nav_menu_options" id="menu_download_result"><a href="./download_result.php">Download Result</a></li>
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
            <div id="content">
                <h1>K K Wagh Arts, Commerce, Science and Computer Science College</h1>
                <hr style="width: 70vw; height:3px; background-color:black">

                <?php
                $query = "SELECT * FROM student WHERE usid = $1";
                $result = pg_query_params($db, $query, [$user_id]);

                if ($result) {
                    $student_info = pg_fetch_assoc($result);

                    $coursename = "course" . $student_info["courseid"];
                    $query1 = "SELECT name FROM course_metadata WHERE course = $1";
                    $result = pg_query_params($db, $query1, [$coursename]);
                    $coursename = pg_fetch_assoc($result);


                    if ($student_info) {
                        echo "<table id='student_info_table'>";
                        echo "<tr><td><b>Course :</b></td><td colspan=2>" . $coursename["name"] . "</td></tr>";
                        echo "<tr><td><b>Student ID :</b></td><td>" . $student_info["usid"] . "</td><td><b>Roll No :</b></td><td>" . $student_info["rollno"] . "</td></tr>";
                        echo "<tr><td><b>Name :</b></td><td>" . $student_info["name"] . "</td><td><b>Course ID :</b></td><td>" . $student_info["courseid"] . "</td></tr>";

                        // Add more student info fields as needed
                        echo "</table>";
                    } else {
                        //Having no data in $row means the $_SESSION["user_id"] was empty implying indirect access
                        header("Location: ../../login.html");
                        exit();
                    }
                } else {
                    // Query execution error
                    echo "Error: " . pg_last_error($db);
                }
                ?>

                <hr style="width: 70vw; height:3px; background-color:black">

                <table>
                    <tr>
                        <th>Subject</th>
                        <th>Marks</th>
                    </tr>
                    <?php
                    $query = "SELECT courseid FROM student WHERE usid = $1";
                    $result = pg_query_params($db, $query, [$user_id]);
                    $row = pg_fetch_assoc($result);
                    $tablename = "course" . $row["courseid"];
                    $query = "SELECT * FROM $tablename WHERE usid = $1";
                    $result = pg_query_params($db, $query, [$user_id]);

                    $row = pg_fetch_assoc($result);
                    unset($row['usid']);

                    foreach ($row as $subject => $marks) {
                        echo "<tr>";
                        echo "<td>$subject</td>";
                        echo "<td>$marks</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>

                <?php
                $marks = array_values($row);
                $failed = min($marks) < 35;
                $result = $failed ? "<h3 style='color: red'><b>Result: Failed<b></h3>" : "<h3 style='color: green'><b>Result: Passed<b></h3>";
                echo $result;

                ?>
                <form id="pdfForm" action="./downloading_result.php" method="post">
                    <input type="submit" value="Print as PDF" onclick="generatePDF()">
                    <input type="hidden" name="course" value="<?php echo $coursename["name"];?>">
                    <input type="hidden" name="studentid" value="<?php echo $student_info["usid"];?>">
                    <input type="hidden" name="rollno" value="<?php echo $student_info["rollno"];?>">
                    <input type="hidden" name="name" value="<?php echo $student_info["name"];?>">
                    <input type="hidden" name="courseid" value="<?php echo $student_info["courseid"];?>">
                    <input type="hidden" name="marks" value="<?php echo htmlspecialchars(json_encode($row));?>">
                </form>
            </div>
            <?php
            pg_close($db);
            ?>
        </center>
    </div>
</body>

</html>

