<?php

function login($username, $password) {
    // Establish a database connection
    $connection = mysqli_connect("localhost", "root", "1234", "esp_db");

    // Check if the connection was successful
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Sanitize the user input to prevent SQL injection
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    // Query to check if the user and password exist in the database
    $query = "SELECT inc_code FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        // Fetch the inc_code from the result
        $row = mysqli_fetch_assoc($result);
        $inc_code = $row['inc_code'];

        // Redirect to dashboard.html with the inc_code as a query parameter
        header("Location: dashboard.php?inc_code=$inc_code");
        exit();
    } else {
        // Login failed, redirect to index.html with an error message
        header("Location: index.html?error=user_or_password_incorrect");
        exit();
    }
    mysqli_close($connection);
}

// Usage example:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $password = $_POST['password'];
    login($user, $password);
}
?>