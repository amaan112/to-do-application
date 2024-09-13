Project README
Overview
This project is a web application that allows users to sign up, log in, manage tasks, and handle various task operations securely. It is built using PHP and MySQL, with a focus on secure user authentication and efficient task management.

Project Structure
login.php: Handles user login with email and password authentication.
signup.php: Allows new users to register by adding their details to the database.
connection.php: Establishes a connection to the MySQL database.
dashboard.php: Displays user tasks and provides functionalities to add, delete, and filter tasks.
ajax.php: Manages task operations including editing, adding, and deleting via AJAX requests.
SQL Database: Contains the necessary tables and schemas for user authentication and task management.
Features
User Authentication: Secure login and signup mechanisms.
Task Management: Users can view, add, delete, and filter tasks.
AJAX Integration: Enhances user experience by enabling dynamic task operations.
Security Practices
Password Hashing: Passwords are hashed before being stored in the database using PHP's password_hash() function to ensure secure storage.
Session Management: PHP sessions are used to maintain user login states.
Installation and Setup
Database Setup:

Import the provided SQL database schema into your MySQL database.
Update the database credentials in connection.php to match your MySQL server configuration.
Configuration:

Ensure that the connection.php file contains the correct database credentials.
Make sure your PHP environment has the necessary extensions installed (e.g., MySQLi).
Testing Login:

A default user for testing login is provided:
Email: ak0693@gmail.com
Password: Khan&112
Accessing the Application:

Navigate to login.php to access the login page.
Use signup.php to register new users.
After logging in, you will be redirected to dashboard.php where you can manage tasks.
Task operations are handled via AJAX requests through ajax.php.
Usage
Login:

Enter your email and password in the login.php page to access your account.
Sign Up:

Use the signup.php page to create a new account.
Dashboard:

Once logged in, manage your tasks from the dashboard.php page. You can view, add, delete, and filter tasks.
AJAX Operations:

Task operations such as editing, adding, and deleting are handled dynamically through AJAX requests in ajax.php.
Security Recommendations
Update Passwords Regularly: Ensure users update their passwords regularly and use strong, unique passwords.
Secure Sessions: Implement additional security measures for sessions, such as regenerating session IDs and using secure cookies.
Validate Inputs: Always validate and sanitize user inputs to protect against SQL injection and other attacks.
