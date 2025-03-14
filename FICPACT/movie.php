<?php
session_start();
$user_id = $_SESSION['user_id'];
include 'config.php';
$movieId = $_GET['movie_id'];
$_SESSION['movie_id'] = $movieId;


$sql = "SELECT * FROM tblmovie where movie_id='$movieId'";
$all_movie = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/movie.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Movie</title>
    <link rel="icon" type="image/x-icon" href="css/images/logo.png">
</head>

<body>
    <header class="header" style="box-shadow: 0 10px 10px rgba(0,0,0,.2);">
        <a href="home.php" class="logo">ARTCEPTRIS</a>
        <nav class="navbar">
            <a href="home.php"></i>Home</a>
            <a href="home.php#movies">Movies</a>
            <a href="home.php#about">About Us</a>
            <a href="home.php#contact">Contact Us</a>
            <a href="ticketshistory.php">Tickets</a>
            <a href="update_profile.php"></i> Profile </a>
        </nav>
        <div id="menu-bars" class="fas fa-bars">
        </div>
    </header>

    <script src="js/script.js"></script>
    <form method="POST" action="">
        <section class="movie" id="home">
            <?php

            while($row = $all_movie->fetch_assoc()) {
                ?>
                <div class="banner">
                    <h1 style="font-size:60px;">Movie Name:
                        <?php echo $row["movie_name"]; ?>
                    </h1>
                    <p>Movie Date:
                        <?php echo date('F j, Y', strtotime($row['movie_date'])); ?>
                    </p>

                    <a href="creditcard.php" name="update" class="cta-button">Buy Tickets</a>
                </div>
            </section>
            <div class="cardholder">
                <div class="card">
                    <p class="heading">
                        Artist Name:
                        <?php echo $row["movie_artist"]; ?>
                    </p>
                    <p>
                        <?php echo $row["movie_desc"]; ?>
                    </p>
                    <p> Contact:
                        <?php echo $row["movie_contact"]; ?>
                    </p>
                </div>
                <?php
            }
            ?>
</body>
</form>


<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "
    UPDATE user_db.seats
    JOIN admin_db.tblmovie ON user_db.seats.section = 'VIP' AND admin_db.tblmovie.movie_id = $movieId
    SET user_db.seats.price = admin_db.tblmovie.vipprice";

    if($conn->query($query) === TRUE) {
        echo "Seats updated successfully";
    } else {
        echo "Error updating seats: ".$conn->error;
    }

}
?>

</html>