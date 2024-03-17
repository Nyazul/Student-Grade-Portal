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
    <title>Menu Feedback</title>
    <link rel="stylesheet" href="../../STYLE/nav.css">
    <link rel="stylesheet" href="../../STYLE/student_feedback.css">
    <script>
        function validateForm(event) {

            const clickedButton = event.submitter;

            if (clickedButton.name === "submit") {
                console.log("Submit Feedback button clicked");
                const head = document.getElementById("title").value;
                const body = document.getElementById("body").value;

                if (head.trim() === "" || body.trim() === "") {
                    alert("Please enter both Title and Body.");
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
        pg_close($db);
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
        <div id="content">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateForm(event)">
                <h2><b>Title</b></h2>
                <input type="text" name="title" id="title">
                <h2><b>Body</b></h3>
                <textarea name="body" id="" cols="50" rows="15"></textarea><br><br>
                <input type="submit" name="submit" value="Submit Feedback">
            </form>
        </div>
    </div>
</body>

</html>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

    if (!$db) {
        echo "Error: Unable to connect to the database.";
        exit();
    }

    $userid = $_SESSION["user_id"];
    $usertype = $_SESSION["user_type"];
    $head = $_POST["title"];
    $body = $_POST["body"];


    $query = "INSERT INTO feedback (head, body, userid, usertype) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($db, $query, array($head, $body, $userid, $usertype));

    if ($result) {
        header("location: ../student_dashboard.php?FeedbackSubmitted=true");
        exit();
    } else {
        if (isset($_POST["change"])) {
            // Query execution error
            echo "Error hiee: " . pg_last_error($db);
        }
    }

    pg_close($db);
}

?>