$(document).ready(function() {
    // Function to fetch and display tasks
    function fetchAndDisplayTasks() {
        $.ajax({
            type: 'GET',
            url: 'get_tasks.php', // Replace with your server-side script URL
            success: function(response) {
                $('#task-list').html(response);
                attachDeleteHandlers(); // Attach click handlers to delete buttons
                attachStatusCheckboxHandlers(); // Attach click handlers to status checkboxes
                attachEditHandlers(); // Attach click handlers to edit buttons
            },
            error: function() {
                // Handle errors if any
                alert('An error occurred while fetching tasks.');
            }
        });
    }

    // Function to attach click handlers to delete buttons
    function attachDeleteHandlers() {
        $('.delete-button').click(function(e) {
            e.preventDefault();
            
            var taskId = $(this).data('task-id');
            
            $.ajax({
                type: 'POST',
                url: 'delete_task.php', // Replace with your server-side delete script URL
                data: { id: taskId },
                success: function(response) {
                    alert(response);
                    fetchAndDisplayTasks();
                },
                error: function() {
                    alert('An error occurred while deleting the task.');
                }
            });
        });
    }

    // Function to attach click handlers to status checkboxes
    function attachStatusCheckboxHandlers() {
        $('.status-checkbox').change(function() {
            var taskId = $(this).data('task-id');
            var newStatus = this.checked ? 'Completed' : 'Not Completed';
            
            $.ajax({
                type: 'POST',
                url: 'update_status.php', // Replace with your server-side update script URL
                data: { id: taskId, status: newStatus },
                success: function(response) {
                    alert(response);
                    fetchAndDisplayTasks();
                },
                error: function() {
                    alert('An error occurred while updating the status.');
                }
            });
        });
    }

    // Function to attach click handlers to edit buttons
    function attachEditHandlers() {
        $('.edit-button').click(function(e) {
            e.preventDefault();
            
            var taskId = $(this).data('task-id');
            
            // Open a modal for editing task details
            openEditModal(taskId);
        });
    }

    // Function to open the edit modal
    function openEditModal(taskId) {
        // You can implement your modal or editing form here
        // For demonstration purposes, we'll show a simple JavaScript alert.
        alert('Edit task with ID: ' + taskId);
    }

    // Handle form submission
    $('#task-form').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'add_task.php', // Replace with your server-side script URL
            data: formData,
            success: function(response) {
                alert(response);
                $('#task-form')[0].reset();
                fetchAndDisplayTasks();
            },
            error: function() {
                alert('An error occurred while adding the task.');
            }
        });
    });

    // Initial fetch and display of tasks
    fetchAndDisplayTasks();
});
