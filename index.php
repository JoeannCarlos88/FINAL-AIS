<?php
session_start();
include('connect/connection.php');

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($connect, trim($_POST['email']));
    $password = trim($_POST['password']);

    $sql = mysqli_query($connect, "SELECT * FROM login WHERE email = '$email'");
    $count = mysqli_num_rows($sql);

    if ($count > 0) {
        $fetch = mysqli_fetch_assoc($sql);
        $hashpassword = $fetch["password"];

        if ($fetch["status"] == 0) {
            echo "<script>alert('Please verify your email before logging in.');</script>";
        } else if (password_verify($password, $hashpassword)) {
            $_SESSION['email'] = $email;
            header("Location: homepage.php");
            exit();
        } else {
            echo "<script>alert('Invalid email or password.');</script>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | CozyBite</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: url('https://images.unsplash.com/photo-1543353071-873f17a7a088?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed;
            background-size: cover;
            display: flex;
        }

        .sidebar {
            width: 100%;
            max-width: 400px;
            background-color: rgba(60, 40, 20, 0.9); /* rich brown for vintage effect */
            color: #fff;
            padding: 3rem 2rem;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }

        .sidebar h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-control {
            background-color: #a07e58;
            border: none;
            color: #fff;
            padding: 1rem;
            font-size: 1.1rem;
            border-radius: 10px;
        }

        .form-control:focus {
            background-color: #b4906f;
            outline: none;
            box-shadow: 0 0 0 2px #ffcc80;
        }

        .btn-bite {
            background-color: #ff7043;
            color: #fff;
            padding: 0.75rem;
            font-size: 1.1rem;
            border-radius: 30px;
            border: none;
            width: 100%;
            transition: 0.3s ease;
        }

        .btn-bite:hover {
            background-color: #ff5722;
        }

        .form-check-label {
            color: #f2e1c1;
        }

        .login-footer a {
            color: #ffcc80;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .toggle-password {
            position: absolute;
            right: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #eee2d0;
            cursor: pointer;
        }

        .position-relative {
            position: relative;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                max-width: none;
                height: 100vh;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Welcome to CozyBite</h2>
    <form action="#" method="POST" name="login">
        <div class="mb-4 position-relative">
            <input type="text" class="form-control" name="email" placeholder="Email address" required autofocus>
        </div>

        <div class="mb-4 position-relative">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
        </div>

        <div class="mb-4 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <div class="mb-4">
            <button type="submit" name="login" class="btn btn-bite">Log In</button>
        </div>

        <div class="login-footer text-center">
            <a href="recover_psw.php">Forgot your password?</a><br>
            <a href="register.php">Don't have an account? Sign up</a>
        </div>
    </form>
</div>

<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bi-eye');
    });
</script>

</body>
</html>
