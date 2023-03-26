<?php

session_start();

include "../database.php";

if (isset($_GET['course_id'])) {


    $user_id = $_SESSION['userid'];
    $course_id = $_GET['course_id'];

    $user_course = "SELECT *  FROM running_course INNER JOIN course ON running_course.course_id = course.id
             WHERE  running_course.user_id = $user_id AND course.id = $course_id  ";

    $user_course_query = mysqli_query($con, $user_course);

    $user_course_result = mysqli_num_rows($user_course_query);




    if ($user_course_result > 0) {

        echo "AlredayPick";
    } else {

        $insertdata = "insert into running_course (user_id,course_id ) values('$user_id','$course_id')";

        $insertdata_query = mysqli_query($con, $insertdata);
        if ($insertdata_query) {
            echo "Success";
        } else {
            echo "Error";
        }
    }




} else {
    echo "Error";
}

?>