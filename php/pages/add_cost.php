<?php
include_once('../includes/functions.php');

// Handle form submission for adding a new cost
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize form data (you may want to add more validation)
    $v_id = filter_input(INPUT_POST, 'v_id', FILTER_VALIDATE_INT);
    $battery = filter_input(INPUT_POST, 'battery', FILTER_VALIDATE_FLOAT);
    $rd = filter_input(INPUT_POST, 'rd', FILTER_VALIDATE_FLOAT);
    $body = filter_input(INPUT_POST, 'body', FILTER_VALIDATE_FLOAT);
    $subsidy = filter_input(INPUT_POST, 'subsidy', FILTER_VALIDATE_FLOAT);

    // Check if all required data is provided
    if ($v_id && $battery !== false && $rd !== false && $body !== false && $subsidy !== false) {
        // Perform the insertion into the database
        $insertStmt = $conn->prepare("INSERT INTO COST (v_id, battery, rd, body, subsidy) VALUES (?, ?, ?, ?, ?)");
        $insertStmt->bind_param("sidddd", $cpm_name,$v_id, $battery, $rd, $body, $subsidy);

        if ($insertStmt->execute()) {
            // Insertion successful
            header("Location: cost.php"); // Redirect to the cost display page
            exit();
        } else {
            // Insertion failed
            echo "Insertion failed. Please try again.";
        }
    } else {
        // Data validation failed
        echo "Invalid data provided. Please check your inputs.";
    }
}

// If not a POST request, you might want to handle this case or redirect the user
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Add New Cost</title>
</head>
<body>
    <div class="container">
        <h2>Add New Cost</h2>
        <form method="post" action="">
            <input type="hidden" name="v_id" value="<?= $_GET['v_id']; ?>">
            <label for="battery">Battery Cost:</label>
            <input type="number" name="battery" required step="0.01">
            <br>
            <label for="rd">Research and Development Cost:</label>
            <input type="number" name="rd" required step="0.01">
            <br>
            <label for="body">Body Cost:</label>
            <input type="number" name="body" required step="0.01">
            <br>
            <label for="subsidy">Subsidy:</label>
            <input type="number" name="subsidy" required step="0.01">
            <br>
            <button type="submit">Add Cost</button>
        </form>
    </div>
</body>
</html>

