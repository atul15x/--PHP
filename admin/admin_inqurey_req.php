<?php

$admin_drop_menu = "menu-open";
$admin_menu = "active";
$admin_inqurey_req = "active";
$breadcrumb_name = "请求查询";
@include "layout_header.php";
include "../database.php";
$req_course = "select * from request_course INNER JOIN teacher_user ON request_course.req_course_teacher  = teacher_user.id";
$req_course_query = mysqli_query($con, $req_course);


?>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="compose.html" class="btn btn-primary btn-block mb-3">请求</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">类别</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <a href="admin_inqurey_req.php" class="nav-link active">
                                    <i class="fas fa-inbox"></i> 课程请求
                                    <span class="badge bg-danger float-right" id="notify_number"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin_inqurey_info_change.php" class="nav-link">
                                    <i class="far fa-envelope"></i> 改变信息请求
                                    <span class="badge bg-danger float-right"  id="notify_info_nums"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div class="col-md-9">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">课程请求</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 1%">
                                    号
                                </th>
                                <th style="width: 20%">
                                    课程名字
                                </th>
                                <th style="width: 30%">
                                    老师名字
                                </th>
                                <th>
                                    学分
                                </th>
                                <th style="width: 8%" class="text-center">
                                    地位
                                </th>
                                <th style="width: 20%">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($req_course_query)) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $row['req_id']; ?>
                                    </td>
                                    <td>
                                        <?= $row['req_course_name']; ?>
                                    </td>
                                    <td>
                                        <?= $row['t_name']; ?>
                                    </td>
                                    <td>
                                        <?= $row['req_course_point']; ?>
                                    </td>
                                    <td class="project-state">
                                        <?php if( $row['req_approve'] == '0' ){
                                            ?>
                                            <span class="badge badge-warning">等等</span>
                                            <?php
                                            }elseif ($row['req_approve'] == '1')
                                            {
                                                ?>
                                                <span class="badge badge-success">成功</span>
                                                <?php
                                            }
                                        ?>

                                    </td>
                                    <td class="project-actions text-right">
                                        <a   class="btn btn-primary btn-sm <?php if($row['req_approve'] == '1')  echo "disabled" ?> " onclick="req_read(<?= $row['req_id']; ?>)">
                                            <i class="fas fa-folder">
                                            </i>
                                            看法
                                        </a>
                                    </td>
                                    <td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>



        </div>
    </section>
            <!-- /.col -->


<!-- Modal -->
<div class="modal fade" id="req_id_read">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateUserInfo">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">课程请求</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="name">课程名字:</label>
                            <input disabled name="req_course_name" type="text" class="form-control" required id="req_course_name" />
                        </div>
                        <div class="col">
                            <label for="name">老师名字:</label>
                            <input disabled name="req_course_teacher" type="text" class="form-control" required id="req_course_teacher" />
                        </div>
                        <div class="col">
                            <label for="school_id">课程学分:</label>
                            <input disabled name="req_course_point" type="text" class="form-control" required
                                   id="req_course_point" />
                        </div>
                        <div class="col">
                            <label for="name">课程班级:</label>
                            <input disabled name="req_course_class" type="text" class="form-control" required id="req_course_class" />
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-md-5">
                            <label for="school_id">开课学院:</label>
                            <input disabled name="req_course_depart" type="text" class="form-control" required
                                   id="req_course_depart" />
                        </div>

                        <div class="col-md-3">
                            <label for="name">开始时间:</label>
                            <input  disabled name="req_course_start" type="text" class="form-control" required
                                   id="req_course_start" />
                        </div>

                        <div class="col-md-3">
                            <label for="name">结束时间:</label>
                            <input disabled name="req_course_finish" type="text" class="form-control" required
                                   id="req_course_finish" />
                            <input disabled name="req_id" type="hidden" class="form-control" required id="req_id" />
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="school_id">课程号码:</label>
                            <input name="req_course_id" type="text" class="form-control" required
                                   id="req_course_id" />
                        </div>

                        <div class="col-md-8">
                            <label for="name">地址:</label>
                            <input name="req_course_location" type="text" class="form-control" required
                                   id="req_course_location" />
                        </div>

                    </div>

                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="req_accept()">
                        同意
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
@include "layout_footer.php";
@include "layout_javascript.php";
?>

<script>

    function req_read(req_read_id) {

        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: { req_read_id: req_read_id },
            success: function (data, status) {

                var user = JSON.parse(data);


                $('#req_course_name').val(user.req_course_name);
                $('#req_course_point').val(user.req_course_point);
                $('#req_course_class').val(user.req_course_class);
                $('#req_course_depart').val(user.d_name);
                $('#req_course_teacher').val(user.t_name);
                $('#req_course_start').val(user.req_course_start );
                $('#req_course_finish').val(user.req_course_end);
                $('#req_id').val(user.req_id);


            },
            error: function (res) {
                toastr["error"]("Having Probleam")
            }
        })

        $('#req_id_read').modal("show");

    }

    function req_accept() {

        var req_accept_id = $('#req_id').val();
        var req_course_id = $('#req_course_id').val();
        var req_course_location = $('#req_course_location').val();

        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: { req_accept_id: req_accept_id , req_course_id : req_course_id , req_course_location:req_course_location  },
            success: function (data, status) {

                if (data == "Success") {
                    toastr["success"]("课程成功了");
                    setTimeout(function () {
                        window.location = 'admin_inqurey_req.php';
                    }, 2000);

                    $('#req_id_read').modal("hide");
                }
                else if (data == "Failed") {
                    toastr["success"]("错了");

                }


            },
            error: function (res) {
                toastr["error"]("Having Probleam")
            }
        })


    }



</script>
