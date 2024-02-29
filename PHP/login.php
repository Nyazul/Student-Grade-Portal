<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");

    if (!$db) {
        echo "Error: Unable to connect to the database.";
        exit();
    }

    //Student Login
    if ($_POST["login_preference"] === "student" || $_POST["login_preference"] === "") {
        echo "Preference retrieved";
        $tablename = "student";
        $id = "usid";

        $query = "SELECT * FROM $tablename WHERE usid = $1 AND password = $2";
        $result = pg_query_params($db, $query, [$username, $password]);

        if ($result) {
            $row = pg_fetch_assoc($result);

            if ($row) {
                // Student login successful
                session_start();
                $_SESSION["user_id"] = $row["usid"];
                $_SESSION["user_type"] = "student";
                header("Location: student_dashboard.php");
                exit();
            } else {
                // Invalid credentials
                header("Location: ../login.html?invalid=true");
            }
        } else {
            // Query execution error
            echo "Error: " . pg_last_error($db);
        }
    //Teacher Login
    } elseif ($_POST["login_preference"] === "teacher") {

        $tablename = "teacher";
        $query = "SELECT * FROM $tablename WHERE utid = $1 AND password = $2";
        $result = pg_query_params($db, $query, [$username, $password]);

        if ($result) {
            $row = pg_fetch_assoc($result);

            //If user exists
            if ($row) {
                session_start();
                $_SESSION["user_id"] = $row["utid"];
                $_SESSION["user_type"] = "teacher";
                header("Location: teacher_dashboard.php");
                exit();        
            } else {
                // Invalid credentials
                header("Location: ../login.html?invalid=true");
            }
        } else {
            // Query execution error
            echo "Error: " . pg_last_error($db);
        }
    } elseif ($_POST["login_preference"] === "admin") {

        $tablename = "admin";
        $query = "SELECT * FROM $tablename WHERE uaid = $1 AND password = $2";
        $result = pg_query_params($db, $query, [$username, $password]);

        if ($result) {
            $row = pg_fetch_assoc($result);

            //If user exists
            if ($row) {
                session_start();
                $_SESSION["user_id"] = $row["uaid"];
                $_SESSION["user_type"] = "admin";
                header("Location: admin_dashboard.php");
                exit();        
            } else {
                // Invalid credentials
                header("Location: ../login.html?invalid=true");
            }
        } else {
            // Query execution error
            echo "Error: " . pg_last_error($db);
        }
    }
    pg_close($db);
} else {
    // Invalid form submission
    header("Location: ../login.html");
}
?>
