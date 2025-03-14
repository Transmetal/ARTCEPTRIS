<?php
include "config.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
    die("Access denied. Please log in.");
}

$admin_id = $_SESSION['admin_id'];

if (!isset($conn) || !$conn instanceof mysqli) {
    die("Database connection is closed or not initialized.");
}

$select = mysqli_query($conn, "SELECT * FROM `admin` WHERE admin_id = '$admin_id'") 
    or die('Query failed: ' . mysqli_error($conn));

if(mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
} else {
    $fetch = null;
}
?>
<!DOCTYPE html>
<html lang="en" title="ARTCEPTRIS">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">


    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</head>


<div class="sidebar">
    <div class="sidebar-nav">
        <a href="#">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="viewbuyer.php">
            <i class="fas fa-ticket-alt"></i> Buyers
        </a>
        <a href="viewmovie.php">
            <i class="fas fa-music"></i> Movies
        </a>
        <a href="viewusers.php">
            <i class="fas fa-users"></i> Users
        </a>
        <a href="../login.php">
            <i class="fas fa-sign-out-alt"></i>
            </i> Exit
        </a>
    </div>
</div>

<style>

</style>

<body>
    <main class="table">
        <div class="scrollcon">
            <section class="table__header">
                <h1> Welcome Back,
                <svg>
		<text x="48%" y="81%"  text-anchor="middle"> <?php echo $fetch['admin_name'] ?>
		</text>
	</svg>
                </h1>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Admin Information :</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody class="admincon">
                        <tr>
                            <!-- First Column: Avatar -->
                            <td>
                                <div class="avatar-container">
                                    <img src="uploaded_img/avatar.png" alt="Avatar" class="avatar">
                                </div>
                            </td>
                            <!-- Second Column: Additional Information -->
                            <td>
                                <p><i class="fas fa-user icon"></i> Admin Name :</p>
                                <p>
                                    <?php echo $fetch['admin_name'] ?>
                                </p>
                                <br><br>
                                <p><i class="fas fa-calendar-alt icon"></i> Date Hired :</p>
                                <p>
                                    <?php echo date('F j, Y', strtotime($fetch['date_hired'])); ?>
                                </p>
                                <br><br>
                                <p><i class="fas fa-home icon "></i> Lived in :</p>
                                <p>
                                    <?php echo $fetch['admin_lived'] ?>
                                </p>

                            </td>
                            <!-- Third Column: Add more columns if needed -->
                            <td>
                                <p><i class="far fa-envelope icon"></i> Admin Email :</p>
                                <p>
                                    <?php echo $fetch['admin_email'] ?>
                                </p>
                                <br><br>
                                <p><i class="far fa-clock icon"></i> Time :</p>
                                <div id="clock"></div>

                                <script>
                                    function updateClock() {
                                        const singaporeTime = new Date().toLocaleString("en-US", {
                                            timeZone: "Asia/Singapore"
                                        });
                                        const timeString = singaporeTime.split(',')[1].trim(); // Extract time part
                                        document.getElementById('clock').innerText = timeString;
                                    }

                                    // Update the clock every second
                                    setInterval(updateClock, 1000);

                                    // Initial call to set the clock immediately
                                    updateClock();
                                </script>
                            </td>
                            <td class="hidden-cell">
                                <p>Admin Email: </p>
                                <p>
                                    <?php echo $fetch['admin_email'] ?>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Movie System Statistics :</th>
                            <th scope="col"></th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        ?>
                        <tr>
                            <td>
                                <div class="dashboard-container">
                                    <i class="fas fa-users"></i>

                                    <h2>Number of Users</h2>
                                    <p>
                                        <?php
                                        $sql = "SELECT COUNT(*) AS NumberOfUsers FROM user_form";
                                        $result = $conn->query($sql);

                                        if($result === false) {
                                            echo $conn->error;
                                        } else {
                                            $row = $result->fetch_assoc();
                                            if($row !== null && isset($row['NumberOfUsers'])) {
                                                $count = $row['NumberOfUsers'];
                                                echo $count;
                                            } else {
                                                // Handle unexpected result
                                                echo "No Users Available.";
                                            }
                                        }
                                        ?>
                                    </p>

                                </div>
                            </td>
                            <td>
                                <div class="dashboard-container">
                                    <i class="fas fa-ticket-alt"></i>

                                    <h2>Number of Ticket Transactions</h2>
                                    <p>

                                        <?php
                                        $sql = "SELECT COUNT(*) AS tickets FROM tblbuyer where status= 'Paid'";
                                        $result = $conn->query($sql);

                                        if($result === false) {
                                            echo $conn->error;
                                        } else {
                                            $row = $result->fetch_assoc();
                                            if($row !== null && isset($row['tickets'])) {
                                                $count = $row['tickets'];
                                                echo $count;
                                            } else {
                                                // Handle unexpected result
                                                echo "No Buyers Available";
                                            }
                                        }
                                        ?>


                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="dashboard-container">
                                    <i class="fas fa-music"></i>

                                    <h2>Number of Available Movies</h2>
                                    <p>

                                        <?php
                                        $sql = "SELECT COUNT(*) AS movie FROM tblmovie ";
                                        $result = $conn->query($sql);

                                        if($result === false) {
                                            echo $conn->error;
                                        } else {
                                            $row = $result->fetch_assoc();
                                            if($row !== null && isset($row['movie'])) {
                                                $count = $row['movie'];
                                                echo $count;
                                            } else {
                                                // Handle unexpected result
                                                echo "No Movies Available.";
                                            }
                                        }
                                        ?>

                                    </p> <!-- Replace with actual number of movies -->
                                </div>
                            </td>
                        </tr>
                        <?php
                        ?>
                    </tbody>




                </table>

            </section>

            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Movie Revenue Ranking Statistics:</th>
                            <th scope="col"></th>
                            <th scope="col"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        ?>
                        <tr>
                            <td>
                                <div class="dashboard-container">
                                    <i class="fa-solid fa-money-bill"></i>
                                    <h2>Daily Revenue</h2>
                                    <p>
                                        <?php
                                        date_default_timezone_set('Asia/Manila');
                                        $today = date("Y-m-d");
                                        $sql = "SELECT SUM(payment_price) AS today_revenue FROM tblbuyer WHERE payment_date = '$today' AND status ='Paid'";
                                        $result = $conn->query($sql);

                                        if($result === false) {
                                            echo "Error: ".$conn->error;
                                        } else {
                                            // Fetch the result row
                                            $row = $result->fetch_assoc();

                                            if($row !== null && isset($row['today_revenue'])) {
                                                $todayRevenue = $row['today_revenue'];
                                                echo "Today's Revenue: ".number_format($todayRevenue, 2);
                                            } else {
                                                // Handle unexpected result
                                                echo "No revenue available for today.";
                                            }
                                        }
                                        ?>
                                    </p>

                                </div>
                            </td>
                            <td>
                                <div class="dashboard-container">
                                    <i class="fa-solid fa-money-bill-trend-up"></i>
                                    <h2>Monthly revenue</h2>
                                    <p>

                                        <?php
                                        date_default_timezone_set('Asia/Manila');

                                        // Get the first and last day of the current month
                                        $firstDayOfMonth = date("Y-m-01");
                                        $lastDayOfMonth = date("Y-m-t");

                                        $sql = "SELECT SUM(payment_price) AS monthly_revenue FROM tblbuyer WHERE payment_date BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth' AND status ='Paid'";
                                        $result = $conn->query($sql);

                                        if($result === false) {
                                            echo "Error: ".$conn->error;
                                        } else {
                                            // Fetch the result row
                                            $row = $result->fetch_assoc();

                                            if($row !== null && isset($row['monthly_revenue'])) {
                                                $monthlyRevenue = $row['monthly_revenue'];
                                                echo "Monthly Revenue: ".number_format($monthlyRevenue, 2);
                                            } else {
                                                // Handle unexpected result
                                                echo "No revenue available for this month.";
                                            }
                                        }
                                        ?>

                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="dashboard-container">
                                    <i class="fa-solid fa-icons"></i>
                                    <h2>Top Most Selling Movie</h2>
                                    <p>
                                        <?php
                                        $sql = "SELECT movie_name, COUNT(*) as frequency FROM tblbuyer GROUP BY movie_name ORDER BY frequency DESC LIMIT 1";
                                        $result = $conn->query($sql);

                                        if($result === false) {
                                            echo "Error: ".$conn->error;
                                        } else {
                                            // Fetch the result row
                                            $row = $result->fetch_assoc();

                                            if($row !== null && isset($row['movie_name'])) {
                                                $topSellingMovie = $row['movie_name'];
                                                echo $topSellingMovie;
                                            } else {
                                                // Handle unexpected result
                                                echo "No data available.";
                                            }
                                        }

                                        // Close the connection
                                        $conn->close();
                                        ?>

                                    </p>
                                </div>

                            </td>
                        </tr>
                        <?php
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>