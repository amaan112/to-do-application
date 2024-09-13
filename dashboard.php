<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style1.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h1>Welcome to Your Dashboard</h1>

<!-- Task Form -->
<form id="taskForm">
    <h2>Add New Task</h2>
    <label for="title">Title:</label>
    <input type="text" name="title" required>
    <label for="description">Description:</label>
    <textarea name="description"></textarea>
    <label for="category">Category:</label>
    <input type="text" name="category">
    <label for="due_date">Due Date:</label>
    <input type="date" name="due_date">
    <label for="status">Status:</label>
    <select name="status">
        <option value="Pending">Pending</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
    </select>
    <button type="submit">Add Task</button>
</form>

<!-- Filters -->
<h2>Filter Tasks</h2>
<form id="filterForm">
    <label for="category">Category:</label>
    <input type="text" name="category">
    <label for="status">Status:</label>
    <select name="status">
        <option value="">All</option>
        <option value="Pending">Pending</option>
        <option value="In Progress">In Progress</option>
        <option value="Completed">Completed</option>
    </select>
    <button type="submit">Filter</button>
</form>

<!-- Task List -->
<h2>Your Tasks</h2>
<table id="taskTable">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Tasks will be here -->
    </tbody>
</table>

<a href="/hw/logout.php"><button type="submit">Log out</button></a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Load tasks initially
    loadTasks();

    // Add task
    $('#taskForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            data: $(this).serialize() + '&action=add_task',
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                if (response.status === 'success') {
                    loadTasks();
                    $('#taskForm')[0].reset();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('An error occurred while adding the task.');
            }
        });
    });

    // Delete task
    $(document).on('click', '.delete-task', function() {
        if (confirm('Are you sure?')) {
            var taskId = $(this).data('id');
            $.ajax({
                url: 'ajax.php',
                method: 'POST',
                data: { action: 'delete_task', task_id: taskId },
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    if (response.status === 'success') {
                        loadTasks();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('An error occurred while deleting the task.');
                }
            });
        }
    });

    // Load tasks with filtering
    $('#filterForm').on('submit', function(event) {
        event.preventDefault();
        loadTasks();
    });

    function loadTasks() {
        $.ajax({
            url: 'ajax.php',
            method: 'GET',
            data: $('#filterForm').serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var tasks = response.tasks;
                    var taskRows = '';
                    tasks.forEach(function(task) {
                        taskRows += '<tr>';
                        taskRows += '<td>' + task.title + '</td>';
                        taskRows += '<td>' + task.description + '</td>';
                        taskRows += '<td>' + task.category + '</td>';
                        taskRows += '<td>' + task.due_date + '</td>';
                        taskRows += '<td>' + task.status + '</td>';
                        taskRows += '<td><button class="delete-task" data-id="' + task.id + '">Delete</button></td>';
                        taskRows += '</tr>';
                    });
                    $('#taskTable tbody').html(taskRows);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('An error occurred while loading tasks.');
            }
        });
    }
});




</script>

</body>
</html>
