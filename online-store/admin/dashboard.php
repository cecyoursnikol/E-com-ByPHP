<?php
session_start();

// Restrict access if admin is not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

$admin_name = $_SESSION["admin_name"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2f3;
        }
        .dashboard-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="dashboard-container text-center">
        <h3>👨‍💻 Welcome, <?php echo $admin_name; ?> (Admin)</h3>
        <p>This is your admin dashboard.</p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

</body>
</html>
