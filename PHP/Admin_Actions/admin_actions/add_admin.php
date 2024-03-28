<?php
session_start();
$db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

if (!$db) {
    echo "Error: Unable to connect to the database.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    // Validate and sanitize input data
    $target_uaid = pg_escape_string($db, $_POST["uaid"]);
    $target_password = pg_escape_string($db, $_POST["password"]);
    $target_name = pg_escape_string($db, $_POST["name"]);
    $target_mail = pg_escape_string($db, $_POST["mail"]);
    $target_mobile = pg_escape_string($db, $_POST["mobile"]);

    // Check if teacher with given utid already exists
    $query1 = "SELECT * FROM admin WHERE uaid = $1";
    $result1 = pg_query_params($db, $query1, [$target_uaid]);

    if ($result1) {
        $row1 = pg_fetch_assoc($result1);

        if (empty($row1)) {
            // Insert new student
            $query2 = "INSERT INTO admin VALUES ($1, $2, $3, $4, $5)";
            $result2 = pg_query_params($db, $query2, [$target_uaid, $target_password, $target_name, $target_mail, $target_mobile]);

            if ($result2) {
                header("Location: ./add_admin.php?AddSuccess=true");
                exit();
            } else {
                // Query execution error
                echo "Error: Unable to add admin.";
                exit();
            }
        } else {
            header("Location: ./add_admin.php?AlreadyExist=true");
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
    <title>Add Admin</title>
    <link rel="stylesheet" href="../../../STYLE/nav.css">
    <link rel="stylesheet" href="../../../STYLE/A_S_add_student.css">
    <script>
        function alertInfo() {
            const urlParams = new URLSearchParams(window.location.search);
            const addsuccess = urlParams.get('AddSuccess');
            const alreadyexist = urlParams.get('AlreadyExist');

            if (addsuccess) {
                alert("Admin Added Successfully");
            }
            if (alreadyexist) {
                alert("Cannot Add Admin, ID Already Exists");
            }
            return true;
        }

        function validateForm(event) {
            const clickedButton = event.submitter;

            if (clickedButton.name === "submit") {
                console.log("Add button clicked");
                const password = document.getElementById("password").value;

                if (password.length < 6) {
                    alert("Password should be atleast 6 characters long");
                    return false;
                }

            } else console.log("Invalid form submission");

            return true;
        }
    </script>
</head>

<body onload="alertInfo()">
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
            <h2>Admin Details</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateForm(event)">
                <table id="infotable">
                    <tr>
                        <td>uaid</td>
                        <td><input type="text" name="uaid" id="uaid" pattern="1[0-9]{4}" required></td>
                        <td>password</td>
                        <td><input type="password" name="password" id="password" required></td>
                    </tr>
                    <tr>
                        <td>name</td>
                        <td><input type="text" name="name" id="name" required></td>
                        <td>mail</td>
                        <td><input type="text" name="mail" id="mail" required></td>
                    </tr>
                    <tr>
                        <td>mobile</td>
                        <td><input type="text" name="mobile" id="mobile" pattern="[0-9]+" required></td>
                    </tr>
                </table>
                <input type="submit" value="Add" name="submit">
            </form>
        </center>
    </div>
</body>

</html>