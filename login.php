<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

    <form method="post" >
    <h1 id=a1>To-Do List Application</h1>
        <label for="email">E mail</label>
        <input name="email" type="email" required>
        <label for="Password">Password</label>
        <input name="password" type="password" required>
        <button type="submit">login</button>
        <br> <br>
        <h3>new user? Signup!</h3>
        <br>
        <a href="/hw/signup.php">Sign up</a>
     </form>

    <?php
    session_start();
    include 'connection.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];
    
    $sql =$conn->prepare("select password_hash from users where email = ?");
    if ($sql === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $sql->bind_param("s", $email);
    $sql->execute();
    $sql->store_result();

    if ($sql->num_rows === 1) {
        $sql->bind_result($password_hash);
        $sql->fetch();

        // Verify the password against the hashed password
        if (password_verify($password, $password_hash)) {
        // User is authenticated, start a session
        $_SESSION["username"] = $email;
        header("Location: dashboard.php"); // Redirect to a protected area
        exit();
    } else {
        echo "Invalid username or password";
    }
    }else {
        echo "Invalid username or password";  
    }
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql->close();
    }

mysqli_close($conn);  
    ?>
</body>
</html>