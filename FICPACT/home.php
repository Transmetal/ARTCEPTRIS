<?php
include 'config.php';
session_start();


if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null;
}

$sql = "SELECT * FROM tblmovie";
$all_movie = $conn->query($sql);

$select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
if(mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
} else {
    $fetch = null;
}

if(isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}


$itemsPerPage = 3;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $itemsPerPage;
$sql = "SELECT * FROM tblmovie LIMIT $offset, $itemsPerPage";
$all_movie = $conn->query($sql);


$totalMovies = $conn->query("SELECT COUNT(*) FROM tblmovie")->fetch_row()[0];
$totalPages = ceil($totalMovies / $itemsPerPage);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="icon" type="image/x-icon" href="css/images/logo.png">
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <header class="header" style="box-shadow:0 10px 10px rgba(0,0,0,.2);">

        <a href="home.php" class="logo">ARTCEPTRIS</a>
        <nav class="navbar">
            <a href="#home"></i>Home</a>
            <a href="#movies">Movies</a>
            <a href="#contact">Contact Us</a>
            <a href="ticketshistory.php">Tickets</a>
            <a href="update_profile.php"></i> Profile </a>
            <a href="login.php?logout=1 " class="logout">Log-Out</a>
        </nav>
        <div id="menu-bars" class="fas fa-bars">

        </div>


    </header>

    <script src="js/navbar.js"></script>


    <section class="home" id="home">
        <div class="content">
            <h3>Your Universe of Movies</h3>
            <h3>WITH ARTCEPTRIS</h3>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="css/images/card1.png" />
                </div>
                <div class="swiper-slide">
                    <img src="css/images/card2.png" />
                </div>
                <div class="swiper-slide">
                    <img src="css/images/card3.png" />
                </div>
                <div class="swiper-slide">
                    <img src="css/images/card4.png" />
                </div>
                <div class="swiper-slide">
                    <img src="css/images/card5.png" />
                </div>
                <div class="swiper-slide">
                    <img src="css/images/card6.png" />
                </div>
                <div class="swiper-slide">
                    <img src="css/images/card7.png" />
                </div>
                <div class="swiper-slide">
                    <img src="css/images/card8.png" />
                </div>
                <div class="swiper-slide">
                    <img src="css/images/card9.png" />
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    </section>
	</div>
    <section class="con" id="movies">
            <div class="content2">
                <h3>Upcoming <span>Movies</span></h3>
                <p class="intro"> Get ready for an unforgettable cinematic journey! 
                    We are thrilled to present our upcoming movies, where the screen will come alive with mesmerizing performances 
                    from some of the most renowned stars in the industry. From heart-pounding action to soulful dramas and electrifying adventures, 
                    our films promise a captivating fusion of genres that will leave you spellbound. Join us for a night of storytelling, emotion, 
                    and pure movie magic.</p>
            </div>
            <?php
            $startPage = max(1, $page - 2);
            $endPage = min($totalPages, $startPage + 4);

            // Adjust startPage if necessary to display 5 pages
            if($endPage - $startPage + 1 < 5) {
                $startPage = max(1, $endPage - 4);
            }
            ?>
            <div class="pagination">
                <?php if($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>">&lt;</a>
                <?php endif; ?>

                <?php for($i = $startPage; $i <= $endPage; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" <?php if($i == $page)
                           echo 'class="active"'; ?>>
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">&gt;</a>
                <?php endif; ?>
            </div>
            <br>
            <?php
            while($row = $all_movie->fetch_assoc()) {
                $movieId = $row["movie_id"];
                $url = 'movie.php?movie_id='.urlencode($movieId);
                ?>
                <div class="container">
                    <div class="card">
                        <div class="imgBx">
                            <a href="<?php echo $url; ?>">
                                <?php echo '<img src="adminside/uploaded_img/'.$row["image"].'">'; ?>
                                <h2><br>
                                    <?php echo $row["movie_name"]; ?>
                                </h2>
                                <div class="desc">
                                    <p><br>Artist Name:
                                        <?php echo $row["movie_artist"]; ?><br>
                                        Movie Date:
                                        <?php echo date('F j, Y', strtotime($row['movie_date'])); ?><br>
                                        Movie ID:
                                        <?php echo $row["movie_id"]; ?><br>
                                        Genre:
                                        <?php echo $row["movie_genre"]; ?> <br>
                                        Venue:
                                        <?php echo $row["movie_venue"]; ?>
                                    </p>
                                </div>
                                <div class="button-container">
                                    <a class="button" href="<?php echo $url; ?>">Learn More</a>
                                </div>
                        </div>
                    </div>
                    <?php
            }
            ?>
            </div>

        </section>

	<section class="section section-light">		
		<h2>Kimetsu no Yaiba</h2>
		<p>
        The Demon Slayer Corps plunge into Infinity Castle to defeat Muzan. However, the remaining Hashira and the Demon Slayers who survived Tanjiro's Final Selection are pitted against the last of the Twelve Kizuki first.		</p>
	</section>
	<div class="pimg2">
		<div class="ptext">
			<span class="border trans">
				Kimetsu no Yaiba
			</span>
		</div>
	</div>
	
	<section class="section section-dark">		
		<h2>Attack on Titan</h2>
		<p>
        The fate of the world hangs in the balance as Eren unleashes the ultimate power of the Titans. With a burning determination to eliminate all who threaten Eldia, he leads an unstoppable army of Colossal Titans towards Marley.		</p>
	</section>
	
	<div class="pimg3">
		<div class="ptext">
			<span class="border trans">
				Attack on Titan
			</span>
		</div>
	</div>

	<section class="section section-dark">		
		<h2>Dandadan</h2>
		<p>
        When Momo and Okarun's beliefs clash, they're thrown into a world of ghosts, aliens and awakened powers.		</p>
	</section> 

	<div class="pimg1">
		<div class="ptext">
        <span class="border trans">
				Dandadan
			</span>
		</div>
	</div>
    <section class="contact" id="contact">
        <h1 class="heading"><span>CONTACT US</span></h1>

        <p> We value your feedback, inquiries, and the opportunity to connect with our community. Whether you have a
            question about our products, need assistance with an order, or simply want to share your thoughts, we're
            here to help.

            Feel free to reach out to us using the contact form below, and our dedicated team will get back to you as
            soon as possible. We appreciate your interest in ARTCEPTRIS, and we look forward to assisting you.!</p>

        <div class="contactcon">
            <form action="https://formspree.io/f/mwkdgerp" method="POST">
                <div class="inputBox">
                    <input type="text" placeholder="name" name="Name" value="<?php echo $fetch['fullname'] ?>">
                    <input type="email" value="<?php echo $fetch['email'] ?>" placeholder="email" name="Email" readonly>
                </div>
                <div class="inputBox">
                    <input type="number" placeholder="number" name="Phonenumber"
                        value="<?php echo $fetch['phonenum'] ?>" readonly>
                    <select name="subject" id="subjectSelect">
                        <option value="" disabled selected>Select a subject</option>
                        <option value="Unlinking a Credit Card">Unlink Credit Card</option>
                        <option value="Reporting a Bug">Reporting a Bug</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <textarea name="Message" placeholder="your message" id="" cols="30" rows="10"> </textarea>
                <input type="submit" value="send message" class="btn">
            </form>
        </div>
    </section>

    <footer>

        <div class="row primary">
            <div class="columncomp">
                <h3>ARTCEPTRIS</h3>
                <br>
                <p>
                Welcome to ARTCEPTRIS, your virtual gateway to a world of cinematic experiences. 
                At ARTCEPTRIS, we believe in the power of film to connect, inspire, and create unforgettable moments. 
                Our platform is designed to bring the magic of movies directly to your screens, wherever you are.
                </p>
            </div>
            <div class="column links">
                <h3>Quick Links</h3>
                <br>
                <ul>
                    <li>
                        <a href="faq.html">F.A.Q</a>
                    </li>
                    <li>
                        <a href="ticketshistory.php">Tickets</a>
                    </li>
                    <li>
                        <a href="#movies">Upcoming Movies</a>
                    </li>
                </ul>
            </div>
            <div class="column subscribe">
                <form action="https://formspree.io/f/mwkdgerp" method="POST">
                    <h3>Subscribe</h3>
                    <br>
                    <div>
                        <input type="email" name="email " placeholder="Your email address here" />
                        <button>Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row copyright">
            <p>Copyright &copy; 2025 ARTCEPTRIS | All Rights Reserved</p>
        </div>
    </footer>
    <script src="js/home.js"></script>
</body>