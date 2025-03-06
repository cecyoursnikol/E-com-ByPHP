<?php
session_start();
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            header("Location: profile.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No user found with this email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Online Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://source.unsplash.com/1600x900/?shopping,mall') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Dark Overlay */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            top: 0;
            left: 0;
            z-index: 1;
        }

        /* Glassmorphic Container */
        .login-box {
            position: relative;
            z-index: 2;
            width: 380px;
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-box h3 {
            font-weight: bold;
            color: #fff;
            margin-bottom: 20px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
            border-radius: 8px;
            transition: 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
            box-shadow: none;
        }

        ::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-login {
            background: linear-gradient(135deg, #ff758c, #ff527b);
            border: none;
            padding: 12px;
            border-radius: 50px;
            font-size: 1.1rem;
            color: white;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 0 10px rgba(255, 117, 140, 0.6);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #ff527b, #ff365a);
            box-shadow: 0 0 15px rgba(255, 82, 123, 0.8);
        }

        .error-message {
            color: #ff8585;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .text-light a {
            color: #ffb6c1;
            text-decoration: none;
            transition: 0.3s;
        }

        .text-light a:hover {
            color: #fff;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3>Login</h3>
    <?php if (isset($error)) { echo '<p class="error-message">'.$error.'</p>'; } ?>
    <form action="login.php" method="POST">
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-login w-100">Login</button>
    </form>
    <p class="text-light mt-3">Don't have an account? <a href="register.php">Register</a></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
