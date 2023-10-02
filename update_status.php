<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
    // Get the task ID and new status from the POST data
    $taskId = $_POST['id'];
    $newStatus = $_POST['status'];
    
    // Establish a database connection
    $servername = "localhost"; // Replace with your MySQL server address
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "task_management"; // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute an UPDATE query to change the task's status
    $sql = "UPDATE tasks SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newStatus, $taskId);

    if ($stmt->execute()) {
        // Status updated successfully
        echo "Status updated successfully.";
    } else {
        // An error occurred while updating the status
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
