<?php
session_start();
$db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

if (!$db) {
    echo "Error: Unable to connect to the database.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $targetid = $_SESSION["targetid"];
    $targettype = $_SESSION["targettype"];
    $idtype = $_SESSION["idtype"];

    if (!empty($targettype) && !empty($idtype)) {
        $query1 = "SELECT * FROM $targettype WHERE $idtype = $1";
        $result1 = pg_query_params($db, $query1, [$targetid]);

        if ($result1) {
            $row1 = pg_fetch_assoc($result1);
            $keys = array_keys($row1);
            $values = array();
            foreach ($keys as $key) {
                $values[$key] = $_POST["$key"];
            }

            // Construct the UPDATE query
            $updateQuery = "UPDATE $targettype SET ";
            $setClauses = array();
            foreach ($values as $key => $value) {
                $setClauses[] = "$key = $" . (count($setClauses) + 2); // Placeholder for the parameterized query
            }
            $updateQuery .= implode(", ", $setClauses);
            $updateQuery .= " WHERE $idtype = $1";

            // Execute the UPDATE query with parameters
            $params = array_merge([$targetid], array_values($values));
            $resultUpdate = pg_query_params($db, $updateQuery, $params);

            if ($resultUpdate) {
                header("Location: ./" . $targettype . "_actions/change_" . $targettype . "_info.php?UpdateSuccessful=true");
            } else {
                // Query execution error
                echo "Error: " . pg_last_error($db);
            }
        } else {
            // Query execution error
            echo "Error: " . pg_last_error($db);
        }
    } else {
        echo "Error: Target type or ID type not set.";
    }
}

?>

<html>

<head>
    <title>Changing Info</title>
    <link rel="stylesheet" href="../../STYLE/nav.css">
    <style>
        table {
            border-collapse: collapse;
            width: 30vw;
            margin: 2vh;
            margin-top: 4vh;
            background-color: rgba(142, 219, 255, 0.507);
        }


        td {
            border: 0px solid rgba(142, 219, 255, 0.507);
            padding: 3vh;
            text-align: left;
        }

        h2 {
            text-align: center;
            font-size: large;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            margin-top: 10vh;
        }
    </style>
</head>

<body>
    <nav>
        <?php
        //self information
        $user_id = strval($_SESSION["user_id"]);
        $query = "SELECT name FROM admin WHERE uaid = $1";
        $result = pg_query_params($db, $query, [$user_id]);

        $targetid = strval($_SESSION["targetid"]);
        $targettype = strval($_SESSION["targettype"]);
        if ($targettype === "student") {
            $idtype = "usid";
        } elseif ($targettype === "teacher") {
            $idtype = "utid";
        } elseif ($targettype === "admin") {
            $idtype = "uaid";
        }

        session_start();
        $_SESSION["targetid"] = $targetid;
        $_SESSION["targettype"] =  $targettype;
        $_SESSION["idtype"] = $idtype;

        $query1 = "SELECT * FROM $targettype WHERE $idtype = $targetid::varchar";
        $result1 = pg_query($db, $query1);

        if ($result1) {
            $row1 = pg_fetch_assoc($result1);

            if ($row1) {
            } else {
                header("Location: ../../login.html");
                exit();
            }
        } else {
            // Query execution error
            echo "Error hi: " . pg_last_error($db);
        }

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
        <center>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <?php
                echo "<h2>" . $targettype . " ID : " . $targetid . "<br>Name : " . $row1["name"] . "</h2>";
                echo "<table id=infotable>";
                foreach ($row1 as $key => $value) {
                    echo "<tr><td>" . $key . "</td><td><input type='text' name='" . $key  . "' value='" . $value . "' name='" . $key . "' id='" . $key . "' required></td></tr>";
                }
                echo "</table>";
                ?>
                <br><input type="submit" value="Update" name="submit">
            </form>
        </center>
    </div>
</body>

</html>