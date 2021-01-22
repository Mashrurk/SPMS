<?php
    include 'conn.php';

    if(isset($_GET['id'])){
        $studentId = $_GET['id'];

        $query = "SELECT * FROM marks WHERE studentId = $studentId";
        $m = $conn->query($query);
        $marks = array();
        $marksM = array();

        $sems = array();

        foreach($m as $v){
            $examId = $v['examId'];
            $query = "SELECT * FROM exam WHERE serial = $examId";
            $exam = $conn->query($query)->fetch_assoc();
            $sem = $exam['semester'];
            for($i=1; $i<=8; $i++){
                if(isset($v['mark'.$i.'Co']) && $v['mark'.$i.'Co']){
                    $c = $v['mark'.$i.'Co'];
                    if(isset($marks[$sem][$c])){
                        $marks[$sem][$c] += $v['mark'.$i];
                    }else{
                        $marks[$sem][$c] = $v['mark'.$i];
                    }

                    if(isset($marksM[$sem][$c])){
                        $marksM[$sem][$c] += $exam['q'.$i.'Max'];
                    }else{
                        $marksM[$sem][$c] = $exam['q'.$i.'Max'];
                    }
                }
            }
            $crs = $exam['courseId'];
            $query = "SELECT * FROM co WHERE courseId = '$crs'";
            $sems[$sem] = $conn->query($query)->num_rows;

            
        }

        $query = "SELECT programId FROM student WHERE id = $studentId";
        $programId = $conn -> query($query)->fetch_row()[0];

        $query = "SELECT serial FROM plo WHERE programId = '$programId' ORDER BY indx";
        $ploR = $conn -> query($query);
        $ploId = array();
        $i = 1;
        foreach($ploR as $p){
            $ploId[$i] = $p['serial'];
            $i++;
        }

        $ploF = array();
        foreach($marks as $s => $m){
            for($i=1; $i<=count($ploId); $i++){
                $query = "SELECT * FROM co WHERE ploId = ".$ploId[$i];
                $coList = $conn->query($query)->fetch_assoc();
                if($coList==null){
                    continue;
                }
                $mark = 0; $max = 0;
                for($j=1; $j<=10; $j++){
                    if($coList['co'.$j]==1){
                        $mark += $marks[$s][$j];
                        $max += $marksM[$s][$j];
                    }
                }
                if(round((($mark * 100) / $max), 2) > 40){
                    if(isset($ploF[$s])){
                        $ploF[$s]++;
                    }else{
                        $ploF[$s]=1;
                    }
                }
            }
        }

    }else{
        $studentId = 0;
    }

    if(isset($_GET['semester'])){
        $semester = $_GET['semester'];
    }else{
        $semester = null;
    }


?>
