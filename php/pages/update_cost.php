<?php
include_once('../includes/functions.php');

// Check if v_id is set and is a valid integer
if (isset($_GET['v_id']) && is_numeric($_GET['v_id'])) {
    $v_id = $_GET['v_id'];

    // Get cost details by vehicle ID
    $cost = getCostByVehicleId($v_id);

    if ($cost) {
        // Handle form submission for updating cost details
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize form data (you may want to add more validation)
            $newBattery = filter_input(INPUT_POST, 'battery', FILTER_VALIDATE_FLOAT);
            $newRd = filter_input(INPUT_POST, 'rd', FILTER_VALIDATE_FLOAT);
            $newBody = filter_input(INPUT_POST, 'body', FILTER_VALIDATE_FLOAT);
            $newSubsidy = filter_input(INPUT_POST, 'subsidy', FILTER_VALIDATE_FLOAT);

            // Check if all required data is provided
            if ($newBattery !== false && $newRd !== false && $newBody !== false && $newSubsidy !== false) {
                // Perform the update in the database
                $updateStmt = $conn->prepare("UPDATE COST SET battery=?, rd=?, body=?, subsidy=? WHERE v_id=?");
                $updateStmt->bind_param("ddddi", $newBattery, $newRd, $newBody, $newSubsidy, $v_id);

                if ($updateStmt->execute()) {
                    // Update successful
                    header("Location: cost.php"); // Redirect to the cost display page
                    exit();
                } else {
                    // Update failed
                    echo "Update failed. Please try again.";
                }
            } else {
                // Data validation failed
                echo "Invalid data provided. Please check your inputs.";
            }
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/styles.css">
            <title>Update Cost</title>
        </head>
        <body>
            <div class="container">
                <h2>Update Cost</h2>
                <form method="post">
                    <label for="battery">Battery Cost:</label>
                    <input type="text" name="battery" value="<?= $cost['battery']; ?>" required>

                    <label for="rd">RD Cost:</label>
                    <input type="text" name="rd" value="<?= $cost['rd']; ?>" required>

                    <label for="body">Body Cost:</label>
                    <input type="text" name="body" value="<?= $cost['body']; ?>" required>

                    <label for="subsidy">Subsidy:</label>
                    <input type="text" name="subsidy" value="<?= $cost['subsidy']; ?>" required>

                    <button type="submit">Update Cost</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        // Cost not found by v_id, handle accordingly (e.g., redirect or display an error message)
        echo "Cost not found.";
    }
} else {
    // v_id is not set or not a valid integer, handle accordingly (e.g., redirect or display an error message)
    echo "Invalid vehicle ID.";
}
?>
