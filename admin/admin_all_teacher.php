<?php
$teacher_drop_menu = "menu-open";
$teacher_menu = "active";
$all_teacher_menu = "active";
$breadcrumb_name = "All Teacher";
@include "layout_header.php";

include "../database.php";
$profile = "SELECT * FROM teacher_user INNER JOIN department ON teacher_user.d_id  = department.id";

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
                            <th>学号</th>
                            <th>名字</th>
                            <th>性别</th>
                            <th>院系:</th>
                            <th>证件号:</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        <?php
                        while ($row = mysqli_fetch_assoc($profile_query)) {
                            ?>
                            <tr>
                                <td>
                                    <?= $row['school_id']; ?>
                                </td>
                                <td>
                                    <?= $row['t_name']; ?>
                                </td>
                                <td>
                                    <?= $row['t_gender']; ?>
                                </td>
                                <td>
                                    <?= $row['d_name']; ?>
                                </td>
                                <td>
                                    <?= $row['nationalID']; ?>
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