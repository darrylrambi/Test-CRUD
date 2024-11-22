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

// POST 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Masukin data ke database
    $sql = "INSERT INTO users_list (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {
          echo "Account created successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to prepare statement: " . $conn->error;
    }
}

$conn->close();
?>
