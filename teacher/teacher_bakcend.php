<?php

include "../database.php";

if (isset($_POST['c_id'])) {

    $runid = $_POST['c_id'];

    $query = "SELECT *, running_course.id as run_id   FROM running_course 
            INNER JOIN student_user ON running_course.user_id  = student_user.id
            INNER JOIN course ON running_course.course_id = course.id 
            INNER JOIN teacher_user ON course.c_teacher_id  = teacher_user.id
             WHERE  running_course.id  = $runid  ";

    $search_student_query = mysqli_query($con, $query);

    $respose = array();
    if (mysqli_num_rows($search_student_query) > 0) {
        while ($row = mysqli_fetch_assoc($search_student_query)) {
            $respose = $row;
        }
    } else {
        $respose['status'] = 200;
        $respose['msg'] = "Data Not Found";
    }

    echo json_encode($respose);

} elseif (isset($_POST['m_corse_id']) && isset($_POST['mark'])) {



    $m_corse_id = $_POST['m_corse_id'];
    $mark = $_POST['mark'];

    $query = "update running_course set  mark = '$mark' where id = '$m_corse_id' ";

    $search_student_query = mysqli_query($con, $query);

    if ($search_student_query) {

        echo "Success";

    } else {
        echo "Failed";
    }



}




?>