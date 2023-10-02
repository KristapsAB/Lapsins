<!DOCTYPE html>
<html>
<head>
    <title>Task Management</title>
</head>
<body>
    <h1>Task Management</h1>

    <!-- Form to create a new task -->
    <h2>Create a New Task</h2>
    <form id="createTaskForm">
        <label>Title:</label>
        <input type="text" name="title" required><br>
        <label>Description:</label>
        <textarea name="description"></textarea><br>
        <label>Due Date:</label>
        <input type="date" name="due_date"><br>
        <label>Status:</label>
        <input type="text" name="status"><br>
        <input type="submit" value="Create Task">
    </form>

    <!-- List all tasks -->
    <h2>All Tasks</h2>
    <ul id="taskList">
        <!-- Tasks will be dynamically added here -->
    </ul>

    <!-- JavaScript code to handle form submission and list tasks -->
    <script>
        // Function to list all tasks
        function listTasks() {
            // Implement JavaScript code to fetch and display tasks here
        }

        // Function to create a new task
        function createTask(formData) {
            // Implement JavaScript code to send a POST request to create a task here
        }

        document.getElementById('createTaskForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            createTask(formData);
        });

        // Initial task listing
        listTasks();
    </script>
</body>
</html>
