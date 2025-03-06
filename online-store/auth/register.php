<?php
session_start();
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Check if email exists
    $check_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        $error = "Email is already registered!";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        if ($stmt->execute()) {
            $_SESSION["user_id"] = $stmt->insert_id;
            $_SESSION["user_name"] = $name;
            header("Location: profile.php");
            exit();
        } else {
            $error = "Registration failed! Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Online Store</title>
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
        .register-box {
            position: relative;
            z-index: 2;
            width: 400px;
            padding: 30px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .register-box h3 {
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

        .btn-register {
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

        .btn-register:hover {
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

<div class="register-box">
    <h3>Register</h3>
    <?php if (isset($error)) { echo '<p class="error-message">'.$error.'</p>'; } ?>
    <form action="register.php" method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Full Name" required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-register w-100">Register</button>
    </form>
    <p class="text-light mt-3">Already have an account? <a href="login.php">Login</a></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
