<?php
// Biar ga ngulang inputan
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_database";

// Connect ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Database connection failed: " . $conn->connect_error;
    exit();
}

// Handle delete user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'delete') {
        $email = $_POST['email'];

        // Delete the user with the given ID
        $sql = "DELETE FROM users_list WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                echo "User deleted successfully!";
            } else {
                echo "Error deleting user: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Failed to prepare statement: " . $conn->error;
        }
    }
}

$conn->close();
?>