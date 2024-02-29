<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["change"])) {
    session_start();

    $db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

    if (!$db) {
        echo "Error: Unable to connect to the database.";
        exit();
    }

    $id = $_SESSION["user_id"];
    $tablename = $_SESSION["user_type"];
    $password = $_POST["pass1"];
    if ($tablename === "student") {
        $idtype = "usid";
    } elseif ($tablename === "teacher") {
        $idtype = "utid";
    } elseif ($tablename === "admin") {
        $idtype = "uaid";
    }

    $query = "UPDATE $tablename SET password = $1 WHERE $idtype = $2";
    $result = pg_query_params($db, $query, array($password, $id));

    if ($result) {
        header("location: ../login.html?PasswordUpdated=true");
        exit();
    } else {
        // Query execution error
        echo "Error: " . pg_last_error($db);
    }

    pg_close($db);
} else {
    // Invalid form submission
    header("Location: forgot_password.php");
}
?>
