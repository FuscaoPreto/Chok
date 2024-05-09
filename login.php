<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the entered username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = new mysqli('sql306.thsite.top', 'thsi_36450702', '?ruDo?tc', 'thsi_36450702_base_db');

    // Check if the connection was successful
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare the SQL query
    $sql = "SELECT * FROM Usuarios WHERE usuario = '$username' AND senha = '$password'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Valid login, redirect to the home page
        header('Location: home.php');
        exit;
    } else {
        // Invalid login, display an error message using JavaScript
        echo '<script>alert("Invalid username or password");</script>';
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <form method="POST" action="" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
            <div style="width: 300px; padding: 20px; background-color: #f2f2f2; border: 1px solid #ccc;">
                <label for="username">Usuario:</label>
                <input type="text" name="username" id="username" required style="display: block; justify-content: center; align-items: center; width: 80%; padding: 10px;"><br>
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" required style="display: block; justify-content: center; align-items: center; width: 80%; padding: 10px;"><br>
                <input type="submit" value="Login" style="display: block; width: 80%; padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
            </div>
        </form>
    </body>
</html>