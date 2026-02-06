<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if video title and file are set
    if(isset($_POST['video_title']) && isset($_FILES['video_file'])) {
        // Validate input
        $video_title = $_POST['video_title'];

        // File upload handling
        $target_dir = "uploaded_video/";
        $target_file = $target_dir . basename($_FILES["video_file"]["name"]);
        $uploadOk = 1;
        $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded.')</script>";
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($_FILES["video_file"]["tmp_name"], $target_file)) {
                // Insert data into database
                $video_filename = basename($_FILES["video_file"]["name"]);
                $sql = "INSERT INTO tblvideo (video_title, video_filename) VALUES ('$video_title', '$video_filename')";

                // Your database connection here
                if ($conn === false) {
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }

                // Attempt to execute the SQL query
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Video added successfully.')</script>";
                } else {
                    echo "<script>alert('Error: Unable to execute $sql.')</script>" . mysqli_error($conn);
                }
            } else {
                // Error uploading file
                echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
            }
        }
    } else {
        echo "<script>alert('Are you want to delete this video?')</script>";
    }
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `tblvideo` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/'.$fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `tblvideo` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_tblvideo.php');
}

if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price = $_POST['update_price'];

    mysqli_query($conn, "UPDATE `tblvideo` SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'uploaded_img/'.$update_image;
    $update_old_image = $_POST['update_old_image'];

    if(!empty($update_image)){
       if($update_image_size > 2000000){
          $message[] = 'image file size is too large';
       }else{
          mysqli_query($conn, "UPDATE `tblvideo` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
          move_uploaded_file($update_image_tmp_name, $update_folder);
          unlink('uploaded_img/'.$update_old_image);
       }
    }

    header('location:admin_tblvideo.php');
}

// Check if the video_id is set and not empty
if (isset($_POST['video_id']) && !empty($_POST['video_id'])) {
    // Sanitize the input
    $video_id = mysqli_real_escape_string($conn, $_POST['video_id']);

    // Delete the video from the database
    $sql = "DELETE FROM tblvideo WHERE id = '$video_id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Video deleted successfully.)</script>";
    } else {
        echo "Error deleting video: " . mysqli_error($conn);
    }
} else {
    echo "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <style>
        a {
            text-decoration: none;
        }
    </style>

    <?php include 'admin_header.php'; ?>

    <section class="add-products">
        <h1 class="title"> Add video </h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" id="video_title" name="video_title" class="box" placeholder="Enter your video name" required>
            <input type="file" id="video_file" name="video_file" class="box" required accept="video/*">
            <button type="submit" class="btn">Upload Video</button>
        </form>
    </section>

    <section class="show-products">
        <div class="content" style="display: grid; justify-content: center; align-items: center;">
            <?php
            // Fetch all video details from the database
            $sql = "SELECT * FROM tblvideo ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Display each video
                while ($row = mysqli_fetch_assoc($result)) {
                    $video_filename = $row['video_filename'];
                    $video_title = $row['video_title'];
                    $video_id = $row['id'];

                    // Generate HTML to embed the video player for each video
                    echo '<video width="80%" height="240" controls>';
                    echo '<source src="uploaded_video/' . $video_filename . '" type="video/mp4">';
                    echo 'Your browser does not support the video tag.';
                    echo '</video>';
                    echo '<h1 style="margin-left: 19% " class="video-title">' . $video_title . '</h1>';

                    // Form for video deletion
                    echo '<form action="" method="post">';
                    echo '<input type="hidden" name="video_id" value="' . $video_id . '">';
                    echo '<input type="submit" value="Delete" class="btn">';
                    echo '</form>';
                }
            } else {
                // No video found in the database
                echo "<div class='content'>No videos available.</div>";
            }
            ?>
        </div>
    </section>

    <script src="js/admin_script.js"></script>
</body>
</html>
