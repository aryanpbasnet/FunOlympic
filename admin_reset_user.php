<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "SELECT * FROM `users` WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $name = $user['name']; // Fetch name from user array
    } else {
        echo 'User not found.';
        exit();
    }
} else {
    echo 'User ID not provided.';
    exit();
}

if (isset($_POST['reset_password'])) {
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    
    if ($new_password === $confirm_password) {
        $hashed_password = md5($new_password); // You may use a more secure hashing method
        
        $update_query = "UPDATE `users` SET password = '$hashed_password' WHERE id = '$user_id'";
        mysqli_query($conn, $update_query) or die('Update query failed');
        
        // Redirect to admin_users.php and show alert
        echo '<script>alert("Password changed successfully.");</script>';
        echo '<script>window.location.href = "admin_users.php";</script>';
        exit();
    } else {
        echo '<script>alert("Passwords do not match.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <h1 class="text-center">Reset Password</h1>
    <form action="" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
       
        <div class="form-floating mb-3">
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" class="form-control" readonly>
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" class="form-control" readonly>
            <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" id="new_password" name="new_password" class="form-control" required>
            <label for="new_password">New Password</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            <label for="confirm_password">Confirm Password</label>
        </div>
        <button type="submit" name="reset_password" class="btn btn-primary">Reset Password</button>
    </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
