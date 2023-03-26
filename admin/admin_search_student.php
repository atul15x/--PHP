<?php
$student_drop_menu = "menu-open";
$student_menu = "active";
$add_student_search_menu = "active";
$breadcrumb_name = "Search Student";

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
        <form id="admin_search_student">
            <div class="row">
                <div class="col">
                    <label for="name">名字:</label>
                    <input name="search_name" type="text" class="form-control" id="name" />
                </div>
                <div class="col">
                    <label for="school_id">学号:</label>
                    <input name="search_idNumber" type="text" class="form-control" id="school_id" />
                </div>
                <div class="col">
                    <label for="name">班级:</label>
                    <input name="search_class" type="text" class="form-control" id="name" />
                </div>
                <div class="col-md-3">
                    <label for="school_id">开课学院:</label>
                    <select name="search_Dipartment" class="custom-select">
                        <option value="">选择开课学院</option>
                        <?php
                        if (mysqli_num_rows($department_show_query) > 0) {
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
                    <select name="search_Gender" class="custom-select">
                        <option value="">选择</option>
                        <option value="男">男</option>
                        <option value="女">女</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="name">证件号:</label>
                    <input name="search_nationalID" type="text" class="form-control" id="name" />
                    <input name="search_query" type="hidden" class="form-control" id="name" />
                </div>

            </div>

            <br>
            <button type="submit" class="btn btn-info text-white">
                查询学生
            </button>
        </form>
    </div>
</div>


<table class="table table-dark table-striped table-bordered" id="student-table">
    <thead>
        <tr class="bg-info" style="color:white">
            <th>学号</th>
            <th>名字</th>
            <th>性别</th>
            <th>班级</th>
            <th>院系</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody id="table">
    </tbody>
</table>
<!-- /.row ( main row ) -->



<!-- Modal -->
<div class="modal fade" id="update_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateUserInfo">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="name">名字:</label>
                            <input name="update_name" type="text" class="form-control" required id="update_name" />
                        </div>
                        <div class="col">
                            <label for="school_id">学号:</label>
                            <input name="update_idNumber" type="text" class="form-control" required
                                id="update_idNumber" />
                        </div>
                        <div class="col">
                            <label for="name">班级:</label>
                            <input name="update_class" type="text" class="form-control" required id="update_class" />
                        </div>
                        <div class="col-md-3">
                            <label for="school_id">开课学院:</label>
                            <select name="search_Dipartment" class="custom-select" id="update_department">
                                <option value="">选择开课学院</option>
                                <?php
                                $department_show = "select * from department";
                                $department_show_query = mysqli_query($con, $department_show);
                                if (mysqli_num_rows($department_show_query) > 0) {
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
                            <select id="update_Gender" name="update_Gender" class="custom-select">
                                <option selected>男</option>
                                <option value="女">女</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="name">证件号:</label>
                            <input name="update_nationalID" type="text" class="form-control" required
                                id="update_nationalID" />
                            <input name="id" type="hidden" class="form-control" required id="id" />
                        </div>

                    </div>

                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        改信息
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
@include "layout_footer.php";
@include "layout_javascript.php"
    ?>

<script>
    $("#admin_search_student").submit((e) => {
        e.preventDefault();

        const tableBody = document.querySelector('#student-table tbody');

        var form = $("#admin_search_student").serialize();

        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: form,
            success: function (res) {

                $('#table').html(res);

            },
            error: function (res) {
                toastr["error"]("Having Probleam")
            }
        })
    })


    function DeleteUser(deleteid) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "backend_check.php",
                    method: 'POST',
                    data: {
                        deleteid: deleteid
                    },
                    success: function (res) {

                        if (res == "Done") {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            setTimeout(function () {
                                window.location = 'admin_search_student.php';
                            }, 1000);
                        } else if (res == "failed") {
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



    function UpdateUser(Updateid) {

        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: { Updateid: Updateid },
            success: function (data, status) {

                var user = JSON.parse(data);

                console.log(user);

                $('#update_name').val(user.name);
                $('#update_idNumber').val(user.idNumber);
                $('#update_department').val(user.department);
                $('#update_class').val(user.class);
                $('#update_Gender').val(user.gender);
                $('#update_nationalID').val(user.national_ID);
                $('#id').val(user.id);


            },
            error: function (res) {
                toastr["error"]("Having Probleam")
            }
        })

        $('#update_modal').modal("show");
    }


    $("#updateUserInfo").submit((e) => {
        e.preventDefault();


        //            var updateform = $("#updateUserInfo").serialize();

        var update_name = $('#update_name').val();
        var update_idNumber = $('#update_idNumber').val();
        var update_class = $('#update_class').val();
        var update_department = $('#update_department').val();
        var update_Gender = $('#update_Gender').val();
        var update_nationalID = $('#update_nationalID').val();
        var id = $('#id').val();

        console.log(update_name, update_idNumber, update_class, update_department, update_Gender, update_nationalID, id);
        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: { id: id, update_name: update_name, update_idNumber: update_idNumber, update_class: update_class, update_department: update_department, update_Gender: update_Gender, update_nationalID: update_nationalID },
            success: function (res) {

                if (res == "Success") {
                    toastr["success"]("Profile Updated");
                    setTimeout(function () {
                        window.location = 'admin_search_student.php';
                    }, 2000);

                    $('#update_modal').modal("hide");
                }
                else if (res == 'error') {
                    toastr["error"]("Profile Update failed");
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