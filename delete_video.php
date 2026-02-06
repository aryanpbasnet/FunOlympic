<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];



// Check if the video_id is set and not empty
if (isset($_POST['video_id']) && !empty($_POST['video_id'])) {
    // Sanitize the input
    $video_id = mysqli_real_escape_string($conn, $_POST['video_id']);

    // Delete the video from the database
    $sql = "DELETE FROM tblvideo WHERE id = '$video_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Video deleted successfully.";
    } else {
        echo "Error deleting video: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
