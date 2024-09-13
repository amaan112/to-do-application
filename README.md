  <h1>Project README</h1>
  <h2>Overview</h2>
    <p>This web application provides functionalities for user management and task handling using PHP and MySQL. It emphasizes secure authentication and efficient task management.</p>
    <h2>Project Structure</h2>
    <ul>
        <li><strong>login.php</strong><br>Handles user authentication via email and password.</li>
        <li><strong>signup.php</strong><br>Facilitates user registration by inserting new user data into the database.</li>
        <li><strong>connection.php</strong><br>Establishes a connection to the MySQL database using PHP.</li>
        <li><strong>dashboard.php</strong><br>Displays user tasks and provides functionalities to add, delete, and filter tasks.</li>
        <li><strong>ajax.php</strong><br>Manages asynchronous task operations (CRUD) using AJAX requests.</li>
        <li><strong>SQL Database</strong><br>Contains the schema and tables required for user and task data management.</li>
    </ul>
    <h2>Features</h2>
    <ul>
        <li><strong>User Authentication</strong><br>Implements secure login and registration with password hashing using PHP’s <code>password_hash()</code> function.</li>
        <li><strong>Task Management</strong><br>Allows users to view, add, delete, and filter tasks.</li>
        <li><strong>AJAX Integration</strong><br>Provides a dynamic user experience by performing asynchronous task operations without page reloads.</li>
    </ul>
    <h2>Security Practices</h2>
    <ul>
        <li><strong>Password Hashing</strong><br>Passwords are hashed using <code>password_hash()</code> before being stored in the database to ensure secure storage.</li>
        <li><strong>Session Management</strong><br>PHP sessions are utilized to maintain secure user login states.</li>
    </ul>
    <h2>Installation and Setup</h2>
    <ol>
        <li><strong>Database Setup</strong><br>
            <ul>
                <li>Import the provided SQL schema into your MySQL database.</li>
                <li>Update the database credentials in <code>connection.php</code> to match your MySQL server configuration.</li>
            </ul>
        </li>
        <li><strong>Configuration</strong><br>
            <ul>
                <li>Ensure <code>connection.php</code> contains the correct database connection details.</li>
                <li>Confirm that your PHP environment has necessary extensions such as MySQLi enabled.</li>
            </ul>
        </li>
        <li><strong>Testing Login</strong><br>
            <ul>
                <li>Use the following credentials to test the login functionality:</li>
                <li><strong>Email</strong>: <code>ak0693@gmail.com</code></li>
                <li><strong>Password</strong>: <code>Khan&112</code></li>
            </ul>
        </li>
        <li><strong>Accessing the Application</strong><br>
            <ul>
                <li>Navigate to <code>login.php</code> to access the login page.</li>
                <li>Register new users via <code>signup.php</code>.</li>
                <li>After logging in, users will be redirected to <code>dashboard.php</code> for task management.</li>
                <li>Task operations are handled through AJAX requests in <code>ajax.php</code>.</li>
            </ul>
        </li>
    </ol>
    <h2>Usage</h2>
    <ul>
        <li><strong>Login</strong><br>Authenticate by providing your email and password on <code>login.php</code>.</li>
        <li><strong>Sign Up</strong><br>Register a new account using <code>signup.php</code>.</li>
        <li><strong>Dashboard</strong><br>On <code>dashboard.php</code>, manage your tasks:
            <ul>
                <li><strong>View Tasks</strong>: Display your task list.</li>
                <li><strong>Add Task</strong>: Insert new tasks into your list.</li>
                <li><strong>Delete Task</strong>: Remove tasks from your list.</li>
                <li><strong>Filter Tasks</strong>: Apply filters to view tasks based on criteria.</li>
            </ul>
        </li>
        <li><strong>AJAX Operations</strong><br>Perform asynchronous operations such as create, read, update, and delete (CRUD) through <code>ajax.php</code>.</li>
    </ul>
    <h2>Troubleshooting</h2>
    <ul>
        <li><strong>Database Connection Issues</strong><br>Verify credentials in <code>connection.php</code> and ensure the MySQL server is running.</li>
        <li><strong>AJAX Failures</strong><br>Check <code>ajax.php</code> for proper handling of AJAX requests and inspect the browser console for errors.</li>
    </ul>
    </ol>
