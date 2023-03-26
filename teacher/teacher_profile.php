<?php
$teacher_drop_menu = "menu-open";
$teacher_menu = "active";
$teacher_profile_menu = "active";
$breadcrumb_name = "老师信息";

@include 'layout_teacher_header.php';

include "../database.php";
$user_id = $_SESSION['userid'];
$profile = "SELECT * FROM teacher_user INNER JOIN department ON teacher_user.d_id  = department.id 
            WHERE teacher_user.id = '$user_id' ";
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
                        value="<?php echo $profile_result['t_name']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName2" class="col-sm-3 col-form-label">学号</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control text-center" disabled id="inputName2"
                        value="<?php echo $profile_result['school_id']; ?>">
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
                        value="<?php echo $profile_result['nationalID']; ?>">
                </div>
            </div>
        </form>
    </div>
</div>



<!-- /.row (main row) -->


<?php
@include "layout_teacher_footer.php";
@include "layout_teacher_javascript.php";
?>

</body>

</html>