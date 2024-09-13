<?php
session_start();
include 'connection.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is authenticated
if (!isset($_SESSION["username"])) {
    echo json_encode(['status' => 'error', 'message' => 'Not authenticated']);
    exit();
}

// Fetch user ID
$email = $_SESSION["username"];
$sql = $conn->prepare("SELECT id FROM users WHERE email = ?");
$sql->bind_param("s", $email);
$sql->execute();
$sql->bind_result($user_id);
$sql->fetch();
$sql->close();

// task addition
if (isset($_POST['action']) && $_POST['action'] === 'add_task') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = $conn->prepare("INSERT INTO tasks (user_id, title, description, category, due_date, status) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param("isssss", $user_id, $title, $description, $category, $due_date, $status);
    $result = $sql->execute();
    $sql->close();

    echo json_encode(['status' => $result ? 'success' : 'error', 'message' => $result ? 'Task added successfully' : 'Failed to add task']);
    exit();
}

// task editing
if (isset($_POST['action']) && $_POST['action'] === 'edit_task') {
    $task_id = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = $conn->prepare("UPDATE tasks SET title = ?, description = ?, category = ?, due_date = ?, status = ? WHERE id = ? AND user_id = ?");
    $sql->bind_param("sssssi", $title, $description, $category, $due_date, $status, $task_id, $user_id);
    $result = $sql->execute();
    $sql->close();

    echo json_encode(['status' => $result ? 'success' : 'error', 'message' => $result ? 'Task updated successfully' : 'Failed to update task']);
    exit();
}

// task deletion
if (isset($_POST['action']) && $_POST['action'] === 'delete_task') {
    $task_id = $_POST['task_id'];

    $sql = $conn->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    $sql->bind_param("ii", $task_id, $user_id);
    $result = $sql->execute();
    $sql->close();

    echo json_encode(['status' => $result ? 'success' : 'error', 'message' => $result ? 'Task deleted successfully' : 'Failed to delete task']);
    exit();
}

// task fetching
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT id, title, description, category, due_date, status FROM tasks WHERE user_id = ?";
    $params = [$user_id];
    $types = 'i';

    if (isset($_GET['category']) && $_GET['category'] !== '') {
        $query .= " AND category = ?";
        $params[] = $_GET['category'];
        $types .= 's';
    }

    if (isset($_GET['status']) && $_GET['status'] !== '') {
        $query .= " AND status = ?";
        $params[] = $_GET['status'];
        $types .= 's';
    }

    $sql = $conn->prepare($query);
    $sql->bind_param($types, ...$params);
    $sql->execute();
    $result = $sql->get_result();
    $tasks = [];
    while ($task = $result->fetch_assoc()) {
        $tasks[] = $task;
    }
    $sql->close();

    echo json_encode(['status' => 'success', 'tasks' => $tasks]);
    exit();
}

// For debugging purposes
echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
?>
