<?php

header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include("config.php");

$c1 = new Config();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_FILES['image'])) {
        echo json_encode(["err" => "No image file uploaded."]);
        exit;
    }

    $image = $_FILES['image'];
    $name = $image['name'];
    $tmp_name = $image['tmp_name'];

    // Validate image extension
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    if (!in_array($extension, $allowed_extensions)) {
        echo json_encode(["err" => "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed."]);
        exit;
    }

    // Generate unique file name
    $unique_name = uniqid('pixabay_') . '.' . $extension;

    // Save image in "images" folder
    $upload_path = "images/$unique_name";
    if (move_uploaded_file($tmp_name, $upload_path)) {
        if ($c1->uploadImage($name, $upload_path)) {
            echo json_encode(["msg" => "Image uploaded successfully."]);
        } else {
            echo json_encode(["err" => "Failed to save image info in database."]);
        }
    } else {
        echo json_encode(["err" => "Failed to upload image to server."]);
    }
} else {
    echo json_encode(["err" => "Only POST method is allowed."]);
}
?>
