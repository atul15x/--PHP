<?php
session_start();

include "database.php";

if (isset($_POST['lid']) && isset($_POST['lpassword']) && isset($_POST['status'])) {


    $lid = $_POST['lid'];

    $password = $_POST['lpassword'];

    $status = $_POST['status'];

    if ($status == 'admin') {
        $checkmail = "select * from admin_user where idNumber='$lid' ";

        $cheackmailquery = mysqli_query($con, $checkmail);

        $result = mysqli_num_rows($cheackmailquery);

        if ($result > 0) {
            $bdarry = mysqli_fetch_assoc($cheackmailquery);
            $bdpass = $bdarry['password'];

            if ($bdpass == $password) {
                $_SESSION['admin'] = "admin";
                $_SESSION['userid'] = $bdarry['id'];
                $_SESSION['username'] = $bdarry['name'];
                $_SESSION['useremail'] = $bdarry['email'];
                $_SESSION['useridNumber'] = $bdarry['idNumber'];


                $arr = array("status" => 'admin', 'message' => 'Logged Successfully');
            } else {

                $arr = array("status" => 'error', 'message' => 'Password Not Matched');
            }
            echo json_encode($arr);
        } else {
            $arr = array("status" => 'NotFound', 'message' => 'ID Not Found');
            echo json_encode($arr);
        }

    }

    if ($status == 'student') {
        $checkmail = "select * from student_user where idNumber='$lid' ";

        $cheackmailquery = mysqli_query($con, $checkmail);

        $result = mysqli_num_rows($cheackmailquery);

        if ($result > 0) {
            $bdarry = mysqli_fetch_assoc($cheackmailquery);
            $bdpass = $bdarry['password'];

            if ($bdpass == $password) {
                $_SESSION['student'] = "student";
                $_SESSION['userid'] = $bdarry['id'];
                $_SESSION['username'] = $bdarry['name'];
                $_SESSION['useremail'] = $bdarry['email'];
                $_SESSION['useridNumber'] = $bdarry['idNumber'];
                $_SESSION['s_department'] = $bdarry['department'];
                $arr = array("status" => 'student', 'message' => 'Logged Successfully');
            } else {
                $arr = array("status" => 'error', 'message' => 'Password Not Matched');
            }
            echo json_encode($arr);

        } else {
            $arr = array("status" => 'NotFound', 'message' => 'ID Not Found');
            echo json_encode($arr);
        }


    }

    if ($status == 'teacher') {
        $checkmail = "select * from teacher_user where school_id='$lid' ";

        $cheackmailquery = mysqli_query($con, $checkmail);

        $result = mysqli_num_rows($cheackmailquery);

        if ($result > 0) {
            $bdarry = mysqli_fetch_assoc($cheackmailquery);
            $bdpass = $bdarry['password'];

            if ($bdpass == $password) {
                $_SESSION['teacher'] = "teacher";
                $_SESSION['userid'] = $bdarry['id'];
                $_SESSION['username'] = $bdarry['t_name'];
                $_SESSION['useremail'] = $bdarry['t_email'];
                $_SESSION['userIdNumebr'] = $bdarry['school_id'];
                $_SESSION['userNationalID'] = $bdarry['nationalID'];
                $arr = array("status" => 'teacher', 'message' => 'Logged Successfully');

            } else {
                $arr = array("status" => 'error', 'message' => 'Password Not Matched');
            }
            echo json_encode($arr);

        } else {
            $arr = array("status" => 'NotFound', 'message' => 'ID Not Found');
            echo json_encode($arr);
        }


    }

} else {

}



?>