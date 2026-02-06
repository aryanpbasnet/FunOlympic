<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}
if(isset($_POST['reset_password'])) {
   $user_id = $_POST['user_id'];
   $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
   $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
 
   if($new_password === $confirm_password) {
     $hashed_password = md5($new_password); // You may use a more secure hashing method
 
     $update_query = "UPDATE `users` SET password = '$hashed_password' WHERE id = '$user_id'";
     mysqli_query($conn, $update_query) or die('Update query failed');
 
     // Redirect to the page where users are listed
     header('Location: admin_users.php');
     exit();
   } else {
     echo 'Passwords do not match.';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   <style>
      a{
         text-decoration: none;
      }
   </style>
   
<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title"> user accounts </h1>

   <div class="box-container">
   <?php
      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type != 'admin'") or die('query failed');
      while($fetch_users = mysqli_fetch_assoc($select_users)){
   ?>
   <div class="box">
      
      <p> User Name : <span><?php echo $fetch_users['name']; ?></span> </p>
      <p> Email : <span><?php echo $fetch_users['email']; ?></span> </p>
      <p> Account Type : <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
      <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn mb-2" style="margin:10px;">delete user</a>
      <a href="admin_reset_user.php?id=<?php echo $fetch_users['id']; ?>" class="delete-btn mt-2" style="margin:10px;">Reset Password</a>

<!-- Reset Password Modal -->

   </div>
   <?php
      };
   ?>
</div>







</section>










<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>