<?php
include_once('../includes/functions.php');

// Check if comp_id is set and is a valid integer
if (isset($_GET['comp_id']) && is_numeric($_GET['comp_id'])) {
    $comp_id = $_GET['comp_id'];

    // Get service details by comp_id
    $serviceDetails = getServiceDetailsByCompanyId($comp_id);

    if ($serviceDetails) {
        // Display service details
        echo '<h2>Service Details</h2>';
        echo '<table>';
        echo '<tr>';
        echo '<th>comp_id</th>';
        echo '<th>v_id</th>';
        echo '<th>total_complaints</th>';
        echo '<th>total_comp_solved</th>';
        echo '<th>ratings</th>';
        echo '</tr>';
        foreach ($serviceDetails as $service) {
            echo '<tr>';
            echo '<td>' . $service['comp_id'] . '</td>';
            echo '<td>' . $service['v_id'] . '</td>';
            echo '<td>' . $service['total_complaints'] . '</td>';
            echo '<td>' . $service['total_comp_solved'] . '</td>';
            echo '<td>' . $service['ratings'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        // Service details not found by comp_id, handle accordingly (e.g., redirect or display an error message)
        echo "Service details not found.";
    }
} else {
    // comp_id is not set or not a valid integer, handle accordingly (e.g., redirect or display an error message)
    echo "Invalid company ID.";
}
?>
