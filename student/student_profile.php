<?php
$student_drop_menu = "menu-open";
$student_menu = "active";
$student_profile_menu = "active";
$breadcrumb_name = "学生信息";

@include 'layout_student_header.php';

include "../database.php";
$id = $_SESSION['userid'];
$profile = "SELECT * FROM student_user INNER JOIN department ON student_user.department  = department.id 
            WHERE student_user.id = $id";
$profile_query = mysqli_query($con, $profile);

$profile_result = mysqli_fetch_assoc($profile_query);


?>

<div class="card card-primary card-outline col-md-6">
    <div class="card-body box-profile">
        <form class="form-horizontal">
            <div class="form-group row">
                <label for="inputName" class="col-sm-3 col-form-label">姓名</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control text-center" disabled id="inputName"
                        value="<?php echo $profile_result['name']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName2" class="col-sm-3 col-form-label">学号</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control text-center" disabled id="inputName2"
                        value="<?php echo $profile_result['idNumber']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-3 col-form-label">班级</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control text-center" disabled id="inputEmail"
                        value="<?php echo $profile_result['class']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-3 col-form-label">学院</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control text-center" disabled id="inputEmail"
                        value="<?php echo $profile_result['d_name']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName2" class="col-sm-3 col-form-label">证件号:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control text-center" disabled id="inputName2"
                        value="<?php echo $profile_result['national_ID']; ?>">
                </div>
            </div>
        </form>
    </div>
</div>



<!-- /.row (main row) -->


<?php
@include "layout_student_footer.php";
@include "layout_student_javascript.php";
?>

</body>

</html>