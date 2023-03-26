<?php
$student_drop_menu = "menu-open";
$student_menu = "active";
$student_course = "active";
$breadcrumb_name = "你的课程";

@include 'layout_student_header.php';

include "../database.php";

$user_id = $_SESSION['userid'];

$profile = "SELECT *  FROM running_course INNER JOIN student_user ON running_course.user_id  = student_user.id
            INNER JOIN course ON running_course.course_id = course.id 
            INNER JOIN teacher_user ON course.c_teacher_id  = teacher_user.id
             WHERE  running_course.user_id = $user_id  ";

$profile_query = mysqli_query($con, $profile);

?>


<div class="row">
    <div class="col-12">
        <!-- /.card -->

        <div class="card card-primary card-outline">
            <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dtBasicExample" class="table  table-striped table-bordered table-sm" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>课程号</th>
                            <th>课程号</th>
                            <th>学分</th>
                            <th>老师</th>
                            <th>开始时间</th>
                            <th>成绩</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($profile_query)) {
                            ?>
                            <tr>
                                <td>
                                    <?= $row['c_id']; ?>
                                </td>
                                <td>
                                    <?= $row['c_name']; ?>
                                </td>
                                <td>
                                    <?= $row['c_point']; ?>.0
                                </td>
                                <td>
                                    <?= $row['t_name']; ?>
                                </td>
                                <td>
                                    <?= $row['c_start_date']; ?>
                                </td>
                                <td>
                                    <?= $row['mark']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>


<!-- /.row (main row) -->


<?php
@include "layout_student_footer.php";
@include "layout_student_javascript.php";
?>

<script>

    $(document).ready(function () {
        $('#dtBasicExample').DataTable({
            paging: true,
            ordering: false,
            info: false,
            lengthChange: false,
        });
        $('.dataTables_length').addClass('bs-select');
    });

    function coursePick(course_id) {
        console.log(course_id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You Want This Course",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "./student/student_backend.php",
                    method: 'GET',
                    data: {
                        course_id: course_id
                    },
                    success: function (res) {

                        if (res == "Success") {
                            Swal.fire(
                                'Success!',
                                'Your Course Has Been Registerd.',
                                'success'
                            )
                        } else if (res == "Error") {
                            Swal.fire(
                                'Deleted Failed!',
                                'Student Not Deleted',
                                'error'
                            )
                        }
                    },
                    error: function (res) {
                        toastr["error"]("Having Probleam")
                    }
                })

            }
        })
    }

</script>

</script>

</body>

</html>