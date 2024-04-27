<?php
include_once('../includes/functions.php');

// Handle actions here if needed

$financeDetails = getFinanceDetails();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Finance Display</title>
</head>
<body>
    <div class="container">
        <h2>Finance Display</h2>
        <table>
            <tr>
                <th>comp_id</th>
                <th>total_sales</th>
                <th>vehicles_sold</th>
                <th>profit</th>
                <th>total_spent</th>
            </tr>
            <?php foreach ($financeDetails as $finance) : ?>
                <tr>
                    <td><?= $finance['comp_id']; ?></td>
                    <td><?= $finance['total_sales']; ?></td>
                    <td><?= $finance['vehicles_sold']; ?></td>
                    <td><?= $finance['profit']; ?></td>
                    <td><?= $finance['total_spent']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
