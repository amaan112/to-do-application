<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

    <form method="post">       
    <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required><br> <br>      
        <button type="submit" value="Register">Register</button> <br> <br>
        <h4>Go to Login page?</h4>
        <br>
    <a href="/hw/login.php">Log In</a>
    </form>
    

<?php
include 'connection.php';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Password strength validation
    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[\W_]/", $password)) {
        $errors[] = "Password must be at least 8 characters long and include a combination of letters, numbers, and special characters.";
    }

    $password_pattern = "/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    if (!preg_match($password_pattern, $password)) {
        die("Password must be at least 8 characters long and include a combination of letters, numbers, and special characters.");
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Check if the username or email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("User already exists with this username or email.");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute SQL statement to insert new user
    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Execute and check for errors
    if ($stmt->execute()) {
        echo "Sign-up successful!";
    } else {
        die("Error inserting data: " . $stmt->error);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
</body>
</html>