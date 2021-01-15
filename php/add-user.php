<?php
    include 'include/conn.php';

    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "";

    if($role == "student"){
        $programId = $_POST['programId'];
        $query = "INSERT INTO $role (id, firstName, lastName, email, programId, password)
              VALUES ('$id', '$firstName', '$lastName', '$email', '$programId', '$password')";
    }else{
        $query = "INSERT INTO $role (id, firstName, lastName, email, password)
              VALUES ('$id', '$firstName', '$lastName', '$email', '$password')";
    }

    if($conn->query($query) == TRUE){
        header("Location: ../admin-add-user.php?response=200");
    }else{
        //echo $conn->error;
        header("Location: ../admin-add-user.php?response=501");
    }

?>