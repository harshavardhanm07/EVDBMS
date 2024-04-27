<?php
include_once('../includes/functions.php');

// Check if v_id is set and is a valid integer
if (isset($_GET['v_id']) && is_numeric($_GET['v_id'])) {
    $v_id = $_GET['v_id'];

    // Delete cost details by vehicle ID
    $deleteStmt = $conn->prepare("DELETE FROM COST WHERE v_id = ?");
    $deleteStmt->bind_param("i", $v_id);

    if ($deleteStmt->execute()) {
        // Deletion successful
        header("Location: cost.php"); // Redirect to the cost display page
        exit();
    } else {
        // Deletion failed
        echo "Deletion failed. Please try again.";
    }
} else {
    // v_id is not set or not a valid integer, handle accordingly (e.g., redirect or display an error message)
    echo "Invalid vehicle ID.";
}
?>
