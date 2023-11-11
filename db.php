<?php

function connectToDatabase() {
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "aaus";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
function closeDatabaseConnection($conn) {
    $conn->close();
}
function getEvents() {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM posts ORDER BY time DESC"; // Fetch events in descending order of time
    $result = $conn->query($sql);

    closeDatabaseConnection($conn);

    return $result;
}

?>
