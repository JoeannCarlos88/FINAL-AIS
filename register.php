<?php
session_start();
include('connect/connection.php');

$message = '';

// Math CAPTCHA check
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $email    = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $user_answer = $_POST["captcha_answer"];
    $correct_answer = $_SESSION["captcha_result"];

    if ($user_answer != $correct_answer) {
        $message = "Incorrect CAPTCHA answer.";
    } else {
        $check_query = mysqli_query($connect, "SELECT * FROM login WHERE email ='$email'");
        $rowCount    = mysqli_num_rows($check_query);

        if (!empty($email) && !empty($password)) {
            if ($rowCount > 0) {
                $message = "User with this email already exists.";
            } else {
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                $result = mysqli_query(
                    $connect,
                    "INSERT INTO login (email, password, status) VALUES ('$email', '$password_hash', 0)"
                );

                if ($result) {
                    $otp = rand(100000, 999999);
                    $_SESSION['otp']  = $otp;
                    $_SESSION['mail'] = $email;

                    require "Mail/phpmailer/PHPMailerAutoload.php";
                    $mail = new PHPMailer;

                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->Port       = 587;
                    $mail->SMTPAuth   = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Username   = 'rinevarayon@gmail.com';
                    $mail->Password   = 'pxrg unlk jesm hble';

                    $mail->setFrom('rinevarayon@gmail.com', 'OTP Verification');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = "Your verification code";
                    $mail->Body    = "<p>Dear user,</p><h3>Your OTP code is $otp</h3><p>Regards,<br><b>Verification Team</b></p>";

                    if (!$mail->send()) {
                        $message = "Registration failed. Invalid email.";
                    } else {
                        echo "<script>
                                alert('Registered successfully. OTP sent to $email');
                                window.location='verification.php';
                              </script>";
                        exit();
                    }
                }
            }
        }
    }
}

// Generate simple math captcha
$num1 = rand(1, 9);
$num2 = rand(1, 9);
$captcha_question = "What is $num1 + $num2?";
$_SESSION["captcha_result"] = $num1 + $num2;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | CozyBite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            height: 100vh;
            margin: 0;
            align-items: center;
        }
        .register-box {
            width: 100%;
            max-width: 400px;
            background-color: rgba(60, 40, 20, 0.95);
            color: #fff;
            padding: 3rem 2rem;
            margin-left: 5%;
            border-radius: 16px;
            box-shadow: 0 0 30px rgba(0,0,0,0.6);
        }
        .register-box h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
        }
        .form-control {
            background-color: #a07e58;
            border: none;
            color: #fff;
            font-size: 1.05rem;
            padding: 1rem;
            border-radius: 10px;
        }
        .form-control:focus {
            background-color: #b4906f;
            box-shadow: 0 0 0 2px #ffcc80;
        }
        .btn-bite {
            background-color: #ff7043;
            color: #fff;
            font-size: 1.1rem;
            border-radius: 30px;
            padding: 0.75rem;
            border: none;
            width: 100%;
        }
        .btn-bite:hover {
            background-color: #ff5722;
        }
        .position-relative {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 1.25rem;
            transform: translateY(-50%);
            color: #fcebd5;
            cursor: pointer;
        }
        .text-center a {
            color: #ffcc80;
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        .alert {
            background-color: #ffcc80;
            color: #5c3d1c;
            border: none;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2>Join CozyBite</h2>

    <?php if (!empty($message)): ?>
        <div class="alert text-center"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-4 position-relative">
            <input type="email" name="email" class="form-control" placeholder="Email address" required>
        </div>

        <div class="mb-4 position-relative">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
        </div>

        <div class="mb-4">
            <label><?= $captcha_question ?> *</label>
            <input type="number" name="captcha_answer" class="form-control mt-1" placeholder="Enter answer" required>
        </div>

        <div class="mb-4">
            <button type="submit" name="register" class="btn btn-bite">Register</button>
        </div>
    </form>

    <div class="text-center">
        <a href="index.php">Already have an account? Login</a>
    </div>
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
