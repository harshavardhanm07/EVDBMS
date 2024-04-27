<?php
include_once('../includes/functions.php');

// Handle actions here if needed

$vehicleDetails = getVehicleDetails();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Vehicle Display</title>
</head>
<body>
    <div class="container">
        <h2>Vehicle Display</h2>
        <table>
            <tr>
                <th>v_id</th>
                <th>comp_id</th>
                <th>v_name</th>
                <th>max_range</th>
                <th>cost</th>
                <th>max_speed</th>
                <th>hours</th>
                <th>voltage</th>
                <th>station_id</th>
            </tr>
            <?php foreach ($vehicleDetails as $vehicle) : ?>
                <tr>
                    <td><?= $vehicle['v_id']; ?></td>
                    <td><?= $vehicle['comp_id']; ?></td>
                    <td><?= $vehicle['v_name']; ?></td>
                    <td><?= $vehicle['max_range']; ?></td>
                    <td><?= $vehicle['cost']; ?></td>
                    <td><?= $vehicle['max_speed']; ?></td>
                    <td><?= $vehicle['hours']; ?></td>
                    <td><?= $vehicle['voltage']; ?></td>
                    <td><?= $vehicle['station_id']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
