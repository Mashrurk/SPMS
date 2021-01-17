<?php
    include 'include/conn.php';

    $semester   = $_POST['semester'];
    $section    = $_POST['section'];
    $examName   = $_POST['exam']; 
    $courseId   = $_POST['courseId'];
    $studentId   = $_POST['studentId'];
    
    $query = "SELECT serial FROM exam WHERE semester = '$semester' AND courseId = '$courseId' AND examName = '$examName' AND section = '$section'";
    $res = $conn->query($query)->fetch_row()[0];

    if($res == null){
        $query = "INSERT INTO exam (semester, section, examName, courseId) 
                    VALUES ('$semester', '$section', '$examName', '$courseId')";
        $conn->query($query);
        $res = $conn->insert_id;
    }  
    
    $query = "INSERT INTO marks (examId, studentId) VALUES($res, $studentId)";
    $conn->query($query);

    for($i=1; $i<=8; $i++){
        if(isset($_POST["q".$i])){
            $mark = $_POST["q".$i];
            $co = $_POST["q".$i."co"];
            $query = "UPDATE marks SET mark".$i."='$mark', mark".$i."Co ='$co' WHERE examId=$res AND studentId=$studentId";
            $conn->query($query);
        }else{
            continue;
        }
    }
    header("Location: ../faculty-marks-entry.php?response=200");
    
?>