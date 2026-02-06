<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Recent Matches</h3>
        <p> <a href="home.php">home</a> / games </p>
    </div>

    <section class="about">

        <div class="flex">



        <div class="content">
    <?php
    // Fetch all video details from the database
    $sql = "SELECT * FROM tblvideo ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Display each video
        while ($row = mysqli_fetch_assoc($result)) {
            $video_filename = $row['video_filename'];
            $video_title = $row['video_title'];

            // Generate HTML to embed the video player for each video
          
            echo '<video width="100%" height="240"  controls>';
            echo '<source src="uploaded_video/' . $video_filename . '" type="video/mp4">';
            echo 'Your browser does not support the video tag.';
            echo '</video>';
            echo '<h1 style="margin-left: 45%; margin-bottom:5rem; font-size:3rem" >' . $video_title . '</h1>';
           
        }
    } else {
        // No video found in the database
        echo "<div class='content'>No games available.</div>";
    }
    ?>
</div>



   </div>

    </section>




    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>