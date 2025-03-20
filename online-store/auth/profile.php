<?php
session_start();
include("../config/db.php");

// If user is not logged in, redirect to login page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Get user details from the database
$stmt = $conn->prepare("SELECT name, email, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Automatically logout on page refresh
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Online Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include("navbar.php"); ?>

<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3>👤 User Profile</h3>
                </div>
                <div class="card-body text-center">
                    <p><strong>Name:</strong> <?php echo $user["name"]; ?></p>
                    <p><strong>Email:</strong> <?php echo $user["email"]; ?></p>
                    <p><strong>Joined On:</strong> <?php echo date("F j, Y", strtotime($user["created_at"])); ?></p>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
