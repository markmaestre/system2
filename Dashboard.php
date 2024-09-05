<?php
session_start();
include 'config.php'; 


$resourceExists = true;

if (!$resourceExists) {
    header("Location: 404.php");
    exit();
}

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}

$sql = "SELECT id, username, first_name, last_name, email FROM users";
$result = $conn->query($sql);



$sql_current_month = "SELECT COUNT(*) as total_users FROM users WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())";
$sql_last_month = "SELECT COUNT(*) as total_users FROM users WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE())";

$current_month_result = $conn->query($sql_current_month);
$last_month_result = $conn->query($sql_last_month);

$current_month_users = $current_month_result->fetch_assoc()['total_users'];
$last_month_users = $last_month_result->fetch_assoc()['total_users'];


if ($last_month_users > 0) {
    $user_percentage_change = (($current_month_users - $last_month_users) / $last_month_users) * 100;
} else {
    $user_percentage_change = 100;
}

$user_percentage_sign = $user_percentage_change >= 0 ? 'up' : 'down';
$user_percentage_color = $user_percentage_change >= 0 ? 'success' : 'danger';


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet" />
    <style>
       
        .bg-surface-secondary {
            background-color: skyblue !important;
        }
        .navbar-vertical .nav-link {
            padding: 1rem 1.5rem;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }
        .navbar-vertical .nav-link i {
            font-size: 1.5rem;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
        }
        .navbar-brand h3 {
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-brand img {
            margin-right: 0.5rem;
        }
        .navbar-vertical {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .header-title {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-align: center;
        }
        header.bg-surface-primary {
            background: linear-gradient(to bottom, white, white 35%, skyblue 100%);
        }
        .header-title img {
            width: 40px;
        }
        .header-title h1 {
            margin: 0;
        }
        .bg-light-maroon {
            background-color: #d96b7c;
        }
        .text-light-maroon {
            color: #d96b7c;
        }
        .card-icon {
            background-color: #d96b7c;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
            <div class="container-fluid">
                <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
                    <h3 class="text-success">
                        <img src="img/mtics.png" width="40" />
                        <span class="text-info">Admin</span>
                    </h3>
                </a>
                <div class="navbar-user d-lg-none">
                    <div class="dropdown">
                        <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar-parent-child">
                                <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar- rounded-circle" />
                                <span class="avatar-child avatar-badge bg-success"></span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                            <a href="#" class="dropdown-item">Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Billing</a>
                            <hr class="dropdown-divider" />
                            <a href="home.php" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="sidebarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-calendar-event"></i> Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-cash-stack"></i> Income
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-person"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-book"></i> Library
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-file-earmark-text"></i> Posts
                            </a>
                        </li>
                    </ul>
                    <hr class="navbar-divider my-5 opacity-20" />
                    <ul class="navbar-nav mb-md-4">
                        <li>
                            <div class="nav-link text-xs font-semibold text-uppercase text-muted ls-wide" href="#">
                            </div>
                        </li>
                    </ul>
                    <div class="mt-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-person-square"></i> Account
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="home.php" onclick="return confirm('Are you sure you want to logout?')">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12 ">
                            <div class="header-title">
                                <img src="img/mtics.png" width="40" alt="Logo"/>
                                <h1 class="h2 mb-0 ls-tight">Information and Assurance and Security 2</h1>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs mt-4 overflow-x border-0">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">All</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link font-regular">Income</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link font-regular">Events</a>
                        </li>
                    </ul>
                </div>
            </header>
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <div class="row g-6 mb-6">
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0 bg-light-maroon">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Budget</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape card-icon text-white text-lg rounded-circle">
                                                <i class="bi bi-credit-card"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0 bg-light-maroon">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Events</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape card-icon text-white text-lg rounded-circle">
                                                <i class="bi bi-clock-history"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0 bg-light-maroon">

                            <div class="card-body">
            <div class="row">
                <div class="col">
                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Users</span>
                    <span class="h6 font-semibold text-muted d-block"><?php echo $current_month_users; ?> Users</span>
                </div>
                <div class="col-auto">
                    <div class="icon icon-shape card-icon text-white text-lg rounded-circle bg-primary">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
            <div class="mt-2 mb-0 text-sm">
                <span class="badge badge-pill bg-soft-<?php echo $user_percentage_color; ?> text-<?php echo $user_percentage_color; ?> me-2">
                    <i class="bi bi-arrow-<?php echo $user_percentage_sign; ?> me-1"></i><?php echo abs($user_percentage_change); ?>%
                </span>
                <span class="text-nowrap text-xs text-muted">Since last month</span>
            </div>
        </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="card shadow border-0 bg-light-maroon">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="h6 font-semibold text-muted text-sm d-block mb-2">Library</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape card-icon text-white text-lg rounded-circle">
                                                <i class="bi bi-cash"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-0 text-sm">
                                    
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    <div class="card shadow border-0 mb-6">
                        <div class="card-header">
                            <h5 class="mb-0">Manage Users</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($result->num_rows > 0) : ?>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['username']; ?></td>
                                                <td><?php echo $row['first_name']; ?></td>
                                                <td><?php echo $row['last_name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td>
                                                    <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger delete-user" data-id="<?php echo $row['id']; ?>">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No users found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-user');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const userId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            window.location.href = `delete_user.php?id=${userId}`;
                        }
                    });
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
