<?php
include_once('../includes/functions.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['comp_id'])) {
    $comp_id = $_GET['comp_id'];
    $company = getCompanyById($comp_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Delete Company</title>
</head>
<body>
    <div class="container">
        <h2>Delete Company</h2>
        <?php if (isset($company)) : ?>
            <p>Are you sure you want to delete <?= $company['comp_name']; ?>?</p>
            <form action="../includes/delete_process.php" method="post">
                <input type="hidden" name="comp_id" value="<?= $comp_id; ?>">
                <button type="submit">Delete</button>
            </form>
        <?php else : ?>
            <p>Company not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
