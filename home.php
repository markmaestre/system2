<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Academic Games</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .hero-carousel .carousel-item img {
         width: 100%;
         height: auto;
         object-fit: cover;
         max-height: 100vh; 
}

        .sections, .games, .guides, .reviews {
            padding: 20px;
        }
        .section, .card, .review {
            margin: 10px;
            text-align: center;
        }
        .section img, .card img, .review img {
            width: 100%;
            height: 200px; 
            object-fit: cover; 
            border-radius: 5px; 
        }
        .footer-column {
            margin: 20px 0;
        }
        
        header {
            background-color: white; 
            padding: 10px 0;
        }
        nav ul {
            position: relative;
            list-style-type: none;
            display: flex;
            gap: 20px;
        }
        nav a {
            color: black; 
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            color: #007bff; 
        }
        nav .submenu {
            display: none;
            position: absolute;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        nav li:hover .submenu {
            display: block;
        }
        nav .submenu li {
            list-style: none;
            padding: 10px;
        }
        nav .submenu li a {
            text-decoration: none;
            color: #333;
        }
        nav .submenu li a:hover {
            color: #007bff;
        }
        .user-actions a {
            color: black; 
            margin-left: 15px;
        }
        .user-actions a:hover {
            color: #007bff; 
        }
    </style>
</head>
<body>
<header>
    <div class="container d-flex justify-content-between align-items-center">
        <div class="logo">
            <img src="img/logos.jpg" alt="Academic Games" style="height: 50px;">
        </div>
        <nav>
            <ul>
                <li>
                    <a href="#subject-games"><i class="fas fa-book"></i> Subjects</a>
                    <ul class="submenu">
                        <li><a href="math.html">Math</a></li>
                        <li><a href="science.html">Science</a></li>
                        <li><a href="history.html">History</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#featured-games"><i class="fas fa-gamepad" style = color:black></i> Featured Games</a>
                </li>
                <li>
                    <a href="#learning-guides"><i class="fas fa-lightbulb" style = color:black></i> Learning Guides</a>
                </li>
            </ul>
        </nav>
        <div class="user-actions">
            <a href="#"><i class="fas fa-search"></i></a>
            <a href="#"><i class="fas fa-heart"></i></a>
            <a href="login.php"><i class="fas fa-user"></i></a>
        </div>
    </div>
</header>

<section class="hero-carousel">
    <div id="heroCarousel" class="carousel slide" data-ride="carousel" data-interval="1000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src=" https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQw5ONHkN5_Fcrn_BOlUYvktwDU-82tJtw2R8ae7DdKjkEKTqiBlj2XcTg6-XLrCrHsovw&usqp=CAU" class="d-block w-100" alt="Hero Slide 1">
                <div class="carousel-caption d-none d-md-block">
                  
                </div>
            </div>
            <div class="carousel-item">
                <img src=" https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSir24z_E6i_8oL2bdoFVhC-hqIA8_CX3Mby7mNpzDS0P_pS5_E_JcTCG6MyuzPdVfOpFM&usqp=CAU" class="d-block w-100" alt="Hero Slide 2">
                <div class="carousel-caption d-none d-md-block">
                  
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZk0YNd6gjHqbTWe87AofLgJL_FJzMewFYjg&s " class="d-block w-100" alt="Hero Slide 3">
                <div class="carousel-caption d-none d-md-block">
            
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>


<section id="featured-games" class="games">
    <h2 style = text-align:center>Featured Academic Games</h2>
    <div class="grid">
        <div class="card">
            <img src="data:image/jpeg;base64,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" alt="Memory Game">
            <h3 style = color:black>Memory Game</h3>
            <p>Improve your memory through engaging challenges.</p>
        </div>
        <div class="card">
            <img src="data:image/jpeg;base64,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" alt="Reasoning Puzzle">
            <h3 style = color:black>Reasoning Puzzle</h3>
            <p>Sharpen your logic and critical thinking skills.</p>
        </div>
        <div class="card">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXP7uYvGrWG3oMdkfFbKm4QxiK5klr-EFIKA&s" alt="Attention Focus">
            <h3 style = color:black>Attention Focus</h3>
            <p>Boost your concentration with interactive tasks.</p>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-column">
                <h5>About Academic Games</h5>
                <p>We provide interactive and educational games for students looking to enhance their academic performance in a fun and engaging way.</p>
            </div>
            <div class="col-md-4 footer-column">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li>Email: support@academicgames.com</li>
                    <li>Phone: +123 456 789</li>
                </ul>
            </div>
            <div class="col-md-4 footer-column">
                <h5>Follow Us</h5>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
