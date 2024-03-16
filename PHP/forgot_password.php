<html>
    <head>
        <title>Forgot Password</title>
        <link rel="stylesheet" href="../STYLE/forgot_password.css">
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <center>
                <p>Select User Type</p>
                <select name="user_type" id="user_type">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                    <option value="admin">Admin</option>
                </select>
                <p>Enter Username</p>
                <input type="text" name="user_id" value="<?php echo $_POST["user_id"];?>">
                <p>Enter Mobile</p>
                <input type="text" name="mobile" value="<?php echo $_POST["mobile"];?>">
                <p>Enter Mail</p>
                <input type="text" name="mail" value="<?php echo $_POST["mail"];?>"><br><br>
                <input type="submit" value="Verify" name="verify">
            </center>
        </form>
    </body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["verify"])) {
        
        $db = pg_connect("host=localhost port=5432 dbname=sgts_db user=postgres password=nyaz@inny");
        if (!$db) {
            echo "Error: Unable to connect to the database.";
            exit();
        }
        session_start();
        $_SESSION["user_id"] = $_POST["user_id"];
        $_SESSION["user_type"] = $_POST["user_type"];

        $tablename = $_POST["user_type"];
        $id = $_POST["user_id"];
        $mail = $_POST["mail"];
        $mobile = $_POST["mobile"];

        if ($tablename === "student") {
            $idtype = "usid";
        } elseif ($tablename === "teacher") {
            $idtype = "utid";
        } elseif ($tablename === "admin") {
            $idtype = "uaid";
        }

        $query = "SELECT * FROM $tablename WHERE $idtype = $1 AND mail = $2 AND mobile = $3";
        $result = pg_query_params($db, $query, [$id, $mail, $mobile]);

        if ($result) {
            $row = pg_fetch_assoc($result);

            if ($row) {
                //Continue Debugging
                header("Location: ../reset_password.html");
                exit();
            } else {
                // Invalid credentials
                echo "<script>alert('Credentials do not match!!');</script>";
            }
        } else {
            // Query execution error
            echo "Error: " . pg_last_error($db);
        }

            
    }
?>