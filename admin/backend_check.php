<?php
session_start();

include "../database.php";

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['idNumber'])) {

    $id = $_POST['id'];
    $updatename = $_POST['name'];
    $updateemail = $_POST['email'];
    $idNumber = $_POST['idNumber'];

    $update = "update admin_user set name = '$updatename',email = '$updateemail',idNumber = '$idNumber' where id='$id' ";

    $update_query = mysqli_query($con, $update);

    if ($update_query) {
        echo "Success";
    } else {
        echo "Error";
    }
} elseif (isset($_POST['admin_add_name']) && isset($_POST['admin_add_email']) && isset($_POST['admin_add_idnumber'])) {

    $name = $_POST['admin_add_name'];
    $email = $_POST['admin_add_email'];
    $idNumber = $_POST['admin_add_idnumber'];
    $password = $_POST['admin_add_idnumber'];

    $insertdata = "insert into admin_user (name,email,idNumber,password) values('$name','$email', $idNumber,'$password')";

    $insertdata_query = mysqli_query($con, $insertdata);
    if ($insertdata_query) {
        echo "Success";
    } else {
        echo "Error";
    }
} elseif (isset($_POST['name']) && isset($_POST['idNumber']) && isset($_POST['class']) && isset($_POST['department']) && isset($_POST['Gender']) && isset($_POST['nationalID'])) {

    $name = $_POST['name'];
    $idNumber = $_POST['idNumber'];
    $class = $_POST['class'];
    $department = $_POST['department'];
    $Gender = $_POST['Gender'];
    $nationalID = $_POST['nationalID'];

    $insertdata = "insert into student_user (name,idNumber,password,class,gender,department,national_ID) values('$name', $idNumber,'$nationalID','$class','$Gender','$department','$nationalID')";

    $insertdata_query = mysqli_query($con, $insertdata);

    if ($insertdata_query) {
        echo "Success";
    } else {
        echo "Error";
    }


} elseif (isset($_POST['search_query'])) {
    $name = $_POST['search_name'];
    $idNumber = $_POST['search_idNumber'];
    $class = $_POST['search_class'];
    $Dipartment = $_POST['search_Dipartment'];
    $Gender = $_POST['search_Gender'];
    $nationalID = $_POST['search_nationalID'];

    $where = ""; // Initialize the WHERE clause to an empty string

    if (!empty($name)) {
        $where .= "name = '$name' AND ";
    }

    if (!empty($idNumber)) {
        $where .= "idNumber = '$idNumber' AND ";
    }

    if (!empty($class)) {
        $where .= "class = '$class' AND ";
    }

    if (!empty($Dipartment)) {
        $where .= "department  = '$Dipartment' AND ";
    }

    if (!empty($Gender)) {
        $where .= "Gender = '$Gender' AND ";
    }

    if (!empty($nationalID)) {
        $where .= "nationalID = '$nationalID' AND ";
    }

    // Remove the last "AND" from the WHERE clause
    $where = rtrim($where, "AND ");

    if (empty($where)) {
        // echo "No non-empty variables found";
        $not_found = "Please Select At List Filled";
    } else {

        $query = "SELECT *,student_user.id as s_id FROM student_user INNER JOIN department ON student_user.department = department.id WHERE " . $where;

        $search_student_query = mysqli_query($con, $query);

        if ($search_student_query) {

            while ($row = mysqli_fetch_assoc($search_student_query)) {
                ?>
                <tr>
                    <td>
                        <?= $row['idNumber']; ?>
                    </td>
                    <td>
                        <?= $row['name']; ?>
                    </td>
                    <td>
                        <?= $row['gender']; ?>
                    </td>
                    <td>
                        <?= $row['class']; ?>
                    </td>
                    <td>
                        <?= $row['d_name']; ?>
                    </td>
                    <td>
                        <a type="button" style="color:white" onclick="UpdateUser(<?= $row['s_id']; ?>)"
                            class="editStudentBtn btn btn-success btn-sm">Edit</a>
                        <a type="button" onclick="DeleteUser(<?= $row['s_id']; ?>)" class="btn btn-danger btn-sm">删除</a>
                    </td>
                </tr>
                <?php
            }
        }


    }
} elseif (isset($_POST['deleteid'])) {
    $idumber = $_POST['deleteid'];
    $deleteData = "DELETE FROM student_user WHERE id='$idumber';";

    $deleteData_query = mysqli_query($con, $deleteData);

    if ($deleteData_query) {
        echo "Done";
    } else {
        echo "failed";
    }
} elseif (isset($_POST['Updateid'])) {
    $updateid = $_POST['Updateid'];

    $query = "SELECT * FROM student_user WHERE id = '$updateid' ";

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

} elseif (isset($_POST['id']) && isset($_POST['update_name']) && isset($_POST['update_idNumber']) && isset($_POST['update_class']) && isset($_POST['update_department']) && isset($_POST['update_Gender']) && isset($_POST['update_nationalID'])) {

    $id = $_POST['id'];
    $name = $_POST['update_name'];
    $idNumber = $_POST['update_idNumber'];
    $class = $_POST['update_class'];
    $Dipartment = $_POST['update_department'];
    $Gender = $_POST['update_Gender'];
    $nationalID = $_POST['update_nationalID'];

    $update = "update student_user set name = '$name',idNumber = '$idNumber',class = '$class', department = '$Dipartment' , gender = '$Gender' , 	national_ID = '$nationalID' where id='$id' ";

    $update_query = mysqli_query($con, $update);

    if ($update_query) {
        echo "Success";
    } else {
        echo "Error";
    }


} elseif (isset($_POST['d_id'])) {

    $d_id = $_POST['d_id'];

    $query = "SELECT * FROM teacher_user where d_id = $d_id ";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<option value="">选择老师</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value=' . $row['id'] . '>' . $row['t_name'] . '</option>';
        }
    } else {

        echo '<option>没有老师</option>';
    }

} elseif (isset($_POST['c_id']) && isset($_POST['c_name']) && isset($_POST['c_point']) && isset($_POST['c_start_date']) && isset($_POST['c_depart_id']) && isset($_POST['c_teacher_id'])) {


    $c_id = $_POST['c_id'];
    $c_name = $_POST['c_name'];
    $c_point = $_POST['c_point'];
    $c_start_date = $_POST['c_start_date'];
    $c_department = $_POST['c_depart_id'];
    $c_teacher = $_POST['c_teacher_id'];

    $insertdata = "insert into course (c_id,c_name,c_point, c_start_date, c_depart_id,c_teacher_id) values('$c_id', '$c_name','$c_point', '$c_start_date','$c_department','$c_teacher')";

    $insertdata_query = mysqli_query($con, $insertdata);

    if ($insertdata_query) {
        echo "Success";
    } else {
        echo "Error";
    }


} elseif (isset($_POST['t_name']) && isset($_POST['t_school_id']) && isset($_POST['t_d_id']) && isset($_POST['t_gender']) && isset($_POST['t_nationalID'])) {

    $t_name = $_POST['t_name'];
    $t_school_id = $_POST['t_school_id'];
    $t_d_id = $_POST['t_d_id'];
    $t_gender = $_POST['t_gender'];
    $t_nationalID = $_POST['t_nationalID'];

    $insertdata = "insert into teacher_user (t_name,t_gender,school_id,d_id,nationalID,password) values('$t_name','$t_gender', $t_school_id,'$t_d_id','$t_nationalID','$t_nationalID')";

    $insertdata_query = mysqli_query($con, $insertdata);
    if ($insertdata_query) {
        echo "Success";
    } else {
        echo "Error";
    }


} else {
    echo "Error";
}





?>