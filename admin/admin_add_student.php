<?php
$student_drop_menu = "menu-open";
$student_menu = "active";
$add_student_menu = "active";
$breadcrumb_name = "Add Student";

@include "layout_header.php";

include "../database.php";

$profile = "select * from admin_user";
$profile_query = mysqli_query($con, $profile);
$total = mysqli_num_rows($profile_query);


$department_show = "select * from department";
$department_show_query = mysqli_query($con, $department_show);

?>

<div class="card card-primary card-outline col-md-12">
    <div class="card-body box-profile">
        <form id="admin_add_student">
            <div class="row">
                <div class="col">
                    <label for="name">名字:</label>
                    <input name="name" type="text" class="form-control" required id="name" />
                </div>
                <div class="col">
                    <label for="school_id">学号:</label>
                    <input name="idNumber" type="text" class="form-control" required id="school_id" />
                </div>
                <div class="col">
                    <label for="name">班级:</label>
                    <input name="class" type="text" class="form-control" required id="name" />
                </div>
                <div class="col-md-3">
                    <label for="school_id">开课学院:</label>
                    <select name="department" class="custom-select">
                        <option value="">选择开课学院</option>
                        <?php
                        if (mysqli_num_rows($profile_query) > 0) {
                            while ($row = mysqli_fetch_assoc($department_show_query)) {
                                echo '<option value=' . $row['id'] . '>' . $row['d_name'] . '</option>';
                            }
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="school_id">性别:</label>
                    <select name="Gender" class="custom-select">
                        <option selected>男</option>
                        <option value="女">女</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="name">证件号:</label>
                    <input name="nationalID" type="text" class="form-control" required id="name" />
                </div>

            </div>

            <br>
            <button type="submit" class="btn btn-primary">
                添加学生
            </button>
        </form>
    </div>
</div>
<!-- /.row ( main row ) -->

<?php
@include "layout_footer.php";
@include "layout_javascript.php"
    ?>


<script>
    $("#admin_add_student").submit((e) => {
        e.preventDefault();

        var form = $("#admin_add_student").serialize();

        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: form,
            success: function (res) {

                if (res == 'Error') {
                    toastr["error"]("Having Probleam")

                }
                if (res == 'Success') {
                    toastr["success"]("Adding Student Success！");

                }
            },
            error: function (res) {
                toastr["error"]("Having Probleam")
            }
        })
    })

</script>

</body>

</html>