<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Get the task ID from the POST data
    $taskId = $_POST['id'];
    
    // Database connection parameters
    $servername = "localhost"; // Replace with your MySQL server address
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $dbname = "task_management"; // Replace with your database name

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute a DELETE query to remove the task with the given ID
    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $taskId);

    if ($stmt->execute()) {
        // Task deleted successfully
        echo "Task deleted successfully.";
    } else {
        // An error occurred while deleting the task
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
