<?php
session_start();
include("./config/db.php");

// Redirect if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$success_message = $error_message = "";

// Fetch current user details
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    
    // Validate name & email
    if (empty($name) || empty($email)) {
        $error_message = "Name and Email cannot be empty!";
    } else {
        // Update name and email
        $update_stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $update_stmt->bind_param("ssi", $name, $email, $user_id);
        if ($update_stmt->execute()) {
            $_SESSION["user_name"] = $name;
            $success_message = "Profile updated successfully!";
        } else {
            $error_message = "Error updating profile!";
        }
    }

    // If password is provided, update it
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $pass_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $pass_stmt->bind_param("si", $hashed_password, $user_id);
        if ($pass_stmt->execute()) {
            $success_message .= " Password updated successfully!";
        } else {
            $error_message .= " Error updating password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | Online Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f4f4;
        }
        .profile-container {
            max-width: 500px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }
        .profile-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .btn-custom {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 8px;
            transition: 0.3s;
            width: 100%;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #0056b3, #004090);
        }
    </style>
</head>
<body>

<!-- Include Navbar -->
<?php include("./navbar.php"); ?>

<div class="container">
    <div class="profile-container">
        <div class="profile-header">
            <h3>✏️ Edit Profile</h3>
        </div>

        <?php if (!empty($success_message)) { ?>
            <div class="alert alert-success mt-3"><?php echo $success_message; ?></div>
        <?php } ?>
        <?php if (!empty($error_message)) { ?>
            <div class="alert alert-danger mt-3"><?php echo $error_message; ?></div>
        <?php } ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user["name"]); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user["email"]); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">New Password (optional)</label>
                <input type="password" name="password" class="form-control">
                <small class="text-muted">Leave blank if you don't want to change your password.</small>
            </div>
            <button type="submit" class="btn btn-custom">💾 Save Changes</button>
        </form>
        
        <a href="profile.php" class="btn btn-secondary mt-3 w-100">⬅️ Back to Profile</a>
    </div>
</div>

</body>
</html>
