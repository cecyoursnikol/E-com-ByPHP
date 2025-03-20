<?php
session_start();
include("../config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Fetch admin details from database
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ? AND role = 'admin'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        // Direct password comparison (NO hashing)
        if ($password === $admin["password"]) {
            $_SESSION["admin_id"] = $admin["id"];
            $_SESSION["admin_name"] = $admin["name"];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "No admin found with this email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Online Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7f6;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        .btn-custom {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            color: white;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            transition: 0.3s;
            width: 100%;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #0056b3, #003580);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <h3>🔐 Admin Login</h3>
        <?php if(isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <form action="" method="POST">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Admin Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-custom">Login</button>
        </form>
    </div>
</div>

</body>
</html>
