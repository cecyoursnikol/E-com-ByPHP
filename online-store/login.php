<?php
session_start();
include("./config/db.php");

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
            header("Location: ./profile.php");
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
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .btn-custom {
            background: linear-gradient(135deg, #ff7eb3, #ff758c);
            border: none;
            color: white;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #ff527b, #ff3a5a);
        }
    </style>
</head>
<body>

<!-- Include Navbar -->
<?php include("./navbar.php"); ?>

<div class="container">
    <div class="login-container">
        <h3 class="text-center">Login</h3>
        <?php if (isset($error)) { echo '<div class="alert alert-danger text-center">'.$error.'</div>'; } ?>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Login</button>
        </form>
        <p class="text-center mt-3">Don't have an account? <a href="register.php">Register</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
