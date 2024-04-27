<?php
include_once('../includes/functions.php');

$companies = getAllCompanies();

// Check if $companies is null or not an array
if (!is_array($companies)) {
    $companies = array(); // Initialize as an empty array
}

foreach ($companies as &$company) {
    $company['vehicles'] = getVehiclesByCompanyId($company['comp_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Electric Vehicle Management System</title>
</head>
<body>
    <div class="container">
        <h2>Companies List</h2>
        <ul>
            <?php foreach ($companies as $company) : ?>
                <li>
                    <table>
                        <tr>
                            <th>Company Details</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td>
                                <strong><?= $company['comp_name']; ?></strong><br>
                                HQ: <?= $company['comp_hq']; ?><br>
                                Head: <?= $company['comp_head']; ?><br>
                                Employees: <?= $company['no_of_emp']; ?><br>
                                Models: <?= $company['models']; ?><br>
                                
                                <!-- Display additional details from VEHICLES or other related tables -->
                                <?php
                                if (isset($company['vehicles'])) {
                                    echo '<strong>Vehicles:</strong><br>';
                                    foreach ($company['vehicles'] as $vehicle) {
                                        echo "- {$vehicle['v_name']} (Max Range: {$vehicle['max_range']} km)<br>";
                                        // Display other vehicle details as needed
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <a href="/E_way/pages/update.php?comp_id=<?= $company['comp_id']; ?>">Edit</a>
                                <a href="/E_way/pages/delete.php?comp_id=<?= $company['comp_id']; ?>">Delete</a>

                                <!-- Add links for update, delete, and add new cost -->
                                <!-- Inside the loop where you display companies in index.php -->
                                <a href="/E_way/pages/service.php?comp_id=<?= $company['comp_id']; ?>">View Service</a>
                                <a href="/E_way/pages/cost.php?action=update&comp_id=<?= $company['comp_id']; ?>">View Cost</a>
                                <a href="/E_way/pages/finance.php?comp_id=<?= $company['comp_id']; ?>">View Finance</a>
                                <a href="/E_way/pages/station.php">View Stations</a>
                                <a href="/E_way/pages/vehicles.php">View Vehicles</a>
                            </td>
                        </tr>
                    </table>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="/E_way/pages/create.php">Add Company</a>
    </div>
</body>
</html>
