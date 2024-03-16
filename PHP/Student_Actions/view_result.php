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
    <title>Menu View Result</title>
    <link rel="stylesheet" href="../../STYLE/nav.css">
    <link rel="stylesheet" href="../../STYLE/student_view_result.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        $query = "SELECT courseid FROM student WHERE usid = $1";
        $result = pg_query_params($db, $query, [$user_id]);
        $row = pg_fetch_assoc($result);
        $tablename = "course" . $row["courseid"];
        $query = "SELECT * FROM $tablename WHERE usid = $1";
        $result = pg_query_params($db, $query, [$user_id]);

        $row = pg_fetch_assoc($result);
        
        unset($row['usid']);


        pg_close($db);
        ?>


        <ul>
            <li class="nav_menu_options" id="menu_dashboard"><a href="../student_dashboard.php">Dashboard</a></li>
            <li class="nav_menu_options" id="menu_view_result"><a href="./view_result.php">View Result</a></li>
            <li class="nav_menu_options" id="menu_download_result"><a href="./download_result.php">Download Result</a></li>
            <li class="nav_menu_options" id="menu_notices"><a href="./notices.php">Notices</a></li>
            <li class="nav_menu_options" id="menu_feedback"><a href="./feedback.php">Feedback</a></li>
            <li id="update_info" class="nav_menu_options"><a href="./update_info.php">Update Info</a></li>
            <li id="logout" class="nav_menu_options"><a href="../logout.php">Log Out</a></li>
        </ul>
    </nav>
    <div id="body">
        <center>
            <p id="clg_title">K K Wagh Arts, Commerce, Science and Computer Science College
                <?php echo "(" . $_SESSION['user_type'] . " account)"; ?>
            </p>
        </center>
        <center id="content">
            <canvas id="myChart"></canvas>
            <p id="result" style="font-size: 2vw; font-weight: bold;"></p>
        </center>
    </div>
    <script>
        
        var labels = <?php echo json_encode(array_keys($row)); ?>;
        var data = <?php echo json_encode(array_values($row)); ?>;

        var datasetBackgroundColor = data.map(value => value < 35 ? 'rgba(255, 0, 0, 0.2)' : 'rgba(0, 0, 0, 0.2)');

        var failed = data.some(value => value < 35);
        var result = failed ? "Failed" : "Passed";

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Marks',
                    data: data,
                    backgroundColor: datasetBackgroundColor,
                    borderColor: 'rgba(0, 0, 0, 0.6)',
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Student Marks', 
                        font: {
                            size: 24,
                            weight: 'bold' 
                        },
                        color: '#333'
                    },
                    legend: {
                        display: false 
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                size: 14, 
                                weight: 'bold' 
                            },
                            color: '#666' 
                        }
                    },
                    y: {
                        ticks: {
                            font: {
                                size: 14, 
                                weight: 'normal' 
                            },
                            color: '#666'
                        }
                    }
                }
            }
        });

        document.getElementById('result').textContent = 'Result: ' + result;
    </script>
</body>

</html>