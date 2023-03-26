<?php
$admin_menu = "active";
$breadcrumb_name = "仪表板";
@include "layout_header.php";

include "../database.php";
$admin = "select * from admin_user";
$admin_query = mysqli_query($con, $admin);
$admin_result = mysqli_num_rows($admin_query);

$student = "select * from student_user";
$student_query = mysqli_query($con, $student);
$student_result = mysqli_num_rows($student_query);

$course = "select * from course";
$course_query = mysqli_query($con, $course);
$course_result = mysqli_num_rows($course_query);

$teacher = "select * from teacher_user";
$teacher_query = mysqli_query($con, $teacher);
$teacher_result = mysqli_num_rows($teacher_query);

?>


<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>
                    <?php echo $admin_result ?>
                </h3>

                <p>管理员</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-stalker"></i>

            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>
                    <?php echo $student_result ?>
                </h3>

                <p>学生</p>
            </div>
            <div class="icon">
                <i class="ion ion-university"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>
                    <?php echo $course_result ?>
                </h3>

                <p>课程</p>
            </div>
            <div class="icon">
                <i class="ion ion-planet"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>
                    <?php echo $teacher_result ?>
                </h3>

                <p>老师</p>
            </div>
            <div class="icon">
                <i class="ion ion-ribbon-b"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
</div>






<?php
@include "layout_footer.php";
@include "layout_javascript.php"
?>

<script>




</script>

</body>

</html>