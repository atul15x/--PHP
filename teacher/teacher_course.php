<?php
$teacher_drop_menu = "menu-open";
$teacher_menu = "active";
$teacher_course = "active";
$breadcrumb_name = "你的课程";

@include 'layout_teacher_header.php';

include "../database.php";

$user_id = $_SESSION['userid'];



$profile = "SELECT *, running_course.id as run_id   FROM running_course INNER JOIN student_user ON running_course.user_id  = student_user.id
            INNER JOIN course ON running_course.course_id = course.id 
            INNER JOIN teacher_user ON course.c_teacher_id  = teacher_user.id
             WHERE  course.c_teacher_id = $user_id  ";

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
                            <th>打分</th>
                            <th>给打分</th>
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
                                <td>
                                    <button onclick="givemark(<?= $row['run_id']; ?>)" class=" btn btn-primary
                                        btn-sm">给打分</button>
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



<!-- Modal -->
<div class="modal fade" id="mark_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="givemark">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">打分</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="name">学生名字:</label>
                            <input disabled name="m_student_name" type="text" class="form-control" required
                                id="m_student_name" />
                        </div>
                        <div class="col">
                            <label for="school_id">学生学号:</label>
                            <input disabled name="m_student_idnumber" type="text" class="form-control" required
                                id="m_student_idnumber" />
                        </div>
                        <div class="col">
                            <label for="name">学生班级:</label>
                            <input disabled name="m_student_class" type="text" class="form-control" required
                                id="m_student_class" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">课名:</label>
                            <input disabled name="m_student_corse_name" type="text" class="form-control" required
                                id="m_student_corse_name" />
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="name">给打分:</label>
                            <input autofocus name="m_student_corse_mark" type="text" class="form-control" required
                                id="m_student_corse_mark" />
                            <input disabled name="m_corse_id" type="hidden" class="form-control" required
                                id="m_corse_id" />
                        </div>

                    </div>

                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        提交
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- /.row (main row) -->


<?php
@include "layout_teacher_footer.php";
@include "layout_teacher_javascript.php";
?>

<script>

    function givemark(c_id) {

        $.ajax({
            url: "teacher/teacher_bakcend.php",
            method: 'POST',
            data: { c_id: c_id },
            success: function (data, status) {

                var user = JSON.parse(data);

                console.log(user);
                $('#m_student_name').val(user.name);
                $('#m_student_idnumber').val(user.idNumber);
                $('#m_student_class').val(user.class);
                $('#m_student_corse_name').val(user.c_name);
                $('#m_corse_id').val(user.run_id);


            },
            error: function (res) {
                toastr["error"]("Having Probleam")
            }
        })

        $('#mark_modal').modal("show");
    }


    $("#givemark").submit((e) => {
        e.preventDefault();


        // var givemark = $("#updateUserInfo").serialize();


        var m_corse_id = $('#m_corse_id').val();
        var mark = $('#m_student_corse_mark').val();

        Swal.fire({
            title: '你确定吗？',
            text: "你给他打分吗？",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '是!',
            cancelButtonText: '不',
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "teacher/teacher_bakcend.php",
                    method: 'POST',
                    data: {
                        m_corse_id: m_corse_id, mark: mark
                    },
                    success: function (res) {

                        if (res == "Success") {
                            Swal.fire(
                                '成功!',
                                '您的课程注册已完成。',
                                'success'
                            )
                            $('#mark_modal').modal("hide");
                            setTimeout(function () {
                                window.location = 'teacher/teacher_course.php';
                            }, 2000);

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

    });


</script>

</script>

</body>

</html>