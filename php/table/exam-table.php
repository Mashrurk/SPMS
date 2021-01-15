<?php
    include '../include/conn.php';

    $table = "CREATE TABLE exam(
        serial INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        semester VARCHAR(100) NOT NULL, 
        section VARCHAR(10) NOT NULL,
        examName VARCHAR(50) NOT NULL,
        courseId VARCHAR(100) NOT NULL,
        FOREIGN KEY (courseId) REFERENCES course(id)
    )";

    if ($conn->query($table) === TRUE) {
        echo "exam table is here.<br>";
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }
?>