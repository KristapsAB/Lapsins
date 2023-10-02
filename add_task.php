<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = mysqli_connect('localhost', 'root', '', 'task_management');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tasks (title, description, due_date, status) VALUES ('$title', '$description', '$due_date', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "Task added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
