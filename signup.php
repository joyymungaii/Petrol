<?php
session_start();
include 'config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($name) || empty($username) || empty($password)) {
        die("All fields are required!");
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Username already exists!");
    } else {
        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO users (name, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $username, $hashedPassword);

        if ($stmt->execute()) {
            echo "Sign-up successful! Redirecting...";
            header("refresh:2;url=login.html"); // Redirect to login after 2 seconds
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}
$conn->close();
?>
