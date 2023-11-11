<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectToDatabase();

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Insert user information into the database without specifying the id (auto-increment)
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        // Success
        $_SESSION['username'] = $username;
        header("Location: login.php");
        exit;
    } else {
        // Check for duplicate entry error
        if ($conn->errno == 1062) {
            echo "Error: Duplicate entry. This username or email is already in use.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>

<body>
    <h2>Sign Up</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Sign Up">
    </form>
</body>

</html>
