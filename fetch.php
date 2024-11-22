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

// Fetch users
$sql = "SELECT email, password FROM users_list";
$result = $conn->query($sql);

if ($result) {
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['email']}</td>
                <td>{$row['password']}</td>
                <td>
                    <button class='btn btn-danger deleteBtn'>Delete</button>
                </td>
              </tr>";
    }
  } else {
    echo "<tr><td colspan='3'>No users found.</td></tr>";
  }
} else {
  // Query failed, handle the error
  echo "Error: " . $conn->error;
}

$conn->close();
?>
