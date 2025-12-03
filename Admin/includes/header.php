<?php
session_start();

// If user not logged in → redirect to login page
if(!isset($_SESSION['user_id'])){
    header("Location: ../Auth/login.php");
    exit();
}

$user = $_SESSION['username']; // adjust based on your login variable
$avatar = "https://ui-avatars.com/api/?name=" . urlencode($user) . "&size=200&background=random&color=fff&bold=true";

$hour = date('H');

if ($hour >= 5 && $hour < 12) {
    $greeting = "Good Morning";
} 
elseif ($hour >= 12 && $hour < 17) {
    $greeting = "Good Afternoon";
} 
elseif ($hour >= 17 && $hour < 20) {
    $greeting = "Good Evening";
} 
else {
    $greeting = "Good Night";
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Dashboard | Hando - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<!-- fontawesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- DataTables CSS -->
<link rel="stylesheet" 
href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<link rel="stylesheet" 
href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<link rel="stylesheet" 
href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">



        <script src="assets/js/head.js"></script>

     <style>

table.dataTable thead {
    background-color: #007bff !important;
    color: #fff;
    font-weight: bold;
}

table.dataTable tbody tr:hover {
    background-color: #f1f1f1;
}

.dataTables_wrapper .dt-buttons {
    margin-bottom: 10px;
}



        /* Circle Logo */
.sidebar-logo-circle {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    object-fit: cover;
}

/* School Name */
.sidebar-school-name {
    font-size: 16px;
    font-weight: 600;
    color: #fff; /* you can change for light mode */
}

/* For Light Mode */
[data-bs-theme="light"] .sidebar-school-name {
    color: #000;
}

.custom-footer {
    background: #f8f9fa;
    border-top: 1px solid #e6e6e6;
    font-size: 14px;
    
}

.custom-footer .footer-text {
    color: #555;
}

.custom-footer .footer-year {
    color: #333;
    font-weight: 600;
}

/* Dark Mode Support */
[data-bs-theme="dark"] .custom-footer {
    background: #1f1f1f;
    border-top: 1px solid #333;
}

[data-bs-theme="dark"] .custom-footer .footer-text {
    color: #bbb;
}

[data-bs-theme="dark"] .custom-footer .footer-year {
    color: #fff;
}


#candidateVotesChart {
    width: 480px !important;
    height: 480px !important;
}

/* Cards for each position */
.position-section {
    background: #fff;
    border-radius: 0.5rem;
    padding: 20px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

/* Table styling */
.position-section table {
    width: 100%;
    border-collapse: collapse;
}

.position-section th, .position-section td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

.position-section th {
    background-color: #007bff;
    color: #fff;
    font-weight: 600;
}

.position-section td i.fa-check-circle {
    color: #28a745;
    font-size: 1.2rem;
}

/* Chart styling */
.position-section canvas {
    margin-top: 20px;
}

/* Print-specific styles */
@media print {
    body {
        background: white !important;
        color: black !important;
        font-size: 12pt;
    }

    .btn {
        display: none !important;
    }

    .position-section {
        page-break-inside: avoid;
        box-shadow: none !important;
        border: 1px solid black;
    }

    table, th, td {
        border: 1px solid black !important;
    }

    canvas {
        page-break-inside: avoid;
    }
}




     </style>     

    </head>

    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">

    <!-- Begin page -->
    <div id="app-layout">


        <!-- Topbar Start -->
        <div class="topbar-custom">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                        <li>
                            <button class="button-toggle-menu nav-link">
                                <i data-feather="menu" class="noti-icon"></i>
                            </button>
                        </li>
                       <li class="d-none d-lg-block">
                            <h5 class="mb-0">
                                <?php echo $greeting . ", " . $_SESSION['username']; ?>
                            </h5>
                        </li>
                    </ul>

                    <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                        <!-- <li class="d-none d-lg-block">
                            <form class="app-search d-none d-md-block me-auto">
                                <div class="position-relative topbar-search">
                                    <input type="text" class="form-control ps-4" placeholder="Search..." />
                                    <i class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                                </div>
                            </form>
                        </li> -->

                        <!-- Button Trigger Customizer Offcanvas -->
                        <li class="d-none d-sm-flex">
                            <button type="button" class="btn nav-link" data-toggle="fullscreen">
                                <i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
                            </button>
                        </li>

                        <!-- Light/Dark Mode Button Themes -->
                        <li class="d-none d-sm-flex">
                            <button type="button" class="btn nav-link" id="light-dark-mode">
                                <i data-feather="moon" class="align-middle dark-mode"></i>
                                <i data-feather="sun" class="align-middle light-mode"></i>
                            </button>
                        </li>

                        

                        <!-- User Dropdown -->
<li class="dropdown notification-list topbar-dropdown">
    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

        <!-- Auto Generated Avatar -->
        <img src="<?php echo $avatar; ?>" alt="user-image" class="rounded-circle" />

        <span class="pro-user-name ms-1">
            <?php echo htmlspecialchars($user); ?> 
            <i class="mdi mdi-chevron-down"></i>
        </span>
    </a>

    <div class="dropdown-menu dropdown-menu-end profile-dropdown">

        <div class="dropdown-header noti-title">
            <h6 class="text-overflow m-0">Welcome, <?php echo htmlspecialchars($user); ?>!</h6>
        </div>

        <a href="pages-profile.html" class="dropdown-item notify-item">
            <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
            <span>My Account</span>
        </a>

        <a href="auth-lock-screen.html" class="dropdown-item notify-item">
            <i class="mdi mdi-lock-outline fs-16 align-middle"></i>
            <span>Lock Screen</span>
        </a>

        <div class="dropdown-divider"></div>

        <a href="../Auth/logout.php" class="dropdown-item notify-item">
            <i class="mdi mdi-location-exit fs-16 align-middle"></i>
            <span>Logout</span>
        </a>
    </div>
</li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- end Topbar -->