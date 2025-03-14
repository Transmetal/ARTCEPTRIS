<?php
include 'config.php';
$sql = "SELECT * FROM tblmovie order by movie_date";
$all_movie = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>ARTCEPTRIS</title>
    <link rel="icon" type="image/x-icon" href="css/images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
    <div class="hero">
        <video autoplay loop muted plays-inline class="back-video">
            <source src="" type="video/mp4">
        </video>

        <nav>
            <img src="css/images/logo.png" class="logo" width=100px>
            <ul>
            <li><a href="register.php"></i> SIGN UP
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </a></li>
        <li><a href="login.php"> LOGIN
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </a></li>
            </ul>
        </nav>
        <div class="content">
        <div class="rugged">
	<svg>
		<text x="50%" y="50%" dy=".35em" text-anchor="middle">
			ARTCEPTRIS
		</text>
	</svg>
    </div>

            <p>
                <br>
                </i> Showcasing the finest films across Anime, Western, and Indonesian genres.
                     Artceptris Films was founded in 2023 with the belief that every story is a bridge connecting cultures, emotions, and imagination. 
                     With a spirit of collaboration and innovation, we are committed to creating cinematic masterpieces that inspire, entertain, and leave a lasting impression on audiences worldwide.
                <br>
                <br>
                <br>
                <i class="fas fa-map-marker-alt"></i> Only in Semarang <br>
            </p>
        </div>
    </div>


    <div class="container">

        <br>
        <h1 class="heading">AVAILABLE UPCOMING MOVIES</h1>
        <p style="color:red; font-weight:bold;">
            <?php echo date('F j, Y') ?> -
            <?php echo date('F j, Y', strtotime(date('Y-m-t'))); ?>
        </p>


        <br>
        <p> Explore our exciting lineup of upcoming films, where every frame tells a captivating story. 
            From blockbuster hits to indie gems, our diverse selection promises an unforgettable cinematic experience. 
            Feel the magic and secure your seats now! </p> <br>
        <p>Join us at ARTCEPTRIS Theater, where every movie becomes a timeless masterpiece.</p><br><br>
        <div class="wrapper">
      <div class="card">
        <div class="poster"><img src="adminside\uploaded_img\DARKNUNS.png" alt="Location Unknown"></div>
        <div class="details">
          <h1>Dark Nuns</h1>
          <h2>2025 • R • 1hr 54min</h2>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
            <span>2.8/5</span>
          </div>
          <div class="tags">
            <span class="tag">Horror</span>
            <span class="tag">Mystery</span>
          </div>
          <p class="desc">
          A young boy Hee-Joon is possessed by an evil spirit. Nun Yunia tries to save him, assisted by Nun Mikaela. 
          </p>
          <a href="login.php" class="btn">Buy Tickets</a>
        </div>
      </div>
      <div class="card">
        <div class="poster"><img src="adminside\uploaded_img\AOT.png" alt="Location Unknown"></div>
        <div class="details">
          <h1>Attack on Titan</h1>
          <h2>2024 • R • 2hr 24min</h2>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
            <span>4/5</span>
          </div>
          <div class="tags">
            <span class="tag">Anime</span>
            <span class="tag">Action</span>
            <span class="tag">Adventure</span>
          </div>
          <p class="desc">
          The fate of the world hangs in the balance as Eren unleashes the ultimate power of the Titans.
          </p>
          <a href="login.php" class="btn">Buy Tickets</a>
        </div>
      </div>
      <div class="card">
        <div class="poster"><img src="adminside\uploaded_img\KNY.png" alt="Location Unknown"></div>
        <div class="details">
          <h1>Kimetsu no Yaiba</h1>
          <h2>2025 • R • 1hr 41min</h2>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <span>5/5</span>
          </div>
          <div class="tags">
            <span class="tag yellow">Action</span>
            <span class="tag">Adventure</span>
            <span class="tag blue">Supernatural</span>
          </div>
          <p class="desc">
          The Demon Slayer Corps plunge into Infinity Castle to defeat Muzan.
          </p>
          <a href="login.php" class="btn">Buy Tickets</a>
        </div>
      </div>
    </div>
    </div>
</div>

</body>
<div class="row copyright">
    <p>Copyright &copy; 2025 ARTCEPTRIS | All Rights Reserved</p>
</div>

</html>