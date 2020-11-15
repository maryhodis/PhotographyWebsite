<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photography_user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO events (title, start, end)
VALUES ('Photoshootn', '2020-11-12 14:00:05', '2020-11-12 15:00:05')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>