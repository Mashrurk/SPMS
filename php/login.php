<?php
    include 'include/conn.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "SELECT * FROM $role WHERE email = '$email' AND password = '$password'";
    $res = $conn->query($query)->fetch_assoc();

    if($res == null){
        header("Location: ../login.php?response=401");
    }else{
        session_start();
        $_SESSION['user_id'] = $res['id'];
        $_SESSION['name'] = $res['firstName'] . " " . $res['lastName'];
        $_SESSION['role'] = $role;
        header("Location: ../login.php?response=200");
    }

?>