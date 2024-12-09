<?php

$host = "localhost";
$username = "u437361260_demoapi";
$password = "C24X3/3h/";
$dbname = "u437361260_demoapi";

$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO users (name, age, phone, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $name, $age, $phone, $email);

    if ($stmt->execute()) {
        echo "Data stored successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
