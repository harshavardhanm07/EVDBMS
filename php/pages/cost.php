<?php
include_once('../includes/functions.php');

// Handle update, delete, and add new cost actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'update':
                // Check if v_id is set
                if (isset($_POST['v_id'])) {
                    $v_id = $_POST['v_id'];
                    // Redirect to an update page with v_id
                    header("Location: update_cost.php?v_id=$v_id");
                    exit();
                }
                break;

            case 'delete':
                // Check if v_id is set
                if (isset($_POST['v_id'])) {
                    $v_id = $_POST['v_id'];
                    // Handle delete action
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
                }
                break;

            case 'add':
                // Check if v_id is set
                if (isset($_POST['v_id'])) {
                    $v_id = $_POST['v_id'];
                    // Redirect to an add new cost page with v_id
                    header("Location: add_cost.php?v_id=$v_id");
                    exit();
                }
                break;

            default:
                // Handle unknown action
                break;
        }
    }
}

$costDetails = getCostDetails();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Cost Display</title>
</head>
<body>
    <div class="container">
        <h2>Cost Display</h2>
        <table>
            <tr>
                <th>v_id</th>
                <th>v_name</th>
                <th>battery</th>
                <th>rd</th>
                <th>body</th>
                <th>subsidy</th>
                <th>total</th>
                <th>Action</th>
            </tr>
            <?php foreach ($costDetails as $cost) : ?>
                <tr>
                    <td><?= $cost['v_id']; ?></td>
                    <td><?= $cost['v_name']; ?></td>
                    <td><?= $cost['battery']; ?></td>
                    <td><?= $cost['rd']; ?></td>
                    <td><?= $cost['body']; ?></td>
                    <td><?= $cost['subsidy']; ?></td>
                    <td><?= $cost['total']; ?></td>
                    <td>
                        <!-- Add buttons or links for update, delete, and add new cost -->
                        <form method="post" action="">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="v_id" value="<?= $cost['v_id']; ?>">
                            <button type="submit">Update</button>
                        </form>

                        <form method="post" action="">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="v_id" value="<?= $cost['v_id']; ?>">
                            <button type="submit">Delete</button>
                        </form>

                        <form method="post" action="">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="v_id" value="<?= $cost['v_id']; ?>">
                            <button type="submit">Add New Cost</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
