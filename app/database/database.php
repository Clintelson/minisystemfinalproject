<?php

$host = "localhost";    
$user = "root";      
$password = "";          
$database = "webproject";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    error_log("connection failed: " . $conn->connect_error);
    die("Database connection failed. Please try again.");
}

$stmt = $conn->prepare("SELECT * FROM information WHERE email = ?");
$email = "webproject@gmail.com";
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "User: " . $row['name'] . "<br>";
}

$stmt->close();

?>