<?php
$course_drop_menu = "menu-open";
$course_menu = "active";
$add_course_menu = "active";
$breadcrumb_name = " 添加课程";
@include "layout_header.php";

include "../database.php";
$profile = "select * from department";
$profile_query = mysqli_query($con, $profile);
?>



<div class="card card-warning card-outline col-md-12">
    <div class="card-body box-profile">
        <form id="add_course">
            <div class="row">
                <div class="col">
                    <label for="name">课程号：:</label>
                    <input name="c_id" type="text" class="form-control" required id="name" />
                </div>
                <div class="col">
                    <label for="school_id">课程号：</label>
                    <input name="c_name" type="text" class="form-control" required id="school_id" />
                </div>
                <div class="col">
                    <label for="name">学分：</label>
                    <input name="c_point" type="text" class="form-control" required id="name" />
                </div>
                <div class="col-md-3">
                    <label for="school_id">开课学院:</label>
                    <select name="c_depart_id" class="custom-select" onchange="FetchState(this.value)">
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
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="pwd">老师：</label>
                    <select name="c_teacher_id" id="state" class="form-control" required>
                        <option>选择老师</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>开始时间:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input name="c_start_date" type="text" class="form-control datetimepicker-input"
                            data-target="#reservationdate" />
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

            </div>

            <br>
            <button type="submit" class="btn btn-warning">
                添加课程
            </button>
        </form>
    </div>
</div>


<?php
@include "layout_footer.php";
@include "layout_javascript.php";
?>
<script type="text/javascript">

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'YYYY-MM-DD',

    });

    function FetchState(id) {

        $('#state').html('');
        $.ajax({
            type: 'post',
            url: 'backend_check.php',
            data: { d_id: id },
            success: function (data) {

                $('#state').html(data);
            }

        })
    }

    $("#add_course").submit((e) => {
        e.preventDefault();

        var form = $("#add_course").serialize();
        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: form,
            success: function (res) {

                if (res == 'Error') {
                    toastr["error"]("Having Probleam")

                }
                if (res == 'Success') {
                    toastr["success"]("Adding Student Success");

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