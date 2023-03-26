<?php
$teacher_drop_menu = "menu-open";
$teacher_menu = "active";
$teacher_add_menu = "active";
$breadcrumb_name = "Add Teacher";
@include "layout_header.php";

include "../database.php";
$profile = "select * from department";
$profile_query = mysqli_query($con, $profile);
?>

<div class="card card-info card-outline col-md-12">
    <div class="card-body box-profile">
        <form id="admin_add_teacher">
            <div class="row">
                <div class="col">
                    <label for="t_name">名字:</label>
                    <input name="t_name" type="text" class="form-control" required id="t_name" />
                </div>
                <div class="col">
                    <label for="t_school_id">学号:</label>
                    <input name="t_school_id" type="number" class="form-control" required id="t_school_id" />
                </div>
                <div class="col-md">
                    <label for="d_id">院系:</label>
                    <select name="t_d_id" class="custom-select" id="t_d_id">
                        <option value="">选择开课学院</option>
                        <?php
                        if (mysqli_num_rows($profile_query) > 0) {
                            while ($row = mysqli_fetch_assoc($profile_query)) {
                                echo '<option value=' . $row['id'] . '>' . $row['d_name'] . '</option>';
                            }
                        }
                        ?>

                    </select>
                </div>
                <div class="col-md-1">
                    <label for="t_gender">性别:</label>
                    <select name="t_gender" class="custom-select" id="t_gender">
                        <option selected>男</option>
                        <option value="女">女</option>
                    </select>
                </div>

                <div class="col-md">
                    <label for="t_nationalID">证件号:</label>
                    <input name="t_nationalID" type="text" class="form-control" required id="t_nationalID" />
                </div>
            </div>
            <div class="row">


            </div>

            <br>
            <button type="submit" class="btn btn-info">
                添加学生
            </button>
        </form>
    </div>
</div>


<?php
@include "layout_footer.php";
@include "layout_javascript.php"
    ?>

<script>

    $("#admin_add_teacher").submit((e) => {
        e.preventDefault();

        var form = $("#admin_add_teacher").serialize();

        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: form,
            success: function (res) {

                if (res == 'Error') {
                    toastr["error"]("Having Probleam")

                }
                if (res == 'Success') {
                    toastr["success"]("Adding Teacher Success");

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