<?php
session_start();
$db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

if (!$db) {
    echo "Error: Unable to connect to the database.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $target_id = $_POST["id"];

    $query1 = "SELECT * FROM admin WHERE uaid = $1";
    $result1 = pg_query_params($db, $query1, [$target_id]);

    if ($result1) {
        $row1 = pg_fetch_assoc($result1);

        if (!empty($row1)) {
            $_SESSION["targetid"] = $target_id;
            $_SESSION["targettype"] = strval("admin");
            header("Location: ../changing_target_info.php");
            exit();
        } else {
            header("Location: ./change_admin_info.php?DoesNotExist=true");
            exit();
        }
    } else {
        // Query execution error
        echo "Error: " . pg_last_error($db);
    }
}



?>

<html>

<head>
    <title>Change Admin Info</title>
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
            height: 35vh;
            width: 30%;
            background-color: white;
            margin: 15% 35% 5% 35%;
            padding-top: 10vh;
            border-radius: 30px;
        }

        body {
            background-color: rgba(142, 219, 255, 0.507);
        }
    </style>
    <script>
        function alertInfo() {
            const urlParams = new URLSearchParams(window.location.search);
            const infochanged = urlParams.get('UpdateSuccessful');
            const doesnotexist = urlParams.get('DoesNotExist');


            if (infochanged) {
                alert("Info Changed Successfully");
            } else if (doesnotexist) {
                alert("User does not exist!");
            }
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
        <center>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <p>Enter Student ID</p>
                <input type="text" name="id" id="id" pattern="1[0-9]{4}" required>
                <br><br><input type="submit" value="Submit" name="submit">
            </form>
        </center>
    </div>
</body>

</html>