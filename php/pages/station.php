<?php
include_once('../includes/functions.php');

$stations = getStationDetails();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Station Display</title>
</head>
<body>
    <div class="container">
        <h2>Station Display</h2>
        <table>
            <tr>
                <th>station_id</th>
                <th>comp_id</th>
                <th>location</th>
                <th>no_of_units</th>
                <th>cost</th>
                <th>max_limit</th>
            </tr>
            <?php foreach ($stations as $station) : ?>
                <tr>
                    <td><?= $station['station_id']; ?></td>
                    <td><?= $station['comp_id']; ?></td>
                    <td><?= $station['location']; ?></td>
                    <td><?= $station['no_of_units']; ?></td>
                    <td><?= $station['cost']; ?></td>
                    <td><?= $station['max_limit']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
