<?php
session_start();
include("./config/db.php");

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
            header("Location: ../profile.php");
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
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }
        .register-container {
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
    <div class="register-container">
        <h3 class="text-center">Register</h3>
        <?php if (isset($error)) { echo '<div class="alert alert-danger text-center">'.$error.'</div>'; } ?>
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label>Full Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Register</button>
        </form>
        <p class="text-center mt-3">Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
