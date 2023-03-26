<?php
$teacher_drop_menu = "menu-open";
$teacher_menu = "active";
$teacher_all_course_menu = "active";
$breadcrumb_name = "所有课程";

@include 'layout_teacher_header.php';

include "../database.php";
$userid = $_SESSION['userid'];


$profile = "SELECT *, course.id as cid FROM course INNER JOIN department ON course.c_depart_id  = department.id
            INNER JOIN teacher_user ON course.c_teacher_id = teacher_user.id WHERE 	teacher_user.id = $userid  ";

$profile_query = mysqli_query($con, $profile);

?>


<!-- <div class="row">
    <div class="col-md-12">
        <div class=" card card-primary card-outline"> 

        <div>
    </div>

</div> -->


<div class="row">
    <div class="col-md-12">
        <div class=" card card-info card-outline">
            <div class="card-body">
                <table id="dtBasicExample" class="table  table-striped table-bordered table-sm" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>课程号</th>
                            <th>课程号</th>
                            <th>学分</th>
                            <th>开课学院</th>
                            <th>老师</th>
                            <th>开始时间</th>
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
                                    <?= $row['d_name']; ?>
                                </td>
                                <td>
                                    <?= $row['t_name']; ?>
                                </td>
                                <td>
                                    <?= $row['c_start_date']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<!-- /.row (main row) -->


<?php
@include "layout_teacher_footer.php";
@include "layout_teacher_javascript.php";
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
            title: '你确定吗？',
            text: "你想要这个课程",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '是!',
            cancelButtonText: '不',
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
                                '成功!',
                                '您的课程注册已完成。',
                                'success'
                            )
                        } else if (res == "Error") {
                            Swal.fire(
                                '错误!',
                                '出了问题',
                                'error'
                            )
                        } else if (res == "AlredayPick") {
                            Swal.fire(
                                '已经选择',
                                '你已经选择了这门课程',
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