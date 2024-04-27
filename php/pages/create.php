<?php
include_once('../includes/functions.php');

// Handle form submission for adding a new company
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize form data (you may want to add more validation)
    $compName = filter_input(INPUT_POST, 'comp_name', FILTER_SANITIZE_STRING);
    $compHQ = filter_input(INPUT_POST, 'comp_hq', FILTER_SANITIZE_STRING);
    $compHead = filter_input(INPUT_POST, 'comp_head', FILTER_SANITIZE_STRING);
    $noOfEmp = filter_input(INPUT_POST, 'no_of_emp', FILTER_VALIDATE_INT);
    $compModels = filter_input(INPUT_POST,'models',FILTER_VALIDATE_INT);

    // Perform the insertion into the database
    $insertStmt = $conn->prepare("INSERT INTO COMPANY (comp_name, comp_hq, comp_head, no_of_emp,models) VALUES (?, ?, ?, ?)");
    $insertStmt->bind_param("sssi", $compName, $compHQ, $compHead, $noOfEmp,$compModels);

    if ($insertStmt->execute()) {
        // Insertion successful
        header("Location: index.php"); // Redirect to the companies list page
        exit();
    } else {
        // Insertion failed
        echo "Insertion failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Add Company</title>
</head>
<body>
    <div class="container">
        <h2>Add Company</h2>
        <form method="post">
            <label for="comp_name">Company Name:</label>
            <input type="text" name="comp_name" required>

            <label for="comp_hq">Headquarters:</label>
            <input type="text" name="comp_hq" required>

            <label for="comp_head">Company Head:</label>
            <input type="text" name="comp_head" required>

            <label for="no_of_emp">Number of Employees:</label>
            <input type="number" name="no_of_emp" required>

            <label for="models">Number of Models:</label>
            <input type="number" name="models" required>

            <button type="submit">Add Company</button>
        </form>
    </div>
</body>
</html>
