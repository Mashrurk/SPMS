<?php
    $conn = mysqli_connect('localhost', 'root', '', 'maverick_spms');

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "<script> console.log('Database Connection Successful'); </script>";

?>