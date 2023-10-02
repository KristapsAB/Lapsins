$(document).ready(function() {
    // Function to load and display tasks
    function loadTasks() {
        $.ajax({
            url: 'api.php',
            method: 'GET',
            dataType: 'json',
            success: function(tasks) {
                // Ensure tasks is an array
                if (Array.isArray(tasks)) {
                    var taskTable = $('#task-table tbody');
                    taskTable.empty(); // Clear existing rows
            
                    tasks.forEach(function(task) {
                        var row = $('<tr>');
                        row.append($('<td>').text(task.id));
                        row.append($('<td>').text(task.title));
                        row.append($('<td>').text(task.description));
                        row.append($('<td>').text(task.due_date));
                        row.append($('<td>').text(task.status));
                        row.append($('<td>').html('<button class="edit-button" data-id="' + task.id + '">Edit</button>'));
                        row.append($('<td>').html('<button class="delete-button" data-id="' + task.id + '">Delete</button>'));
                        taskTable.append(row);
                    });
                } else {
                    console.error('Response is not an array:', tasks);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching tasks:', error);
            }
        });
    }

    // Load and display tasks when the page loads
    loadTasks();

    // Handle form submission (adding a task)
    $('#task-form').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: 'insert.php',
            method: 'POST',
            data: {
                title: $('#title').val(),
                description: $('#description').val(),
                due_date: $('#due_date').val(),
                status: $('#status').val()
            },
            success: function(response) {
                if (response.success) {
                    alert('Task successfully added!');
                    loadTasks();
                } else {
                    alert('Error adding task: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding task:', error);
            }
        });
    });

    $('#task-table').on('click', '.edit-button', function() {
        var taskId = $(this).data('id');
        // Rest of your edit button click handler code...
    });

    $('#task-table').on('click', '.delete-button', function() {
        var taskId = $(this).data('id');
        console.log(taskId);
        
        if (confirm('Are you sure you want to delete this task?')) {
            $.ajax({
                url: 'delete.php',
                method: 'POST',
                data: {
                    id: taskId
                },
                success: function(response) {
                    if (response.success) {
                        alert('Task deleted successfully!');
                        loadTasks();
                    } else {
                        alert('Error deleting task: ' + response.message);
                    }
                },                
                error: function(xhr, status, error) {
                    console.error('Error deleting task:', error);
                }
            });
        }
    });
});
