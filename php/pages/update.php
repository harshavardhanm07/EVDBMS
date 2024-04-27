<?php
include_once('../includes/functions.php');

// Check if comp_id is set and is a valid integer
if (isset($_GET['comp_id']) && is_numeric($_GET['comp_id'])) {
    $comp_id = $_GET['comp_id'];

    // Get company details by ID
    $company = getCompanyById($comp_id);

    if ($company) {
        // Handle form submission for updating company details
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize form data (you may want to add more validation)
            $newCompName = filter_input(INPUT_POST, 'comp_name', FILTER_SANITIZE_STRING);
            $newCompHQ = filter_input(INPUT_POST, 'comp_hq', FILTER_SANITIZE_STRING);
            $newCompHead = filter_input(INPUT_POST, 'comp_head', FILTER_SANITIZE_STRING);
            $newNoOfEmp = filter_input(INPUT_POST, 'no_of_emp', FILTER_VALIDATE_INT);
            $newModels = filter_input(INPUT_POST,'models',FILTER_VALIDATE_INT);


            // Perform the update in the database
            $updateStmt = $conn->prepare("UPDATE COMPANY SET comp_name=?, comp_hq=?, comp_head=?, no_of_emp=? ,models=? WHERE comp_id=?");
            $updateStmt->bind_param("ssssii", $newCompName, $newCompHQ, $newCompHead, $newNoOfEmp,$newModels,$comp_id);

            if ($updateStmt->execute()) {
                // Update successful
                header("Location: index.php"); // Redirect to the companies list page
                exit();
            } else {
                // Update failed
                echo "Update failed. Please try again.";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Update Company Details</title>
</head>
<body>
    <div class="container">
        <h2>Update Company Details</h2>
        <form method="post">
            <label for="comp_name">Company Name:</label>
            <input type="text" name="comp_name" value="<?= $company['comp_name']; ?>" required>

            <label for="comp_hq">Headquarters:</label>
            <input type="text" name="comp_hq" value="<?= $company['comp_hq']; ?>" required>

            <label for="comp_head">Company Head:</label>
            <input type="text" name="comp_head" value="<?= $company['comp_head']; ?>" required>

            <label for="no_of_emp">Number of Employees:</label>
            <input type="number" name="no_of_emp" value="<?= $company['no_of_emp']; ?>" required>

            <label for="models">Number of Models:</label>
            <input type="number" name="models" value="<?= $company['models']; ?>" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
<?php
    } else {
        // Company not found by ID, handle accordingly (e.g., redirect or display an error message)
        echo "Company not found.";
    }
} else {
    // comp_id is not set or not a valid integer, handle accordingly (e.g., redirect or display an error message)
    echo "Invalid company ID.";
}
?>
