<?php
session_start();
include("./config/db.php");

// Redirect if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Get user details
$stmt = $conn->prepare("SELECT name, email, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Get order history
$order_stmt = $conn->prepare("SELECT order_id, total_price, order_date, status FROM orders WHERE user_id = ? ORDER BY order_date DESC");
$order_stmt->bind_param("i", $user_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Online Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
        }
        .profile-container {
            max-width: 600px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            text-align: center;
        }
        .profile-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 20px;
            border-radius: 15px 15px 0 0;
        }
        .profile-header h3 {
            margin: 0;
        }
        .btn-custom {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #0056b3, #004090);
        }
        .order-container {
            margin-top: 20px;
            background: white;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .order-history {
            max-height: 300px;
            overflow-y: auto;
        }
        .badge-custom {
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .bg-pending {
            background: #ffc107;
            color: black;
        }
        .bg-completed {
            background: #28a745;
            color: white;
        }
        .order-btn {
            width: 100%;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<!-- Include Navbar -->
<?php include("./navbar.php"); ?>

<div class="container">
    <div class="profile-container">
        <div class="profile-header">
            <h3>👤 <?php echo $user["name"]; ?></h3>
            <p><?php echo $user["email"]; ?></p>
        </div>
        <div class="p-3">
            <p><strong>Joined On:</strong> <?php echo date("F j, Y", strtotime($user["created_at"])); ?></p>
            <a href="edit_profile.php" class="btn btn-warning">✏️ Edit Profile</a>
            <a href="order_history.php" class="btn btn-custom">📦 View Orders</a>
            <a href="logout.php" class="btn btn-danger">🚪 Logout</a>
        </div>
    </div>
</div>

</body>
</html>
