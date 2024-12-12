<?php
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json");

    include("config.php");
    $c1 = new Config();

    $arr = []; 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $res = $c1->insert($name, $age, $phone, $email);

        if ($res === true) {
            $arr['msg'] = "Data Inserted Successfully";
        } else {
            $arr['msg'] = "Error: " . $res; 
        }
    } else {
        $arr['error'] = "Only POST requests are allowed";
    }

    echo json_encode($arr);
?>
