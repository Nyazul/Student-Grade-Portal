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
    <title>Update Info</title>
    <link rel="stylesheet" href="../STYLE/update_info.css">
    <script>
        function validate_info(event) {
            const clickedButton = event.submitter;

            if (clickedButton.name === "change") {
                console.log("Change button clicked");
                const password = document.getElementById("password").value.trim();
                const mail = document.getElementById("mail").value.trim();
                const mobile = document.getElementById("mobile").value.trim();

                if (password === "" || mail === "" || mobile === "") {
                    alert("Fields cannot be empty");
                    return false;
                } else if (password.length < 6) {
                    alert("Password Length should be atleast 6");
                    return false;
                }

            } else console.log("Invalid form submission");

            return true;
        }
    </script>
</head>

<body>
    <?php
    $user_id = strval($_SESSION["user_id"]);
    $tablename = $_SESSION["user_type"];
    if ($tablename === "student") {
        $idtype = "usid";
    } elseif ($tablename === "teacher") {
        $idtype = "utid";
    } elseif ($tablename === "admin") {
        $idtype = "uaid";
    }

    $query = "SELECT * FROM $tablename WHERE $idtype = $1";
    $result = pg_query_params($db, $query, [$user_id]);

    if ($result) {
        $row = pg_fetch_assoc($result);

        $name = $row["name"];
        $password = $row["password"];
        $mail = $row["mail"];
        $mobile = $row["mobile"];

        if (!$row) {
            //Having no data in $row means the $_SESSION["user_id"] was empty implying indirect access
            header("Location: ../login.html");
            exit();
        }
    } else {
        // Query execution error
        echo "Error : " . pg_last_error($db);
    }
    pg_close($db);
    ?>

    <div id="body">
        <center id="content">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validate_info(event)">
                <p>Password</p>
                <input type="password" name="password" id="password" value="<?php echo $password; ?>">
                <p>Mail</p>
                <input type="text" name="mail" id="mail" value="<?php echo $mail; ?>">
                <p>Mobile</p>
                <input type="text" name="mobile" id="mobile" value="<?php echo $mobile; ?>"><br><br>
                <input type="submit" name="change" value="Change Info">
            </form>
        </center>
    </div>
</body>

</html>

<?php
session_start();

$db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

if (!$db) {
    echo "Error: Unable to connect to the database.";
    exit();
}

$id = $_SESSION["user_id"];
$tablename = $_SESSION["user_type"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];

if ($tablename === "student") {
    $idtype = "usid";
} elseif ($tablename === "teacher") {
    $idtype = "utid";
} elseif ($tablename === "admin") {
    $idtype = "uaid";
}

$query = "UPDATE $tablename SET password = $1, mail = $2, mobile = $3 WHERE $idtype = $4";
$result = pg_query_params($db, $query, array($password, $mail, $mobile, $id));

if ($result) {
    header("location: ./" . $tablename . "_dashboard.php?InfoChanged=true");
    exit();
} else {
    if (isset($_POST["change"])) {
        // Query execution error
        echo "Error hiee: " . pg_last_error($db);
    }
}

pg_close($db);

?>