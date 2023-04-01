<?php

$admin_drop_menu = "menu-open";
$admin_menu = "active";
$admin_inqurey_req = "active";
$breadcrumb_name = "请求查询";
@include "layout_header.php";
include "../database.php";
$req_course = "select * from request_change_info ";
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
                            <a href="admin_inqurey_req.php" class="nav-link ">
                                <i class="fas fa-inbox"></i> 课程请求
                                <span class="badge bg-danger float-right" id="notify_number"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_inqurey_info_change.php" class="nav-link active">
                                <i class="far fa-envelope"></i> 改变信息请求
                                <span class="badge bg-danger float-right" id="notify_info_nums"></span>
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
                    <h3 class="card-title">改变信息请求</h3>

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
                            <th style="width: 10%">
                                名字
                            </th>
                            <th style="width: 10%">
                                号码
                            </th>
                            <th>
                                问题标题
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
                                    <?= $row['req_info_id']; ?>
                                </td>
                                <td>
                                    <?= $row['req_info_uname']; ?>
                                </td>
                                <td>
                                    <?= $row['req_info_idNumber']; ?>
                                </td>
                                <td>
                                    <?= $row['req_info_message']; ?>
                                </td>
                                <td class="project-state">
                                    <?php if( $row['req_info_approve'] == '0' ){
                                        ?>
                                        <span class="badge badge-warning">等等</span>
                                        <?php
                                    }elseif ($row['req_info_approve'] == '1')
                                    {
                                        ?>
                                        <span class="badge badge-success">成功</span>
                                        <?php
                                    }
                                    ?>

                                </td>
                                <td class="project-actions text-right">
                                    <a   class="btn btn-success btn-sm <?php if($row['req_info_approve'] == '1')  echo "disabled" ?> " onclick="req_info_read(<?= $row['req_info_id']; ?>)">
                                        <i class="fas fa-folder">
                                        </i>
                                        成功
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




<?php
@include "layout_footer.php";
@include "layout_javascript.php";
?>

<script>

    function req_info_read(req_info_id) {

        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: { req_info_id: req_info_id },
            success: function (data) {

                if(data == "success")
                {
                    toastr["success"]("课程成功了");
                    setTimeout(function () {
                        window.location = 'admin_inqurey_info_change.php';
                    }, 2000);
                }

            },
            error: function (res) {
                toastr["error"]("Having Probleam")
            }
        })


    }





</script>
