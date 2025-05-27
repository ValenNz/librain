<?php 
session_start(); 
if (isset($_SESSION['user'])) 
    header("Location: dashboard.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="left-panel"></div>
        <div class="right-panel">
            <h2>Welcome to <span class="highlight">LIBRAIN</span></h2>
            <p class="subtext">Please login into your account!</p>

            <!-- ✅ Sudah diarahkan ke file PHP yang benar -->
            <form action="login_procces.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>

                <div class="options">
                    <label><input type="checkbox" name="remember"> Remember Me</label>
                    <a href="#">Recovery Password</a>
                </div>

                <button type="submit" class="btn login">Login</button>
                <button type="button" class="btn google">Sign in with Google</button>
            </form>
        </div>
    </div>
</body>
</html>
