<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once('db_config.php');

function getAllCompanies() {
    global $conn;
    $result = $conn->query("SELECT * FROM COMPANY");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getVehiclesByCompanyId($comp_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM VEHICLES WHERE comp_id = ?");
    $stmt->bind_param("i", $comp_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getCompanyById($comp_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM COMPANY WHERE comp_id = ?");
    $stmt->bind_param("i", $comp_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
function getCostDetails() {
    global $conn;
    $result = $conn->query("SELECT * FROM COST");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// functions.php

// Function to get cost details by vehicle ID
function getCostByVehicleId($v_id) {
    global $conn; // Assuming $conn is your database connection

    $query = "SELECT * FROM COST WHERE v_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $v_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false; // No cost details found for the given v_id
    }
}

function getFinanceDetails() {
    global $conn; // Assuming you have a database connection named $conn

    $financeDetails = array();

    // Modify the SQL query based on your actual table and column names
    $sql = "SELECT * FROM FINANCE";

    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $financeDetails[] = $row;
        }
        $result->free();
    }

    return $financeDetails;
}
function getServiceDetailsByCompanyId($comp_id) {
    global $conn; // Assuming $conn is your database connection

    $stmt = $conn->prepare("SELECT * FROM SERVICE WHERE comp_id = ?");
    $stmt->bind_param("i", $comp_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $serviceDetails = $result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();

    return $serviceDetails;
}

function getStationDetails() {
    global $conn; // Assuming you have a database connection named $conn

    $stationDetails = array();

    // Modify the SQL query based on your actual table and column names
    $sql = "SELECT * FROM STATION";

    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $stationDetails[] = $row;
        }
        $result->free();
    }

    return $stationDetails;
}

function getVehicleDetails() {
    global $conn;

    $vehicleDetails = array();

    $sql = "SELECT * FROM VEHICLES";

    $result = $conn->query($sql);

    if (!$result) {
        die("Error: " . $conn->error); // Print the error message for debugging
    }

    while ($row = $result->fetch_assoc()) {
        $vehicleDetails[] = $row;
    }

    $result->free();

    return $vehicleDetails;
}





// Add other functions related to database operations as needed

?>
