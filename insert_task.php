<?php
// Establish a database connection (replace with your database credentials)
$db = new mysqli('localhost', 'username', 'password', 'task_management');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Get data from the AJAX request
$title = $_POST['title'];
$description = $_POST['description'];
$due_date = $_POST['due_date'];
$status = $_POST['status'];

// Prepare and execute the SQL query to insert the task
$sql = "INSERT INTO tasks (title, description, due_date, status) VALUES (?, ?, ?, ?)";
$stmt = $db->prepare($sql);
$stmt->bind_param('ssss', $title, $description, $due_date, $status);

if ($stmt->execute()) {
    echo "Task added successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$db->close();
?>
