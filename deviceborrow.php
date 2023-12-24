<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('location: signin.php');
    exit();
}

// Check if the form for borrowing a device was submitted
if (isset($_POST['borrow_device'])) {
    // Retrieve the device ID from the form
    $device_id = $_POST['device_id'];

    // Connect to the database (assuming login credentials are included)
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Fatal Connection Error");
    }

    // Prepare and execute a SELECT query to get device information
    $select_query = "SELECT * FROM devices WHERE device_id = ?";
    $stmt = $conn->prepare($select_query);
    $stmt->bind_param('i', $device_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $device = $result->fetch_assoc();

    if ($device) {
        // Check if the device is already borrowed
        if ($device['borrowed'] == 1) {
            echo "This device is already borrowed.";
        } else {
            // Calculate the return date (1 month from now)
            $return_date = date('Y-m-d', strtotime('+1 month'));

            // Update the device status to mark it as borrowed and set the return date
            $update_query = "UPDATE devices SET borrowed = 1, return_date = ? WHERE device_id = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param('si', $return_date, $device_id);
            
            if ($stmt->execute()) {
                echo "Device successfully borrowed!";
            } else {
                echo "Error borrowing the device: " . $conn->error;
            }
        }
    } else {
        echo "Device not found.";
    }
    $conn->close();
}
?>