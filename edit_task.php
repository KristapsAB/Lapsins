<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $taskId = $_POST['id'];
    
    // Get other edited task details from the POST data
    $editedTitle = $_POST['edited_title'];
    $editedDescription = $_POST['edited_description'];
    $editedDueDate = $_POST['edited_due_date'];
    
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

    // Prepare and execute an UPDATE query to update task details
    $sql = "UPDATE tasks SET title = ?, description = ?, due_date = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $editedTitle, $editedDescription, $editedDueDate, $taskId);

    if ($stmt->execute()) {
        // Task details updated successfully
        echo "Task details updated successfully.";
    } else {
        // An error occurred while updating task details
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
