<?php
session_start();

// If user already logged in → send to admin dashboard
if(isset($_SESSION['user_id'])){
    header("Location: ../Admin/");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AL-KAAMIL Voting Login</title>
<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<style>
body, html {
    height: 100%;
    margin: 0;
    font-family: 'Roboto', sans-serif;
}

/* Container */
.login-container {
    display: flex;
    min-height: 100vh;
}

/* Left: Login form */
.login-left {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fff;
    padding: 3rem;
}

.login-card {
    width: 100%;
    max-width: 400px;
    text-align: center;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 0 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.login-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 40px rgba(0,0,0,0.15);
}

.login-card .school-logo {
    width: 100px;
    height: 100px;
    object-fit: contain;
    margin-bottom: 1rem;
}

.form-control:focus {
    box-shadow: none;
    border-color: #1cc88a;
}

.btn-primary {
    background: #1cc88a;
    border: none;
}

.btn-primary:hover {
    background: #17a673;
}

.auth-footer {
    font-size: 0.85rem;
    margin-top: 1rem;
    color: #6c757d;
}

.auth-footer a {
    color: #1cc88a;
    text-decoration: none;
}

/* Right: Animated background with slogans */
.login-right {
    flex: 1;
    position: relative;
    background: url('assets/images/alkaamil_logo.jpeg') repeat;
    background-size: 120px 120px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    animation: moveBackground 60s linear infinite;
}

/* Overlay */
.login-right::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
    z-index: 1;
}

/* Animated background movement */
@keyframes moveBackground {
    0% { background-position: 0 0; }
    50% { background-position: 500px 500px; }
    100% { background-position: 0 0; }
}

/* Carousel/Slogan styles */
.slogan-slider {
    position: relative;
    z-index: 2;
    color: #fff;
    max-width: 80%;
    text-align: center;
}

.slogan-slider h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    animation: fadeIn 1s ease-in-out;
}

.slogan-slider p {
    font-size: 1.1rem;
    line-height: 1.5;
    animation: fadeIn 1s ease-in-out;
}

/* Fade in effect for carousel items */
@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(20px);}
    100% { opacity: 1; transform: translateY(0);}
}

/* Carousel arrows */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    filter: invert(1);
}

@media(max-width: 992px){
    .login-container {
        flex-direction: column;
    }
    .login-right {
        height: 300px;
    }
}
</style>
</head>
<body>

<div class="login-container">

    <!-- Left side: Login form -->
    <div class="login-left">
        <div class="login-card">
            <img src="assets/images/alkaamil_logo.jpeg" alt="School Logo" class="school-logo">
            <h3 class="fw-bold mb-3">AL-KAAMIL MODERN</h3>
            <p class="text-muted mb-4">Sign in to cast your vote securely and efficiently.</p>

            <!-- Bootstrap alert placeholder -->
            <div id="alertBox" class="alert d-none" role="alert"></div>

            <form id="loginForm">
                <div class="mb-3 text-start">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" class="form-control" placeholder="Enter your username" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="mb-3 form-check text-start">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg fw-semibold">Log In</button>
                </div>
                <div class="text-end mb-2">
                    <a href="#">Forgot Password?</a>
                </div>
            </form>

            <div class="auth-footer">
                Don't have an account? <a href="#">Sign up</a>
            </div>
        </div>
    </div>

    <!-- Right side: Animated logo + slogans -->
    <div class="login-right">
        <div id="sloganCarousel" class="carousel slide slogan-slider" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <h1>Empowering Your Voice</h1>
                    <p>Vote confidently, securely, and transparently with AL-KAAMIL modern voting system.</p>
                </div>
                <div class="carousel-item">
                    <h1>Integrity in Every Vote</h1>
                    <p>Your vote matters. We ensure fairness, security, and efficiency in every election.</p>
                </div>
                <div class="carousel-item">
                    <h1>Simple. Fast. Reliable.</h1>
                    <p>Experience a seamless voting process designed for students and staff.</p>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#sloganCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#sloganCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e){
    e.preventDefault();

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const alertBox = document.getElementById('alertBox');

    // Reset alert
    alertBox.classList.add('d-none');
    alertBox.classList.remove('alert-success','alert-danger','alert-warning');

    if(!username || !password){
        alertBox.textContent = 'Please enter both username and password';
        alertBox.classList.remove('d-none');
        alertBox.classList.add('alert-warning');
        return;
    }

    fetch('api/login_api.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({username, password})
    })
    .then(res => res.json())
    .then(resp => {
        if(resp.status === 'success'){
            alertBox.textContent = 'Login Successful! Redirecting...';
            alertBox.classList.remove('d-none');
            alertBox.classList.add('alert-success');
            setTimeout(() => window.location.href = '../Admin/', 1500);
        } else {
            alertBox.textContent = resp.message || 'Invalid credentials';
            alertBox.classList.remove('d-none');
            alertBox.classList.add('alert-danger');
        }
    })
    .catch(err=>{
        console.error(err);
        alertBox.textContent = 'Something went wrong';
        alertBox.classList.remove('d-none');
        alertBox.classList.add('alert-danger');
    });
});
</script>
</body>
</html>
