<?php
$admin_drop_menu = "menu-open";
$admin_menu = "active";
$admin_add_user = "active";
$breadcrumb_name = "Add Admin";

@include "layout_header.php";

include "../database.php";

$profile = "select * from admin_user";
$profile_query = mysqli_query($con, $profile);
$total = mysqli_num_rows($profile_query);

?>
<div class="card card-primary card-outline col-md-12">
    <div class="card-body box-profile">
        <form class="form-horizontal" id="admin_add_user">
            <div class="form-group row">
                <label for="inputName" class="col-md-1 col-form-label">Name</label>
                <div class="col-md-2">
                    <input type="text" name="admin_add_name" class="form-control " id="inputName">
                </div>
                <label for="inputEmail" class="col-md-1 col-form-label">Email</label>
                <div class="col-md-3">
                    <input type="email" name="admin_add_email" class="form-control " id="inputEmail">
                </div>
                <label for="number" class="col-md-1 col-form-label">Account ID</label>
                <div class="col-md-2">
                    <input type="number" name="admin_add_idnumber" class="form-control" id="number">
                </div>
                <button class="btn btn-primary" type="submit">Add</button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-info ">
            <div class="card-header">
                <h3 class="card-title">Total Admin:
                    <?php echo $total ?>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body ">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Acount ID</th>
                        </tr>
                    </thead>
                    <?php
                    while ($profile_result = mysqli_fetch_assoc($profile_query)) {
                        ?>
                        <tbody>
                            <td>
                                <?php echo $profile_result['idNumber']; ?>
                            </td>
                            <td>
                                <?php echo $profile_result['name']; ?>
                            </td>
                            <td>
                                <?php echo $profile_result['email']; ?>
                            </td>
                        </tbody>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- /.row ( main row ) -->

<?php
@include "layout_footer.php";
@include "layout_javascript.php"
    ?>

<script>

    $("#admin_add_user").submit((e) => {
        e.preventDefault();

        var form = $("#admin_add_user").serialize();
        $.ajax({
            url: "backend_check.php",
            method: 'POST',
            data: form,
            success: function (res) {

                if (res == 'Error') {
                    toastr["error"]("Having Probleam")

                }
                if (res == 'Success') {
                    toastr["success"]("Add Admin Success！");
                    setTimeout(function () {
                        window.location = 'admin_add_user.php';
                    }, 2000);
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