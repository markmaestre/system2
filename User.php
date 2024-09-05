<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: home.php");
    exit();
}

$username = $_SESSION['username'];
$userImage = 'img/default-image.svg'; 

$conn = mysqli_connect('localhost', 'root', '', 'maestre') or die('Connection failed');


$query = "SELECT profile_picture FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {

    $userImage = 'img/' . $row['profile_picture']; 
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/user.css">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script defer src="js/main.js"></script>
    <title>USER Dashboard</title>
    <style>
        body {
            background: linear-gradient(to right, white, skyblue);
            margin: 0;
            padding: 0;
            height: 100vh;
        }
        header {
            background: linear-gradient(to right, white, skyblue);
        }
        .navbar-brand img {
            max-height: 50px; 
            width: auto;
            margin-right: 10px; 
        }
        .profile img {
            border-radius: 50%;
            max-height: 50px;
            max-width: 50px;
        }
    </style>
    <script>
        function confirmLogout(event) {
            event.preventDefault(); 
            if (confirm("Do you want to logout?")) {
                window.location.href = event.target.href; 
            }
         
        }
    </script>
</head>
<body class="light-theme dark-theme">
    <header>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="header-inner d-flex justify-content-between align-items-center">
                    <a class="navbar-brand flex-shrink-0" href="#">
                        <img src="img/mtics.png" alt="logo-image" class="img-fluid">
                        MTICS
                    </a>
                    <div class="header-content d-flex align-items-center justify-content-end">
                        <form class="d-flex justify-content-end align-items-center">
                            <div class="search-icon">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                            </div>
                        </form>
                        <a href="#" class="profile">
                            <img src="<?php echo htmlspecialchars($userImage); ?>" alt="user-image"> <?php echo htmlspecialchars($username); ?>
                        </a>
                        <a href="#" class="notification">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <button class="hamburger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </nav>
        </div>
    </header>
    <div class="nft-store">
        <div class="container-fluid">
            <div class="nft-store-inner d-flex">
                <div class="menu-links">
                    <ul>
                        <li class="nav-item active">
                            <a href="#" class="d-flex align-items-center nav-link">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span>Home</span>
                            </a>
                        </li>
                      
                        <li class="nav-item">
                            <a href="#" class="d-flex align-items-center nav-link">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                <span>Events</span>
                            </a>
                        </li>
                        
                       
                        <li class="nav-item">
                            <a href="#" class="d-flex align-items-center nav-link">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <span>Task</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="d-flex align-items-center nav-link">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="d-flex align-items-center nav-link" onclick="confirmLogout(event)">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="nft-store-content">
                    <div class="nft-up-content">
                      
               <h1  style = "text-align:center; color:black;">hellow,world</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
