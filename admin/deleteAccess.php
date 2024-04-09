<?php
session_start();
include '../config/db.php';

// Check if user ID is provided
if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Prepare SQL statement to delete the user
    $sql = "DELETE FROM fms_g14_access WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // User deleted successfully
        header("Location: access.php?upload_success=1");
        exit();
    } else {
        // Error occurred
        header("Location: access.php?upload_error=" . urlencode("Unable to delete user!"));
        exit();
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($con);

// Redirect back to the user management page
header("Location: access.php");
exit;