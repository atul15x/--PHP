<?php
$course_drop_menu = "menu-open";
$course_menu = "active";
$all_course_menu = "active";
$breadcrumb_name = "All Course";
@include "layout_header.php";

include "../database.php";
$profile = "SELECT * FROM course INNER JOIN department ON course.c_depart_id  = department.id
            INNER JOIN teacher_user ON course.c_teacher_id = teacher_user.id ";

$profile_query = mysqli_query($con, $profile);

?>

<div class="row">
    <div class="col-12">
        <!-- /.card -->

        <div class="card card-warning card-outline">
            <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>课程号</th>
                            <th>课程号</th>
                            <th>学分</th>
                            <th>开课学院</th>
                            <th>老师</th>
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




<?php
@include "layout_footer.php";
@include "layout_javascript.php"
    ?>



<script type="text/javascript">
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

</body>

</html>