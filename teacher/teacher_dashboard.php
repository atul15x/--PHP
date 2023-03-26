<?php

$teacher_drop_menu = "menu-open";
$teacher_menu = "active";
$breadcrumb_name = "老师仪表板";
@include 'layout_teacher_header.php';

include "../database.php";

$user_id = $_SESSION['userid'];

$all_course = "SELECT * FROM course WHERE c_teacher_id = '$user_id' ";

$all_course_query = mysqli_query($con, $all_course);

$all_result = mysqli_num_rows($all_course_query);



$course = "SELECT *  FROM running_course INNER JOIN course ON running_course.course_id  = course.id
             WHERE  course.c_teacher_id = $user_id  ";

$course_query = mysqli_query($con, $course);

$course_result = mysqli_num_rows($course_query);

?>

<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>
                    <?php echo $all_result ?>
                </h3>

                <p>你的所有课程</p>
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
                    <?php echo $course_result ?>
                </h3>

                <p>你的课程</p>
            </div>
            <div class="icon">
                <i class="ion ion-university"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
        </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <!-- ./col -->
</div>
<!-- /.row -->



<?php
@include "layout_student_footer.php";
@include "layout_teacher_javascript.php";
?>

</body>

</html>