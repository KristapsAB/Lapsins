<?php
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

// Fetch tasks from the database (assuming you have a "tasks" table)
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<ul>';
    while ($row = $result->fetch_assoc()) {
        $taskId = $row['id'];
        $status = $row['status'];
        $completed = ($status === 'Completed') ? 'checked' : '';
        
        echo '<li>' . $row['title'] . ' - ' . $row['description'] . ' - Due: ' . $row['due_date'] . ' - Status: <input type="checkbox" class="status-checkbox" data-task-id="' . $taskId . '" ' . $completed . '> ' . $status . ' <button class="edit-button" data-task-id="' . $taskId . '">Edit</button> <button class="delete-button" data-task-id="' . $taskId . '">Delete</button></li>';
    }
    echo '</ul>';
} else {
    echo 'No tasks found.';
}

// Close the database connection
$conn->close();
?>
