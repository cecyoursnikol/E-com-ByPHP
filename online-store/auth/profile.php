<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: logout.php");
    exit();
}
include("../config/db.php");

$user_id = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
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
<div class="container mt-5">
    <div class="col-md-4 mx-auto">
        <h3 class="text-center">Profile</h3>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <a href="logout.php" class="btn btn-danger w-100">Logout</a>
    </div>
</div>
</body>
</html>
